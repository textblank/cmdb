<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dnsipdetectsum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dnsipdetectsum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min')->textInput() ?>

    <?= $form->field($model, 'avg')->textInput() ?>

    <?= $form->field($model, 'max')->textInput() ?>

    <?= $form->field($model, 'lost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
