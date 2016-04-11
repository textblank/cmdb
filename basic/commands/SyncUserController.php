<?php
/**
 * 定时从接口获取所有用户信息，将北研的入user表
 */

namespace app\commands;

use yii\console\Controller;
use app\models\User;


class SyncUserController extends Controller
{

    public function actionIndex()
    {
        $time = time();
        $handle = fopen("https://www.fxiaoke.com/H/circle/getAllEmployees1?traceId=O-E.fs.0-94493302&keyword=&pageSize=20000&pageNumber=1&circleID=0&userRole=0&isStop=0&isExceptCurrentUser=false&isFirstChar=false&_=".$time, "rb");
        $content = "";
        while (!feof($handle)) {
            $content .= fread($handle, 10000);
        }
        fclose($handle);

        $content = json_decode($content);
        var_dump($content);
    }
}
