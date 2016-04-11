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

    <p>
        <?= Html::a('为'.$thisName.'添加tag', ['createtagwithhostname', 'hostname'=>$thisName], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'hostname',
            'tag',

            ['class' => 'yii\grid\ActionColumn',
                  'template' => '{view}{update}{delete}{tag}',
                  'buttons' => [
                        'tag' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['hostnametag/listhostnamebytag', 'tag' => $model->tag]);
                              //$url = '/index.php?r=hostname/viewbyhostname&hostname='.$model->hostname;
                              $options = [
                                    'title' => '查看tag下的机器',
                                    'data-pjax' => '0',
                              ];
                              return Html::a('<span class="glyphicon glyphicon-gift"></span>', $url, $options);
                        },
                  ]
            ],
        ],
    ]); ?>

</div>
