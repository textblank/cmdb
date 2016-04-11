<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AskforresourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '资源申请';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askforresource-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('提交申请', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'product',
            'module',
            'owner',
            'neworexpansion',
            'purpose:ntext',
            'os',
            'osver',
            'machineType',
            'num',
            'cpu',
            'mem',
            'sysdisk',
            'userdisk',
            //'insideBandwidth',
            //'outsideBandwidth',
            'expectDate',
            //'explan:ntext',
            'memo',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
