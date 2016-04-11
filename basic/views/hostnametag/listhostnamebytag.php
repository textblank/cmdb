<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HostnameTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hostname Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hostname-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tag',
            'hostname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
