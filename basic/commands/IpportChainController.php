<?php
/**
 * www.qunee.com
 */

namespace app\commands;

use yii\console\Controller;
use app\models\IpportChain;
use app\models\Portonhost;
use app\models\Server;
use app\models\BizChain;
use app\models\Biz;

class IpportChainController extends Controller
{
    public function actionIndex()
    {
        $ports = []; //存放portonhost表里读取的prot
        $l_p = []; //local到peer
        $p_l = []; //peer到local
        $biz = []; //存放server所属biz
        $bizChain = [];
        $bizName = [];
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
            '172.17.0.40' => 1,
            '172.17.0.41' => 1,
            '172.17.0.42' => 1
        ];

        //取出所有的bizname
        $rows = Biz::find()->select('id,cname')->asArray()->all();
        foreach($rows as $row){
            $bizName[$row['id']] = $row['cname'];
        }
        unset($rows);
        unset($row);

        //取出所有侦听的端口，存入ports
        $rows = Portonhost::find()->select('port')->asArray()->all();
        foreach($rows as $row){
            if(!isset($ignorePort[$row['port']]))
                $ports[$row['port']] = 1;
        }
        unset($rows);
        unset($row);

        //取出所有server，存入biz
        $rows = Server::find()->select('ip1,busi1Id,busi2Id,busi3Id')->asArray()->all();
        foreach($rows as $row){
            if($row['busi3Id']!=NULL){
                $biz[$row['ip1']] = $row['busi3Id'];
            } elseif($row['busi2Id']!=NULL){
                $biz[$row['ip1']] = $row['busi2Id'];
            } elseif($row['busi1Id']!=NULL){
                $biz[$row['ip1']] = $row['busi1Id'];
            } else {
                continue;
            }
        }
        unset($rows);
        unset($row);
        // var_dump($biz);

        //取出所有chain
        $rows = IpportChain::find()->select('local_ip,local_port,peer_ip,peer_port')->where(['>', 'times', 2])->asArray()->all();
        foreach($rows as $row){
            if(isset($ignorePort[$row['local_port']]) || isset($ignorePort[$row['peer_port']]) || isset($ignoreIp[$row['local_ip']]) || isset($ignoreIp[$row['peer_ip']])){
                continue;
            } else {
                if(isset($ports[$row['local_port']]) || isset($ports[$row['peer_port']])){
                    isset($ports[$row['local_port']]) ? $port = "l_".$row['local_port'] : $port = "p_".$row['peer_port'];
                    $l_p[$row['local_ip']][$row['peer_ip']] = $port;

                    if(isset($biz[$row['local_ip']]) && isset($biz[$row['peer_ip']])){
                        isset($bizChain[$biz[$row['local_ip']]][$biz[$row['peer_ip']]]) ? $bizChain[$biz[$row['local_ip']]][$biz[$row['peer_ip']]]++ : $bizChain[$biz[$row['local_ip']]][$biz[$row['peer_ip']]] = 1;
                    }
                }
            }
        }
        unset($rows);
        unset($row);
        // var_dump($bizChain);

        foreach($bizChain as $l=>$peer){
            var_dump($l);
            var_dump($peer);
            foreach($peer as $p=>$num){
                $biz = new BizChain();
                $biz->local_biz_id = $l;
                $biz->local_biz_name = $bizName[$l];
                $biz->peer_biz_id = $p;
                $biz->peer_biz_name = $bizName[$p];
                $biz->num = $num;
                $biz->save();
            }
        }

        $i = 0;
        foreach($l_p as $k=>$v){
            //var_dump($k);
            //var_dump(count($v));
            //var_dump($v);
            $i += count($v);
        }
        // var_dump($i);
    }
}
