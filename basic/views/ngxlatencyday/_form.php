<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ngxlatencyday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ngxlatencyday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'uri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput() ?>

    <?= $form->field($model, 't100')->textInput() ?>

    <?= $form->field($model, 't200')->textInput() ?>

    <?= $form->field($model, 't500')->textInput() ?>

    <?= $form->field($model, 't1000')->textInput() ?>

    <?= $form->field($model, 't3000')->textInput() ?>

    <?= $form->field($model, 'tt')->textInput() ?>

    <?= $form->field($model, 'pt100')->textInput() ?>

    <?= $form->field($model, 'pt200')->textInput() ?>

    <?= $form->field($model, 'pt500')->textInput() ?>

    <?= $form->field($model, 'pt1000')->textInput() ?>

    <?= $form->field($model, 'pt3000')->textInput() ?>

    <?= $form->field($model, 'ptt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
