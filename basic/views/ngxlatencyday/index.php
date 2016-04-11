<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NgxlatencydaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '每日接口耗时统计';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxlatencyday-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('查看实时情况', ['/ngxlatency'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            'uri',
            'num',
            // 't100',
            // 't200',
            // 't500',
            // 't1000',
            // 't3000',
            // 'tt',
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
