<?php

namespace app\controllers;

use Yii;
use app\models\Maintenance;
use app\models\MaintenanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Server;

/**
 * MaintenanceController implements the CRUD actions for Maintenance model.
 */
class MaintenanceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Maintenance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaintenanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Maintenance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    //批量设置机器维护信息
   public function actionCreate()
   {
       if(Yii::$app->user->isGuest){
           return Yii::$app->user->loginRequired();
       }
       
       $model = new Maintenance();

       if(isset($_POST['selection'])){
          $model->hostnames = implode(",", $_POST['selection']);
       }

       if(isset($_POST['Maintenance'])) {
            $ok = [];
            $no = [];

            $identity = Yii::$app->user->identity;
            $hostnames =  isset($_POST['Maintenance']['hostnames']) ? trim($_POST['Maintenance']['hostnames']) : '';
            foreach(explode(',', $hostnames) as $hostname) {
                if(($hostname == '') or ($hostname == ' ')) {
                    $no[] = $hostname;
                    continue;
                }

                $hostname = preg_replace("/\s/", "", $hostname);
                $in = new Maintenance();
                $in->hostname = $hostname;
                $in->ip = $this->hostname2ip($hostname);
                $in->start_time = $_POST['Maintenance']['start_time'];
                $in->end_time = $_POST['Maintenance']['end_time'];
                $in->reson = $_POST['Maintenance']['reson'];
                $in->user_id = $identity->employee_id;
                $in->status = 0;
                if(!$in->save()){
                    $no[] = $hostname;
                } else {
                    $ok[] = $hostname;
                }
           }
           return $this->render('/server/result', ['ok'=>$ok, 'no'=>$no]);
       }

       return $this->render('_form', [
           'model' => $model,
       ]);
    }

    /**
     * Updates an existing Maintenance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Maintenance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Maintenance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Maintenance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Maintenance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function hostname2ip($b)
    {
        if(strlen($b)<=23){
            $bb3 = intval(substr($b, 4, 3));
            $bb4 = intval(substr($b, 7, 3));
            $ip = '172.17.'.$bb3.'.'.$bb4;
        } else {
            $bb2 = intval(substr($b, 4, 3));
            $bb3 = intval(substr($b, 7, 3));
            $bb4 = intval(substr($b, 10, 3));
            $ip = '10.'.$bb2.'.'.$bb3.'.'.$bb4;
        }

        return $ip;
    }
}
