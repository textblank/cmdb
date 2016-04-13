<?php

namespace app\controllers;

use Yii;
use app\models\BizChain;
use app\models\BizChainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BizChainController implements the CRUD actions for BizChain model.
 */
class BizChainController extends Controller
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

    public function actionGetJson()
    {
        $data = [];
        $bizs = [];
        $data['nodes'] = [];
        $data['edges'] = [];
        $rows = BizChain::find()->asArray()->all();
        foreach($rows as $row){
            $bizs[$row['local_biz_name']] = $row['local_biz_id'];
            $bizs[$row['peer_biz_name']] = $row['peer_biz_id'];
            $data['edges'][] = [
                'local_biz_id' => $row['local_biz_id'],
                'local_biz_name' => $row['local_biz_name'],
                'peer_biz_id' => $row['peer_biz_id'],
                'peer_biz_name' => $row['peer_biz_name']
            ];
        }

        foreach($bizs as $biz=>$id){
            $data['nodes'][] = [
                'biz' => $biz,
                'id' => $id
            ];
        }

        return json_encode($data);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    /**
     * Lists all BizChain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BizChainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BizChain model.
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
     * Creates a new BizChain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BizChain();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BizChain model.
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
     * Deletes an existing BizChain model.
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
     * Finds the BizChain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BizChain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BizChain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
