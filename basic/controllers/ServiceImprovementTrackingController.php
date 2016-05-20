<?php

namespace app\controllers;

use Yii;
use app\models\ServiceImprovementTracking;
use app\models\ServiceImprovementTrackingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ServiceImprovementTrackingInfoSearch;

/**
 * ServiceImprovementTrackingController implements the CRUD actions for ServiceImprovementTracking model.
 */
class ServiceImprovementTrackingController extends Controller
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
     * Lists all ServiceImprovementTracking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceImprovementTrackingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceImprovementTracking model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ServiceImprovementTrackingInfoSearch();
        $searchModel->parent_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ServiceImprovementTracking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceImprovementTracking();
        $model->status = 1;
        $model->find_date = date('Y-m-d', time());
        $model->type = 1;

        if ($model->load(Yii::$app->request->post())){
            $osss = explode("\t", $model->oss);
            $model->name = $osss[0];
            $model->intro = $osss[1];
            $model->query_count = intval($osss[2]);
            $model->fail_count = intval($osss[3]);
            $model->fail_rate = floatval($osss[4]);
            $model->timeout_rate = floatval($osss[5]);
            $model->latency = intval($osss[6]);
            if($model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error', var_dump($model->getErrors()));
                return $this->render('create', [
                    'model' => $model,
                ]); 
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServiceImprovementTracking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', var_dump($model->getErrors()));
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceImprovementTracking model.
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
     * Finds the ServiceImprovementTracking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceImprovementTracking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceImprovementTracking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
