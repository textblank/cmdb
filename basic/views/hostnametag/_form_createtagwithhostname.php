<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HostnameTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hostname-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => true, 'readOnly' => true, 'value' => $hostname]) ?>

    <?= $form->field($model, 'tags')->label('Tag，多个tag请用英文逗号分割')->checkboxList($tags) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
