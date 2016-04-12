<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BizChainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biz Chains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biz-chain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Biz Chain', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'local_biz_id',
            'local_biz_name',
            'peer_biz_id',
            'peer_biz_name',
            // 'num',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
