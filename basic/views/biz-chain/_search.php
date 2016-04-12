<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BizChainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biz-chain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'local_biz_id') ?>

    <?= $form->field($model, 'local_biz_name') ?>

    <?= $form->field($model, 'peer_biz_id') ?>

    <?= $form->field($model, 'peer_biz_name') ?>

    <?php // echo $form->field($model, 'num') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
