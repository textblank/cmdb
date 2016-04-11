<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IpportChainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ipport-chain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hostname') ?>

    <?= $form->field($model, 'local_ip') ?>

    <?= $form->field($model, 'local_port') ?>

    <?= $form->field($model, 'peer_ip') ?>

    <?php // echo $form->field($model, 'peer_port') ?>

    <?php // echo $form->field($model, 'uptime') ?>

    <?php // echo $form->field($model, 'times') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
