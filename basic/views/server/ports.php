<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PortonhostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="portonhost-index">

    <h1><?= Html::encode('机器端口') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'hostname',
            'user',
            'port',
            'processname',
            'cmdline',
            //['attribute' => 'server_owner', 'value' => 'server.devAdmin'],
            'lasttime',
            'firsttime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
