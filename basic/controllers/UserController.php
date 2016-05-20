<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Cutf8Py;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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

    public function actionNameZh($key = '')
    {
        $py = new Cutf8Py();
        $data = [];

        $q = User::find()->all();
        foreach($q as $r){
            $r->py = $py->encode($r->name);
            $r->save();
            $data[$r->py] = $r->name;
        }
        var_dump($data);
    }

    public function actionJsonUserId($q = '')
    {
        $data = User::getNameByKey($q);
        return json_encode($data);
    }

    public function actionJsonHeaderUserId($q = '')
    {
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return User::getNameByKey($q);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionBatchInput()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        if(isset($_POST['Users'])){
            $py = new Cutf8Py();
            $ok = [];
            $no = [];
            $in = [];
            $list =  isset($_POST['Users']['list']) ? trim($_POST['Users']['list']) : '';
            $fp = fopen('data://text/plain,'. $list, 'r');
            while(!feof($fp)){
                $line = fgetcsv($fp);
                $ck = User::find()->where(['username' => $line[0]])->one();
                if($ck){
                    $in[] = implode('","', $line);
                    continue;
                } else {
                    $user = new User();
                    $user->username = $line[0];
                    $user->employee_id = $line[4];
                    $user->name = $line[1];
                    $user->py = $py->encode($user->name);
                    $user->email = $line[3];
                    $user->mobile = $line[2];
                    $user->department = $line[5];
                    if($user->save()){
                        $ok[] = implode('","', $line);
                    } else {
                        $no[] = implode('","', $line);
                    }
                }
                $line = null;
            }

            return $this->render('result',['ok'=>$ok, 'no'=>$no, 'in'=>$in]);

        } else {
            return $this->render('batch_input');
        }
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }

        $model = new User();
        $py = new Cutf8Py();

        if ($model->load(Yii::$app->request->post())){
            $model->py = $py->encode($model->name);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
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
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * 批量导入用户，已有的不变，没有的增加，只接受北研的
     */
    public function actionBatchInput2()
    {
        if(Yii::$app->user->isGuest){
            return Yii::$app->user->loginRequired();
        }
        
        $py = new Cutf8Py();

        if (isset($_POST['User'])) {
            //var_dump($_POST['User']['list']);
            $ok = [];
            $mod = [];
            $del = [];
            $no = [];
            $list = json_decode($_POST['User']['list'], true);
            foreach($list['value']['items'] as $item){
                if(strpos($item['department'], '研')!==false){
                    //var_dump($item['name']);
                    //if($item['isOpen'] == true){
                        $ck = User::find()->where(['employee_id'=>$item['employeeID']])->one();
                        if($ck){
                            $ck->username = $item['account'];
                            $ck->name = $item['name'];
                            $ck->email = $item['email'];
                            $ck->mobile = $item['mobile'];
                            //$ck->py = $py->encode($item['name']);
                            $ck->department = $item['department'];
                            $ck->on_use = 1;
                            if($ck->save())
                                $mod[] = $ck->name;
                            else
                                $no[] = $ck->name;
                        } else {
                            $in = new User;
                            $in->employee_id = $item['employeeID'];
                            $in->username = $item['account'];
                            $in->name = $item['name'];
                            $in->email = $item['email'];
                            $in->mobile = $item['mobile'];
                            if($item['name'] == '刘雨濛')
                                $in->py = 'lym';
                            else
                                $in->py = $py->encode($item['name']);
                            $in->department = $item['department'];
                            $in->on_use = 1;
                            if($in->save())
                                $ok[] = $in->name;
                            else
                                $no[] = $in->name;
                        }
                    //} else {
                    //    var_dump($item['fullName']);
                    //    var_dump($item['employeeID']);
                    //    $dl = User::find()->where(['employee_id'=>$item['employeeID']])->one();
                    //    if($dl){
                    //        $del[] = $dl->name;
                    //        $dl->delete();
                    //    }
                    //}
                }
            }

            return $this->render('result2', [
                'ok' => $ok,
                'mod' => $mod,
                'del' => $del,
                'no' => $no
                ]);
        } else {
            $model = new User;
            return $this->render('batch_input2', [
                'model' => $model,
                ]);

        }

    }

}
