<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Machine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineType')->textInput() ?>

    <?= $form->field($model, 'entityHostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assetId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi1Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'productName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuHz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuInfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuNum')->textInput() ?>

    <?= $form->field($model, 'memorySize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskSize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'needMonitor')->textInput() ?>

    <?= $form->field($model, 'opAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shelf')->textInput() ?>

    <?= $form->field($model, 'onShelfTime')->textInput() ?>

    <?= $form->field($model, 'shelfPlace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maintenancePeriod')->textInput() ?>

    <?= $form->field($model, 'majorService')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip7')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'networkOperator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currentStatus')->textInput() ?>

    <?= $form->field($model, 'importantLevel')->textInput() ?>

    <?= $form->field($model, 'osName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speed1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gateway1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'netmask1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mac1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ethernet1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serialNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyDate')->textInput() ?>

    <?= $form->field($model, 'hwInfoReportTime')->textInput() ?>

    <?= $form->field($model, 'lastModify')->textInput() ?>

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
