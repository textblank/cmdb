<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MachineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Machines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('全部信息', ['listall'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('新增机器', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量添加机器', ['machine/batchmodify'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量修改标签', ['hostnametag/batchmodifytag'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'hostname',
            'busi1Id',
            'idc',
            'machineClass',
            'machineType',
            'entityHostname',
            'ip1',
            'opAdmin',
            'devAdmin',
            'shelf',

            [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view}{update}{delete}{tag}',
                  'buttons' => [
                        'tag' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['hostnametag/listtagbyhostname', 'hostname' => $model->hostname]);
                              //$url = '/index.php?r=hostname/viewbyhostname&hostname='.$model->hostname;
                              $options = [
                                    'title' => '变更tag',
                                    'data-pjax' => '0',
                              ];
                              return Html::a('<span class="glyphicon glyphicon-tags"></span>', $url, $options);
                        },
                  ]
            ],
        ],
    ]); ?>

</div>
