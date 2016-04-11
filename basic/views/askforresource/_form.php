<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Askforresource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askforresource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>

    <?= $form->field($model, 'neworexpansion')->dropDownList(['扩容'=>'扩容','新增'=>'新增'],
                                              ['prompt'=>'请选择','style'=>'width:120px']) ?>

    <?= $form->field($model, 'purpose')->textarea(['rows' => 6, 'style' => 'width:600px']) ?>

    <?= $form->field($model, 'os')->dropDownList(['linux'=>'linux','windows'=>'windows'],
                                              ['prompt'=>'请选择','style'=>'width:120px']) ?>

    <?= $form->field($model, 'osver')->dropDownList(['centos6.5'=>'centos 6.5','windows server 2012 R2 Standard'=>'windows server 2012 R2 Standard'],
                                              ['prompt'=>'请选择','style'=>'width:220px']) ?>

    <?= $form->field($model, 'machineType')->dropDownList(['2'=>'虚机','1'=>'实机'],
                                              ['style'=>'width:120px']) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'cpu')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'mem')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'sysdisk')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'userdisk')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'insideBandwidth')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'outsideBandwidth')->textInput(['maxlength' => true, 'style' => 'width:100px']) ?>

    <?= $form->field($model, 'expectDate')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>

    <?= $form->field($model, 'explan')->textarea(['rows' => 6, 'style' => 'width:600px']) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => true, 'style' => 'width:600px']) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
