<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $l2data["cname"] . '的三级业务';
$this->params['breadcrumbs'][] = ['label' => $l1data["cname"], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $l2data["cname"], 'url' => ['index2', 'l1id' => $l2data["l1id"]]];
$this->params['breadcrumbs'][] = '三级业务';
?>
<div class="biz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'level',
            //'l1id',
            //'l2id',
            'cname',
            'ename',
            'cshortname',
            'eshortname',
            // 'intro:ntext',
            // 'status',

            [
                'class' => 'yii\grid\ActionColumn',
                  'template' => '{view} {update} {delete}',
                  'buttons' => [
                        'add' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['biz/create3', 'l1id' => $model->l1id, 'l2id' => $model->id]);
                              $options = [
                                    'title' => '增加下级业务',
                                    'data-pjax' => '0',
                              ];
                              return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
                        },
                  ]
            ],
        ],
    ]); ?>

</div>
