<?php

namespace app\controllers;

use Yii;
use app\models\Machine;
use app\models\MachineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MachineController implements the CRUD actions for Machine model.
 */
class AutofindController extends Controller
{

    public function actionIndex()
    {
        if(isset($_POST['Machine'])) {
            if ((Machine::findOne(['hostname' => $hostname])) === null) {
                $insert = new Machine();
            } else {
                $insert = Machine::findOne(['hostname' => $hostname]);
            }

            foreach($_POST['Machine'] as $k => $v) {
                if($k != 'hostname') {
                    $v = trim($v);
                    $k = trim($k);
                    if($v != '') {
                        $insert->$k = $v;
                    }
                }
            }
            $insert->hostname = $hostname;
            $insert->save();
            return "Success: ok";
        }

        return "Error: nothing recieved";
    }
}
