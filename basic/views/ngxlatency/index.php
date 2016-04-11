<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NgxlatencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nginx调用后端耗时';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxlatency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('查看每日统计', ['/ngxlatencyday'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'time',
            'ip',
            'uri',
            'num',
            'min',
            'avg',
            'max',
            //'t100',
            //'t200',
            //'t500',
            //'t1000',
            //'t3000',
            //'tt',
            'pt100',
            'pt200',
            'pt500',
            'pt1000',
            'pt3000',
            'ptt',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
