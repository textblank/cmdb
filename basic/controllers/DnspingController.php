<?php

namespace app\controllers;

use Yii;
use app\models\Dnsipdetectsum;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * DnspingController implements the CRUD actions for Dnsipdetectsum model.
 */
class DnspingController extends Controller
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
     * Lists all Dnsipdetectsum models.
     * @return mixed
     */
    public function actionIndex($net="chinanet")
    {
        $net_c = ['chinanet' => '中国电信', 'unicom' => '中国联通', 'chinamobile' => '中国移动'];
        $dataProvider = new ActiveDataProvider([
            'query' => Dnsipdetectsum::find()->where(["net" => $net])->orderBy('province'),
            'pagination' => ['pageSize'=>100],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'net' => $net,
            'net_c' => $net_c,
        ]);
    }

    public function actionGetdata($net="chinanet")
    {
        $areas = ['北京', '广东', '上海', '天津', '重庆', '辽宁', '江苏', '湖北',
                          '四川', '陕西', '河北', '山西', '河南', '吉林', '安徽', '黑龙江',
                          '浙江', '福建', '湖南', '广西', '江西', '贵州', '云南', '西藏',
                          '海南', '甘肃', '宁夏', '青海', '新疆', '香港', '澳门', '台湾',
                          '内蒙古', '山东'];
        $res = [];
        $avg = [];
        $min = [];
        $max = [];
        $lost = [];
        $model = Dnsipdetectsum::find()->where(["net" => $net])->all();
        foreach($model as $m) {
            $avg[$m->province] = $m->avg;
            $min[$m->province] = $m->min;
            $max[$m->province] = $m->max;
            $lost[$m->province] = $m->lost;
        }

        foreach($areas as $a){
            $res[] = [
                'name' => $a,
                'delay' => isset($avg[$a])?$avg[$a]:0, 
                'max_delay' => isset($max[$a])?$max[$a]:0,
                'min_delay' => isset($min[$a])?$min[$a]:0,
                'color' => $this->getColor(isset($avg[$a])?$avg[$a]:0, isset($lost[$a])?$lost[$a]:0),
            ];
        }
        echo json_encode($res);
    }

    private function getColor($delay, $lost){
        $min = 30;
        $max = 80;
        $middle = ($max + $min) / 2;
        $scale = 255 / ($middle - $min);

        //if($lost > 5) {
        //    return '#ff0000';
        //} else {
            if($delay == 0) {
                return '#eeeeee';
            }elseif($delay >= $max){
                return '#ff0000';
            }elseif($delay <= $min){
                return '#00ff00';
            }elseif($delay < $middle){
                return sprintf("#%02xFF00", ($delay - $min) * $scale);
            }else{
                return sprintf("#FF%02x00", 255 - ($delay - $middle) * $scale);
            }
        //}
    }

    /**
     * Displays a single Dnsipdetectsum model.
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
     * Creates a new Dnsipdetectsum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dnsipdetectsum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dnsipdetectsum model.
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
     * Deletes an existing Dnsipdetectsum model.
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
     * Finds the Dnsipdetectsum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dnsipdetectsum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dnsipdetectsum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
