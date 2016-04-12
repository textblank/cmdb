<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BizChain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Biz Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biz-chain-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'local_biz_id',
            'local_biz_name',
            'peer_biz_id',
            'peer_biz_name',
            'num',
        ],
    ]) ?>

</div>
