<?php

namespace app\controllers;

use Yii;
use app\models\HostnameTag;
use app\models\HostnameTagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\Tags;
use app\models\Machine;

/**
 * HostnametagController implements the CRUD actions for HostnameTag model.
 */
class HostnametagController extends Controller
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

    public function actionBatchmodifytag()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new HostnameTag();

        $model_tag = new Tags();
        $tags = $model_tag->getTags();

        if(isset($_POST['HostnameTag'])) {
            $hostnames =  isset($_POST['HostnameTag']['hostnames']) ? trim($_POST['HostnameTag']['hostnames']) : '';
            $hostnames = array_map('trim', preg_split("#[\r\n]+#", $hostnames));

            foreach($hostnames as $hostname) {
                if(($hostname == '') or ($hostname == ' '))
                    continue;
                $hostname = preg_replace("/\s/", "", $hostname);

                //检查hostname是否在machnie表里
                $ck = Machine::find()->where(['hostname' => $hostname])->all();
                if(count($ck) == 0)
                    continue;

                $tags2 = $_POST['HostnameTag']['tags'];
                if(count($tags2) > 0) {
                    //检查hostnametag表里是否已有
                    foreach($tags2 as $k => $tag) {
                        $ck2 = HostnameTag::find()->where(['hostname' => $hostname, 'tag' => $tag])->all();
                        if(count($ck2) > 0)
                            continue;

                        $insert = new HostnameTag();
                        $insert->hostname = $hostname;
                        $insert->tag = $tag;
                        $insert->save();
                    }

                }
            }
            return $this->redirect(['batchmodifytag', 'model'=>$model, 'tags' => $tags]);

        } else {
            return $this->render('batch_create', ['model'=>$model, 'tags' => $tags]);
        }
    }

    /**
     * Lists tags by hostname.
     * @return mixed
     */
    public function actionListtagbyhostname($hostname)
    {
        $searchModel = new HostnameTagSearch(['hostname' => $hostname]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listtagbyhostname', [
            'thisName' => $hostname,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionListhostnamebytag($tag)
    {
        $searchModel = new HostnameTagSearch(['tag' => $tag]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listhostnamebytag', [
            'thisName' => $tag,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionCreatetagwithhostname($hostname)
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new HostnameTag();

        $model_tag = new Tags();
        $tags = $model_tag->getTags();

        if(isset($_POST['HostnameTag']['tags'])) {
            $hostname = $_POST['HostnameTag']['hostname'];
            //$tags = explode(',', trim($_POST['HostnameTag']['tags']));
            $tags2 = $_POST['HostnameTag']['tags'];
            foreach($tags2 as $tag) {
                $tag = trim($tag);
                if($tag == '') {
                    continue;
                } else {
                    $query = new Query();
                    $query->select('id')->from('hostnametag')->where('hostname="'.$hostname.'" and tag="'.$tag.'"');
                    $ck = $query->count();
                    if($ck == 0) {
                        //写入hostnametag
                        $insert = new HostnameTag();
                        $insert->hostname = $hostname;
                        $insert->tag = $tag;
                        $insert->save();
                        //新tag写入tags
                        $query1 = new Query();
                        $query1->select('id')->from('tags')->where('tag="'.$tag.'"');
                        $ck1 = $query1->count();
                        if($ck1 == 0){
                            $insertTag = new Tags();
                            $insertTag->tag = $tag;
                            $insertTag->save();
                        }
                    }
                }
            }
                return $this->redirect(['listtagbyhostname', 'hostname'=>$hostname, 'tags'=>$tags]);

        } else {
            return $this->render('createtagwithhostname', ['model'=>$model, 'hostname' => $hostname, 'tags'=>$tags]);
        }
    }

    /**
     * Lists all HostnameTag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HostnameTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HostnameTag model.
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
     * Creates a new HostnameTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new HostnameTag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HostnameTag model.
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
     * Deletes an existing HostnameTag model.
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
     * Finds the HostnameTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HostnameTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HostnameTag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
