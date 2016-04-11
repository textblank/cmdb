<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Ngxcodetop;
use app\models\Ngxcoderecord;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MakeNgxCodeTopController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($date='', $date2='')
    {
    	if(($date == '') || ($date2 == '')){
	        $date = date("Y-m-d", time()-86400);
	        $date2 = date("Ymd", time()-86400);
	    }
        $begin = $date2."000000";
        $end = $date2."235959";
        echo $date."\n";
        echo $begin."\n";
        echo $end."\n";

        $del = Ngxcodetop::deleteAll('date = "'.$date.'"');
	if(!$del){
		//var_dump($del->getErrors());
	}

        $uris = [];
        $uriNum = [];
        $srcs = Ngxcoderecord::find()->select(['num', 'uri'])->where(['>=', 'time', $begin])->andWhere(['<=', 'time', $end])->andWhere(['<>', 'uri', '172.17.20.252:19990'])->all();
        if($srcs){
        	foreach($srcs as $src){
        		isset($uriNum[$src->uri]) ? $uriNum[$src->uri] += intval($src->num/2+0.5) : $uriNum[$src->uri] = intval($src->num/2+0.5);
        	}
        }

        arsort($uriNum);

        $i = 0;
        foreach($uriNum as $uri => $num){
        	if($i >= 10)
        		break;

		if(strpos($uri, '0.0') !== 0)
			$i++;
		else
			continue;

        	$in = new Ngxcodetop();
        	$in->date = $date;
        	$in->num = $num;
        	$in->uri = $uri;
        	$in->save();
        }

    }
}
