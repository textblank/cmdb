<?php
/**
 * 每分钟1次，读物maintenance表里尚未执行的维护请求，同时检查请求期限是否到期，解除维护状态
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Maintenance;
use app\models\Server;


class AutoMaintenanceController extends Controller
{

    public function actionIndex()
    {
        echo "begin\n";

        $now = time();
        $nowTime = date("Y-m-d H:i:s");
        echo $nowTime."\n";

        //检查尚未执行的，执行曹祖，变更server状态
        $items = Maintenance::find()->where(['status' => 0])->andWhere(['<', 'start_time', $nowTime])->andWhere(['>', 'end_time', $nowTime])->all();
        if($items){
            foreach($items as $item){
                $server = Server::find()->where(['hostname'=>$item->hostname])->one();
                $server->currentStatus = 2;
                if($server->save()){
                    echo $item->hostname." ok\n";
                }
                $startTime = strtotime($item->start_time);
                $endTime = strtotime($item->end_time);
                var_dump($startTime);
                var_dump($endTime);
            }
        }

        echo "all done\n";

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
