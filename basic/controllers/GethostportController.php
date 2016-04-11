<?php

namespace app\controllers;

use Yii;
use app\models\Portonhost;
use yii\web\Controller;

/**
 * HostportController implements the CRUD actions for Hostport model.
 */
class GethostportController extends Controller
{
    public function actionGet($hostname, $ports)
    {
        $time = date("Y-m-d H:i:s");
        $hostname = strtolower(trim($hostname));
        $ports = substr(trim($ports), 1);
        $p1 = explode(",", $ports);
        $pp = "";
        $report_ports = [];
        foreach($p1 as $p2) {
            $p3 = explode(":", $p2);
            $report_ports[$p3[count($p3) - 1]] = 1;
        }

        $read = Portonhost::find()->where('host="'.$hostname.'"')->all();
        if($read) {
            foreach($read as $r) {
                //var_dump($r->port);
                if(isset($report_ports[$r->port])) {
                    $report_ports[$r->port] = 2;
                    ($r->counter < 576) ? ($r->counter++) : ($r->counter = 576);
                    $r->lasttime = $time;
                    $r->update();
                } else {
                    ($r->counter > 0) ? ($r->counter--) : ($r->counter = 0);
                    $r->update();
                }
            }
        }

        if(count($report_ports) > 0) {
            foreach($report_ports as $p=>$v) {
                //var_dump($p);
                if($v == 1) {
                    $in = new Portonhost;
                    $in->host = $hostname;
                    $in->port = $p;
                    $in->counter = 1;
                    $in->lasttime = $time;
                    $in->firsttime = $time;
                    $in->save();
                }
            }
        }
    }
}
