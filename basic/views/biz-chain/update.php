<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BizChain */

$this->title = 'Update Biz Chain: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Biz Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="biz-chain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
