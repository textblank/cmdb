<?php
/**
 * 定时从接口获取所有用户信息，将北研的入user表
 * 检查长时间没有上报的端口，删除它，大于30分钟的，删除
 * 同时此程序远程调用open-falcon的接口，实现hostgroup的变更
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Portonhost;
use app\models\Tags;
use app\models\HostnameTag;


class TagFromProcController extends Controller
{
    //进程和tag的映射，只处理这些进程
    public $proc_tag = [
        'java' => 'java',
        'mongod' => 'mongod',
        'mongos' => 'mongos',
        'redis-sentinel' => 'redis-sentinel',
        'redis-server' => 'redis-server',
        'fdfs_storaged' => 'fdfs_storaged',
        'fdfs_trackerd' => 'fdfs_trackerd',
        'memcached' => 'memcached',
        'mysqld' => 'mysqld',
        'nginx' => 'nginx',
        'haproxy' => 'haproxy',
        'beam.smp' => 'rabbitMQ'
    ];

    public function actionIndex()
    {
        $hostname_tag = [];
        $hostname_proc = [];
        $ins = [];
        $del = [];
        $new = [];

        //更新tags表
        foreach($this->proc_tag as $tag){
            $ck = Tags::find()->where(['tag'=>$tag])->one();
            if(!$ck){
                $in = new Tags;
                $in->tag = $tag;
                $in->save();
            }
        }

        //删除过期的proonhostc和hostname_tag
        echo "delete stop\n";
        $this->actionDeleteStopped();

        //获取原有的
        echo "get now\n";
        $tags = HostnameTag::find()->where(['src'=>1])->all();
        foreach($tags as $tag){
            $hostname_tag[$tag->hostname][$tag->tag] = 1;
        }
        $procs = Portonhost::find()->all();
        foreach($procs as $proc){
            if(isset($this->proc_tag[$proc->processname]))
                $hostname_proc[$proc->hostname][$proc->processname] = 1;
        }

        //proc里有而tag里没有的，存入ins
        echo "get ins\n";
        foreach($hostname_proc as $pk=>$pv){
            foreach($pv as $ppk=>$ppv){
                if(isset($hostname_proc[$pk][$ppk]) && !isset($hostname_tag[$pk][$ppk])){
                    $ins[$pk] = $this->proc_tag[$ppk];
                }
            }
        }
        //var_dump($ins);

        //tag里有而proc里没有的，存入del
        echo "get del\n";
        foreach($hostname_tag as $pk=>$pv){
            foreach($pv as $ppk=>$ppv){
                if(!isset($hostname_proc[$pk][$ppk]) && isset($hostname_tag[$pk][$ppk])){
                    $del[$pk] = $ppv;
                }
            }
        }
        //var_dump($del);

        //新增
        if(count($ins)>=1){
            echo "insert\n";
            var_dump($ins);
            foreach($ins as $h=>$t){
                $ck = HostnameTag::find()->where(['hostname'=>$h, 'tag'=>$t, 'src'=>1])->one();
                if(!$ck){
                    $in = new HostnameTag();
                    $in->hostname = $h;
                    $in->tag = $t;
                    $in->src = 1;
                    $in->save();
                    $new[$in->hostname] = $in->tag;
                    $transIns[$in->tag][] = $in->hostname;
                }
            }
        }

        //删除hostname_tag表里的信息
        if(count($del)>=1){
            echo "delete\n";
            var_dump($del);
            foreach($del as $h=>$t){
                $q = HostnameTag::find()->where(['hostname'=>$h, 'tag'=>$t, 'src'=>1])->one();
                if($q)
                    $q->delete();
                $transDel[$t][] = $h;
            }
        }
        //通知open-falcon增加
        if(isset($transIns)){
            echo "transIns\n";
            foreach($transIns as $k=>$v){
                $url = "http://conf.mon.foneshare.cn/api/";
                $url = $url.$k."/hosts";
                $this->callInterfaceCommon($url, "PUT", json_encode($v), "");
            }
        }

        //通知open-falcon删除
        if(isset($transDel)){
            echo "transDel\n";
            foreach($transDel as $k=>$v){
                $url = "http://conf.mon.foneshare.cn/api/";
                $url = $url.$k."/hosts";
                $this->callInterfaceCommon($url, "DELETE", json_encode($v), "");
            }
        }

        echo "all done\n";

    }

    public function actionDeleteStopped()
    {
        //echo "delete stopped";
        //查找许久没有上报的端口，删除
        $time = date("Y-m-d H:i:s", time() - 30*60);
        $procs = Portonhost::find()->where(['<', 'lasttime', $time])->all();
        if(count($procs)>=1){
            foreach($procs as $proc){
                if(isset($this->proc_tag[$proc->processname])){
                    $q = HostnameTag::find()->where(['hostname'=>$proc->hostname, 'tag'=>$this->proc_tag[$proc->processname], 'src'=>1])->one();
                    if($q)
                        $q->delete();

                    $url = "http://conf.mon.foneshare.cn/api/";
                    $url = $url.$this->proc_tag[$proc->processname]."/hosts";
                    $this->callInterfaceCommon($url, "DELETE", json_encode($proc->hostname), "");
                }

                $proc->delete();
            }
        }
    }


    //发起http请求
    public function callInterfaceCommon($URL,$type,$params,$headers){
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, $URL); //发贴地址
        if($headers!=""){
            curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
        }else {
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        switch ($type){
            case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
            case "POST": curl_setopt($ch, CURLOPT_POST,true); 
                         curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
                         curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
                          curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
        }
        $file_contents = curl_exec($ch);//获得返回值
        return $file_contents;
        curl_close($ch);
    }
}
