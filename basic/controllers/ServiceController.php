<?php

namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UpdateTime;
use app\models\User;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    public $enableCsrfValidation = false;

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

    //给open-falcon用的接口，获取所有信息
    public function actionGetAllInfo()
    {

        $data = [];
        $data['msg'] = 'no info';
        $data['serviceinfos'] = [];
        $rows = Service::find()->all();
        if($rows){
            foreach($rows as $row){
                if($row->employee_id != NULL && $row->owner != ''){
                    $owners = [];
                    $devs = explode(',', $row->owner);
                    $ids = explode(',', $row->employee_id);
                    foreach($ids as $i=>$id){
                        if(isset($devs[$i])){
                            $owners[] = [
                                'id' => $id,
                                'name' => $devs[$i]
                            ];
                        }
                    }
                    $data['msg'] = '';
                    $data['serviceinfos'][] = [
                        'service' => $row->service,
                        'owners' => $owners,
                        'desc' => $row->info,
                    ];
                } else {
                    continue;
                }
            }
        } else {
            $data['msg'] = 'no info';
        }
        //var_dump($data);
        return json_encode($data);
    }

    //给oss用的接口，获取所有信息
    public function actionGetAll($stamp = 0)
    {

        $data = [];
        $data['items'] = [];

        if($stamp == 0){
            $data['code'] = 400;
            $data['message'] = '缺少参数';
            return json_encode($data);
            Yii::end();
        }

        //检查是否有更新
        $ck = UpdateTime::find()->where(['table_name' => 'service'])->one();
        if($ck && $ck->uptime > $stamp){

            $services = Service::find()->all();
            if($services){
                $row = [];
                foreach($services as $service){
                    $row['service'] = trim($service['service']);
                    $row['owner']   = trim($service['owner']);
                    $row['info']    = trim($service['info']);
                    $data['items'][] = $row;
                }
            }
            $data['code'] = 200;
            $data['message'] = 'ok';
            return json_encode($data);
            Yii::end();

        } else {
            $data['code'] = 304;
            $data['message'] = '没有更新';
            return json_encode($data);
            Yii::end();
        }
    }

    /*
     * 给lirui调用的修改负责人和info的接口
     * method: post
     * params: service(string), owner(string),逗号分割
     * response: code, message
     */
    public function actionModify()
    {

        $data = [];

        /*if(count($_POST)<1){
            $data['code'] = 400;
            $data['message'] = '缺少参数';
            var_dump($_POST);
            return json_encode($data);
            Yii::end();
        }*/

        $f = file_get_contents("php://input");
        if(count($f)<1){
            $data['code'] = 400;
            $data['message'] = '缺少参数';
            return json_encode($data);
            Yii::end();
        }

        foreach(json_decode($f) as $item){

            //检查用户名是否合法
            $employee_id = $this->getId($item->owner);
            if(!$employee_id) {
                $data['code'] = 400;
                $data['message'] = 'owner wrong';
                return json_encode($data);
            }

            $ck = Service::find()->where(['service' => $item->service])->one();
            if($ck){
                $ck->owner = $item->owner;
                $ck->employee_id = $employee_id;
                $ck->info = $item->info;
                $ck->update();
            } else {
                $in = new Service();
                $in->service = $item->service;
                $in->owner = $item->owner;
                $in->employee_id = $employee_id;
                $in->info = $item->info;
                $in->save();
            }
        }

        $updateTime = UpdateTime::find()->where(['table_name' => 'service'])->one();
        $updateTime->uptime = time();
        $updateTime->save();

        $data['code'] = 200;
        $data['message'] = 'ok';
        return json_encode($data);
    }

    public function getId($owners)
    {
        $ids = [];
        $us = explode(',', $owners);
        foreach($us as $u){
            $c = User::find()->where(['name' => trim($u)])->one();
            if(!$c){
                return false;
            } else {
                $ids[] = $c->employee_id;
            }
        }
        return implode(',', $ids);

    }


    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Service model.
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
     * Deletes an existing Service model.
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
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
