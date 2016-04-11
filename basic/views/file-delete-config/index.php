<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileDeleteConfigDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志清理配置列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-delete-config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建新的日志清理规则', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'hostname',
            'type',
            'path',
            'threshold',
            'matching',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
