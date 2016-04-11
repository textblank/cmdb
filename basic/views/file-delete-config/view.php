<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileDeleteConfig */

$this->title = '查看日志清理配置 - '.$model->hostname;
$this->params['breadcrumbs'][] = ['label' => 'File Delete Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-delete-config-view">

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
            'type',
            'path',
            'threshold',
            'matching',
        ],
    ]) ?>

</div>
