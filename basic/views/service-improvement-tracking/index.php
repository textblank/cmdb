<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ServiceImprovementTracking;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceImprovementTrackingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '服务问题跟踪';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-improvement-tracking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'find_date',
            'name',
            'intro',
            ['attribute' => 'type', 'format' => 'html', 'filter' => ServiceImprovementTracking::$typeList, 'value' => function($model){
                return $model->typeText();
            }, 'filterInputOptions' => ['prompt' => '所有', 'class' => 'form-control']],
            'owner',
            'plan_date',
            'query_count',
            ['attribute' => 'fail_count', 'format' => 'html', 'value' => function($model){
                return $model->failCountText();
            }],
            ['attribute' => 'fail_rate', 'format' => 'html', 'value' => function($model){
                return $model->failRateText();
            }],
            ['attribute' => 'latency', 'format' => 'html', 'value' => function($model){
                return $model->latencyText();
            }],
            // 'timeout_rate',
            // 'employee_id',
            'plan',
            'finish_date',
            ['attribute' => 'status', 'format' => 'html', 'filter' => ServiceImprovementTracking::$statusList, 'value' => function($model){
                return $model->statusText();
            }, 'filterInputOptions' => ['prompt' => '所有', 'class' => 'form-control']],

            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {add-info}',
                'buttons' => [
                    'add-info' => function($url, $model, $key){
                        $url = ['/service-improvement-tracking-info/create', 'parent_id' => $model->id];
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                            'title' => '添加信息',
                        ]) ;
                    },
                ]
            ],
        ],
    ]); ?>

</div>
