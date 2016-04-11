<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建标签', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
