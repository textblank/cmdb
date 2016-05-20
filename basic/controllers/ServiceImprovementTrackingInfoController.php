<?php

namespace app\controllers;

use Yii;
use app\models\ServiceImprovementTrackingInfo;
use app\models\ServiceImprovementTrackingInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceImprovementTrackingInfoController implements the CRUD actions for ServiceImprovementTrackingInfo model.
 */
class ServiceImprovementTrackingInfoController extends Controller
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
     * Lists all ServiceImprovementTrackingInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceImprovementTrackingInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceImprovementTrackingInfo model.
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
     * Creates a new ServiceImprovementTrackingInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parent_id)
    {
        $model = new ServiceImprovementTrackingInfo();
        $model->parent_id = $parent_id;
        $model->ctime = date('Y-m-d H:i:s', time());
        $u = Yii::$app->user->getIdentity();
        $model->creator = $u->name;
        $model->creator_id = $u->employee_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/service-improvement-tracking/view', 'id' => $model->parent_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServiceImprovementTrackingInfo model.
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
     * Deletes an existing ServiceImprovementTrackingInfo model.
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
     * Finds the ServiceImprovementTrackingInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceImprovementTrackingInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceImprovementTrackingInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
