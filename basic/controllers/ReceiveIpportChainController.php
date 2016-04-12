<?php

namespace app\controllers;

use Yii;
use app\models\IpportChain;
use yii\web\Controller;

/**
 * IpportChainController implements the CRUD actions for IpportChain model.
 */
class ReceiveIpportChainController extends Controller
{
    public $enableCsrfValidation = false;

    
    public function actionPost()
    {

      $wins = [3,
              4,
              5,
              8,
              9,
              11,
              12,
              13,
              15,
              24,
              27,
              28,
              36,
              37,
              42,
              47,
              48
            ];

        $ignorePort = [
            '22' => 1,
            '1988' => 1,
            '50022' => 1,
            '6030' => 1,
            '6080' => 1,
        ];

        $ignoreIp = [
            '172.17.0.34' => 1,
            '172.17.0.35' => 1,
            '172.17.0.36' => 1,
            '127.0.0.1'   => 1,
        ];

        $uptime = date('Y-m-d H:i:s', time());
        //过期时间，秒
        $expireTime = 3600;

        //获取上报数据，存入$chain
        $f = file_get_contents("php://input");
        if(count($f)<1){
            $data['code'] = 400;
            $data['message'] = '缺少参数';
            return json_encode($data);
            Yii::end();
        } else {
            
            $reportChain = [];
            foreach(json_decode($f) as $row){
                $data = [];
                $key = '';
                $spl0 = explode(':', $row[0]);
                $spl1 = explode(':', $row[1]);
                if(isset($spl0[0]) && isset($spl0[1]) && isset($spl1[0]) && isset($spl1[1])){
                    if(!isset($ignorePort[$spl0[1]]) && !isset($ignorePort[$spl1[1]]) && !isset($ignoreIp[$spl0[0]]) && !isset($ignoreIp[$spl1[0]])){
                        if(!(isset($ignoreIp[$spl0[0]]) && isset($ignoreIp[$spl1[0]]))) {
                            $data['local_ip'] = $spl0[0];
                            $data['local_port'] = $spl0[1];
                            $data['peer_ip'] = $spl1[0];
                            $data['peer_port'] = $spl1[1];
                            $data['hostname'] = $this->ip2hostname($data['local_ip'], $wins);
                            //下面两行的顺序不能错
                            $key = join(',',$data);
                            $data['uptime'] = $uptime;
                            $reportChain[$key] = $data;
                            $hostname = $data['hostname'];
                        }
                    }
                }
                $key = '';
            }

            //获取旧数据，存入oldChain
            $oldChain = [];
            $oldKey = [];
            if(isset($hostname)){
                $rows = IpportChain::find()->where(['hostname'=>$hostname])->all();
                if(count($rows)>0){
                    foreach($rows as $row){
                        $ck['local_ip'] = $row->local_ip;
                        $ck['local_port'] = $row->local_port;
                        $ck['peer_ip'] = $row->peer_ip;
                        $ck['peer_port'] = $row->peer_port;
                        $ck['hostname'] = $row->hostname;
                        $oldKey = join(',', $ck);
                        $oldChain[$oldKey] = $row->uptime;
                        $oldId[$oldKey] = $row->id;
                    }
                }
            }

            //没有的，新增，都有的，更新时间
            foreach($reportChain as $rk=>$rv){
                if(!isset($oldChain[$rk])){
                    $in = new IpportChain();
                    $in->hostname = $rv['hostname'];
                    $in->local_ip = $rv['local_ip'];
                    $in->local_port = $rv['local_port'];
                    $in->peer_ip = $rv['peer_ip'];
                    $in->peer_port = $rv['peer_port'];
                    $in->uptime = $uptime;
                    $in->times = 1;
                    $in->save();
                } else {
                    $row = IpportChain::find()->where(['id'=>$oldId[$rk]])->one();
                    if($row){
                        $row->uptime = $uptime;
                        $row->times++;
                        $row->save();
                    }
                }
            }


            //已有的，上报没有的，判断时间是否超时，超时的删除
            // foreach($oldChain as $ok=>$ov){
            //     if(!isset($reportChain[$ok])){
            //         if((strtotime($uptime) - strtotime($ov)) > $expireTime){
            //             $del = IpportChain::find()->where(['id'=>$oldId[$ok]])->one();
            //             if($del)
            //                 $del->delete();
            //         }
            //     }
            // }

        }

    }




    public function ip2hostname($b, $wins)
    {
        if(substr($b, 0, 3) == '172'){
            $bb = explode('.', $b);
            in_array($bb[2], $wins) ? $prefix = 'vwsr' : $prefix = 'vlnx';
            $hostname = $prefix.str_pad($bb[2], 3, 0, STR_PAD_LEFT).str_pad($bb[3], 3, 0, STR_PAD_LEFT).'.foneshare.cn';
        } else {
            $bb = explode('.', $b);
            in_array($bb[2], $wins) ? $prefix = 'vwsr' : $prefix = 'vlnx';
            $hostname = $prefix.str_pad($bb[1], 3, 0, STR_PAD_LEFT).str_pad($bb[2], 3, 0, STR_PAD_LEFT).str_pad($bb[3], 3, 0, STR_PAD_LEFT).'.foneshare.cn';
        }

        return $hostname;
    }

}
