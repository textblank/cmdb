<?php

namespace app\controllers;

use Yii;
use app\models\Biz;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BizController implements the CRUD actions for Biz model.
 */
class BizController extends Controller
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
     * Lists all Biz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Biz::find()->where("level = 1 and status = 1"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2($l1id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Biz::find()->where("l1id = $l1id and level = 2 and status = 1"),
        ]);

        $l1data = Biz::findOne($l1id);

        return $this->render('index2', [
            'dataProvider' => $dataProvider,
            'l1data' => $l1data,
        ]);
    }

    public function actionIndex3($l1id, $l2id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Biz::find()->where("l2id = $l2id and level = 3 and status = 1"),
        ]);

        $l1data = Biz::findOne($l1id);
        $l2data = Biz::findOne($l2id);

        return $this->render('index3', [
            'dataProvider' => $dataProvider,
            'l1data' => $l1data,
            'l2data' => $l2data,
        ]);
    }

    /**
     * Displays a single Biz model.
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
     * Creates a new Biz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new Biz();
        $model->level = 1;
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate2($l1id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $l1 = Biz::findOne($l1id);
        $model = new Biz();
        $model->l1id = $l1id;
        $model->level = 2;
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create2', [
                'l1' => $l1,
                'model' => $model,
            ]);
        }
    }

    public function actionCreate3($l1id, $l2id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $l1 = Biz::findOne($l1id);
        $l2 = Biz::findOne($l2id);
        $model = new Biz();
        $model->l1id = $l1id;
        $model->l2id = $l2id;
        $model->level = 3;
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create3', [
                'l1' => $l1,
                'l2' => $l2,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Biz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

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
     * Deletes an existing Biz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetbiz1()
    {
        $query = Biz::find();
        $result = $queryselect('id, cname')->where(['level'=>1, 'status' => 1])->asArray()->all();
        if($result) {
            return json_encode($result);
        } else {
            return json_encode([]);
        }
    }

    public function actionGetbiz2($id)
    {
        $query = Biz::find();
        $result = $query->select('id, cname')->where(['l1id'=>$id, 'level'=>2, 'status' => 1])->asArray()->all();
        if($result) {
            return json_encode($result);
        } else {
            return json_encode([]);
        }
    }

    public function actionGetbiz3($id)
    {
        $query = Biz::find();
        $result = $query->select('id, cname')->where(['l2id'=>$id, 'level'=>3, 'status' => 1])->asArray()->all();
        if($result) {
            return json_encode($result);
        } else {
            return json_encode([]);
        }
    }

    /**
     * 返回json格式的列表
     * @param integer $id
     * @return json格式的biz列表
     */
    public function actionGetAll()
    {
        $data = [];
        $all = Biz::find()->where(['status' => 1])->orderBy("level, cname")->all();
        if($all){
            foreach($all as $row){
                $kv[$row->id] = $row->cname;
                $level[$row->level][] = $row->id;
                switch ($row->level) {
                    case 2:
                        $data[] = [$row->cname, $row->id, $row->l1id];
                        break;

                    case 3:
                        $data[] = [$row->cname, $row->id, $row->l2id];
                        break;
                    
                    default:
                        $data[] = [$row->cname, $row->id, 0];
                        break;
                }
            }
        }

        return json_encode($data);
    }

    /**
     * Finds the Biz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Biz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Biz::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
