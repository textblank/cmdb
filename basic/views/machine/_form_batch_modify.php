<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Machine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostnames')->label('hostnames，每行一个')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'busi1Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'productName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineType')->textInput() ?>

    <?= $form->field($model, 'osName')->textInput() ?>

    <?= $form->field($model, 'entityHostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shelf')->textInput() ?>

    <?= $form->field($model, 'onShelfTime')->textInput() ?>

    <?= $form->field($model, 'needMonitor')->textInput() ?>

    <?= $form->field($model, 'shelfPlace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maintenancePeriod')->textInput() ?>

    <?= $form->field($model, 'currentStatus')->textInput() ?>

    <?= $form->field($model, 'importantLevel')->textInput() ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'networkOperator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyDate')->textInput() ?>

    <?= $form->field($model, 'majorService')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchIp1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchIp2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'swichIp3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchIp4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchIp5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switch6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchPort6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchIp7')->textInput() ?>

    <?= $form->field($model, 'switchPort7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switchBoard7')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
