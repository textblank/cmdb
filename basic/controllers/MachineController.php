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
class MachineController extends Controller
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
     * 批量变更信息.
     * @return mixed
     */
    public function actionBatchmodify()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new Machine();

        if(isset($_POST['Machine'])) {
            //var_dump($_POST['Machine']);

/*            foreach($_POST['Machine'] as $k => $v) {
                if($k != 'hostname') {
                    $v = trim($v);
                    $k = trim($k);
                    if($v != '') {
                        $model->$k = $v;
                    }
                }
            }
*/

            $hostnames =  isset($_POST['Machine']['hostnames']) ? trim($_POST['Machine']['hostnames']) : '';
            $hostnames = array_map('trim', preg_split("#[\r\n]+#", $hostnames));
            foreach($hostnames as $hostname) {
                if(($hostname == '') or ($hostname == ' '))
                    continue;
                $hostname = preg_replace("/\s/", "", $hostname);

                $ck = Machine::find()->where(['hostname' => $hostname])->all();
                if(count($ck) == 0) {
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
            }
            return $this->redirect(['batchmodify', 'model'=>$model]);
        }

        return $this->render('batch_modify', [
            'model' => $model,
        ]);
    }

    public function actionListall()
    {
        $searchModel = new MachineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list_all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Machine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MachineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Machine model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Machine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new Machine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Machine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Machine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the Machine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Machine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Machine::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
