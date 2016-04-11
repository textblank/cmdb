<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ngxlatencyday */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ngxlatencydays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxlatencyday-view">

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
            'date',
            'uri',
            'num',
            't100',
            't200',
            't500',
            't1000',
            't3000',
            'tt',
            'pt100',
            'pt200',
            'pt500',
            'pt1000',
            'pt3000',
            'ptt',
        ],
    ]) ?>

</div>
