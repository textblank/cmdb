<?php

namespace app\controllers;

use Yii;
use app\models\FileDeleteConfig;
use app\models\FileDeleteConfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FileDeleteConfigController implements the CRUD actions for FileDeleteConfig model.
 */
class FileDeleteConfigController extends Controller
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
     * Lists all FileDeleteConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileDeleteConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FileDeleteConfig model.
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
     * Creates a new FileDeleteConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new FileDeleteConfig();

        if(isset($_POST['FileDeleteConfig'])) {
            $data['type'] = preg_replace("/\s+/", "", $_POST['FileDeleteConfig']['type']);
            if(($data['type'] != 1) && ($data['type'] != 2)){
                Yii::$app->getSession()->setFlash('error', '类型只能是1或2！');
                $this->redirect(['create']);
                Yii::$app->end();
            }
            $data['path'] = preg_replace("/\s+/", "", $_POST['FileDeleteConfig']['path']);
            if($data['path'] == '/') {
                Yii::$app->getSession()->setFlash('error', '路径不能是 / ！');
                $this->redirect(['create']);
                Yii::$app->end();
            }
            $data['threshold'] = preg_replace("/\s+/", "", $_POST['FileDeleteConfig']['threshold']);
            if($data['threshold'] <= 0) {
                Yii::$app->getSession()->setFlash('error', '阈值必须大于0！');
                $this->redirect(['create']);
                Yii::$app->end();
            }
            $data['matching'] = preg_replace("/\s+/", "", $_POST['FileDeleteConfig']['matching']);
            if($data['matching'] == '') {
                Yii::$app->getSession()->setFlash('error', '匹配字串不能是空！');
                $this->redirect(['create']);
                Yii::$app->end();
            }
            $list =  isset($_POST['FileDeleteConfig']['list']) ? trim($_POST['FileDeleteConfig']['list']) : '';
            $fp = fopen('data://text/plain,'. $list, 'r');
            while(!feof($fp)){
                $in = new FileDeleteConfig();
             	$line = fgetcsv($fp);
                if(strlen($line[0]) > 0) {
                    $data['hostname'] = preg_replace("/\s+/", "", strtolower($line[0]));
                }
                $in->hostname = $data['hostname'];
                $in->type = $data['type'];
                $in->path = $data['path'];
                $in->threshold = $data['threshold'];
                $in->matching = $data['matching'];
                $in->creator = Yii::$app->user->getIdentity()->name;
                $in->save();
            }
            Yii::$app->getSession()->setFlash('success', '添加成功！');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FileDeleteConfig model.
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
     * Deletes an existing FileDeleteConfig model.
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

    /**
     * Finds the FileDeleteConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileDeleteConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileDeleteConfig::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
