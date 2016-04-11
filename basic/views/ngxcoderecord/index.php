<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NgxcoderecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nginx 50X 统计记录(最前端接入)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxcoderecord-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'time',
            'ip',
            'code',
            'num',
            ['attribute' => 'uri',
                'format' => 'raw',
                'value' => function($data){
                return sprintf('<a href="http://www.fxiaoke.com%s" target="_blank">%1$s</a>', $data->uri);
            }],
            'upstreamaddr',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
