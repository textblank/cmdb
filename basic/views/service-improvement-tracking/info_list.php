<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="service-improvement-tracking-info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('增加跟进信息', ['/service-improvement-tracking-info/create', 'parent_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'parent_id',
            'info:ntext',
            // 'creator_id',
            'creator',
            'ctime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {add-info}',
                'buttons' => [
                    'update' => function($url, $model, $key){
                        $url = ['/service-improvement-tracking-info/update', 'id' => $model->id];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => '添加信息',
                        ]) ;
                    },
                    'delete' => function($url, $model, $key){
                        $url = ['/service-improvement-tracking-info/delete', 'id' => $model->id];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => '删除',
                            'data-method' => 'post',
                            'data-confirm' => true,
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
