<?php

namespace app\controllers;

use Yii;
use app\models\Portonhost;
use yii\web\Controller;

/**
 * HostportController implements the CRUD actions for Hostport model.
 */
class ReceiveHostPortController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionGet($hostname, $user, $port, $processname, $cmdline)
    {
        $time = date("Y-m-d H:i:s");
        $hostname = trim($_GET['hostname']);
        $user = trim($_GET['user']);
        $port = trim($_GET['port']);
        $processname = trim($_GET['processname']);
        $cmdline = trim($_GET['cmdline']);

        if($port == '')
            exit;

        $ck = Portonhost::find()->where(['hostname'=>$hostname, 'port'=>$port, 'processname'=>$processname])->one();
        if($ck){
            $ck->lasttime = $time;
            $ck->save();
        } else {
            $in = new Portonhost();
            $in->hostname = $hostname;
            $in->user = $user;
            $in->port = $port;
            $in->processname = $processname;
            $in->cmdline = $cmdline;
            $in->lasttime = $time;
            $in->firsttime = $time;
            $in->save();
        }

    }
    
    public function actionPost()
    {
        if($_POST){
            var_dump($_POST);
            $time = date("Y-m-d H:i:s");
            $hostname = trim($_POST['hostname']);
            $user = trim($_POST['user']);
            $port = trim($_POST['port']);
            $processname = trim($_POST['processname']);
            $cmdline = trim($_POST['cmdline']);

            if($port == '')
                exit;

            $ck = Portonhost::find()->where(['hostname'=>$hostname, 'port'=>$port, 'processname'=>$processname])->one();
            if($ck){
                $ck->lasttime = $time;
                $ck->cmdline = $cmdline;
                $ck->save();
            } else {
                $in = new Portonhost();
                $in->hostname = $hostname;
                $in->user = $user;
                $in->port = $port;
                $in->processname = $processname;
                $in->cmdline = $cmdline;
                $in->lasttime = $time;
                $in->firsttime = $time;
                $in->save();
            }
        }

    }
}
