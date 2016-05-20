<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceImprovementTrackingInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Improvement Tracking Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-improvement-tracking-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service Improvement Tracking Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            'info:ntext',
            'creator_id',
            'creator',
            // 'ctime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
