<?php

namespace app\controllers;

use Yii;
use app\models\FileDeleteConfig;
use yii\web\Controller;

/**
 * HostportController implements the CRUD actions for Hostport model.
 */
class GetdelfilecfgController extends Controller
{
    public function actionIndex($hostname)
    {
        $time = date("Y-m-d H:i:s");
        $hostname = strtolower(trim($hostname));

        $data = '';
        $read = FileDeleteConfig::find()->where('hostname="'.$hostname.'"')->all();
        if($read) {
            foreach($read as $r) {
                $data .= $r->type.":".$r->path.":".$r->threshold.":".$r->matching."\n";
            }
        }

        return $data;
    }
}
