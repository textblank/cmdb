<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HostportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '主机 & 端口';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hostport-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'hostname',
            'ports',
            'uptime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
