<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IpportChain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ipport Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipport-chain-view">

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
            'hostname',
            'local_ip',
            'local_port',
            'peer_ip',
            'peer_port',
            'uptime',
            'times:datetime',
        ],
    ]) ?>

</div>
