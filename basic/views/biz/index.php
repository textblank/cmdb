<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '一级业务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建一级业务', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                  'template' => '{view} {update} {delete} {index2} {add}',
                  'buttons' => [
                        'index2' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['biz/index2', 'l1id' => $model->id]);
                              //$url = '/index.php?r=hostname/viewbyhostname&hostname='.$model->hostname;
                              $options = [
                                    'title' => '查看下级业务',
                                    'data-pjax' => '0',
                              ];
                              return Html::a('<span class="glyphicon glyphicon-th-list"></span>', $url, $options);
                        },
                        'add' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['biz/create2', 'l1id' => $model->id]);
                              //$url = '/index.php?r=hostname/viewbyhostname&hostname='.$model->hostname;
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
