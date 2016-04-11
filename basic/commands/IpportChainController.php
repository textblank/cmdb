<?php
/**
 * 
 */

namespace app\commands;

use yii\console\Controller;
use app\models\IpportChain;
use app\models\Portonhost;

class IpportChainController extends Controller
{
    public function actionIndex()
    {
        $ports = []; //存放portonhost表里读取的prot
        $l_p = []; //local到peer
        $p_l = []; //peer到local
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

        //取出所有侦听的端口，存入ports
        $rows = Portonhost::find()->select('port')->asArray()->all();
        foreach($rows as $row){
            if(!isset($ignorePort[$row['port']]))
                $ports[$row['port']] = 1;
        }
        unset($rows);
        unset($row);

        //取出所有chain
        $rows = IpportChain::find()->select('local_ip,local_port,peer_ip,peer_port')->where(['>', 'times', 2])->asArray()->all();
        foreach($rows as $row){
            if(isset($ports[$row['local_port']])){
                $l_p[$row['local_ip']][$row['peer_ip']] = 1;
                $p_l[$row['peer_ip']][$row['local_ip']] = 1;
            }
        }
        unset($rows);
        unset($row);

        foreach($l_p as $k=>$v){
            var_dump($k);
            var_dump(count($v));
        }
    }
}
