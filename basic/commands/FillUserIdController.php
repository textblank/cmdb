<?php
/**
 * 补写表里的employee_id
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Service;
use app\models\User;


class FillUserIdController extends Controller
{

    public function actionService()
    {
        $wrongName = [];
        $services = Service::find()->where(['!=','owner',''])->andWhere(['employee_id'=>null])->all();
        if(count($services)>0){
            foreach($services as $service){
                $ids = [];
                $names = explode(',', $service->owner);
                foreach ($names as $name) {
                    $user = User::find()->select('employee_id')->where(['name'=>$name])->one();
                    if($user){
                        var_dump($user->employee_id);
                        $ids[] = $user->employee_id;
                    } else {
                        $wrongName[] = $name;
                    }
                }
                $service->employee_id = join(',', $ids);
                $service->save();
            }
            echo "错误的名字\n";
            var_dump($wrongName);
        }
    }
}
