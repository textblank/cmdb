<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OpDoc */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '业务运维文档', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="op-doc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            //'id',
            'title',
            //'owner_id',
            ['attribute' => 'busi1Id', 'value' => $model->busi1Id ? $model->biz1->cname : '-'],
            ['attribute' => 'busi2Id', 'value' => $model->busi2Id ? $model->biz2->cname : '-'],
            ['attribute' => 'busi3Id', 'value' => $model->busi3Id ? $model->biz3->cname : '-'],
            ['attribute' => 'content', 'format' => 'raw'],
            'owner_name',
            'create_time',
            'last_name',
            'last_time'
        ],
    ]) ?>

</div>
