<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dnsipdetectsums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dnsipdetectsum-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('中国电信', ['index', 'net'=>'chinanet'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('中国联通', ['index', 'net'=>'unicom'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('中国移动', ['index', 'net'=>'chinamobile'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'province',
            'net',
            'min',
            'avg',
            'max',
            'lost',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
