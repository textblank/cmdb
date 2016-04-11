<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IpportChainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ipport Chains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipport-chain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ipport Chain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'hostname',
            'local_ip',
            'local_port',
            'peer_ip',
            'peer_port',
            // 'uptime',
            // 'times:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
