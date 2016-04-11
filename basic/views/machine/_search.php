<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MachineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hostname') ?>

    <?= $form->field($model, 'assetId') ?>

    <?= $form->field($model, 'busi1Id') ?>

    <?= $form->field($model, 'idc') ?>

    <?php // echo $form->field($model, 'machineClass') ?>

    <?php // echo $form->field($model, 'machineType') ?>

    <?php // echo $form->field($model, 'entityHostname') ?>

    <?php // echo $form->field($model, 'ip1') ?>

    <?php // echo $form->field($model, 'ip2') ?>

    <?php // echo $form->field($model, 'ip3') ?>

    <?php // echo $form->field($model, 'ip4') ?>

    <?php // echo $form->field($model, 'ip5') ?>

    <?php // echo $form->field($model, 'ip6') ?>

    <?php // echo $form->field($model, 'ip7') ?>

    <?php // echo $form->field($model, 'opAdmin') ?>

    <?php // echo $form->field($model, 'devAdmin') ?>

    <?php // echo $form->field($model, 'shelf') ?>

    <?php // echo $form->field($model, 'onShelfTime') ?>

    <?php // echo $form->field($model, 'switchIp1') ?>

    <?php // echo $form->field($model, 'switchPort1') ?>

    <?php // echo $form->field($model, 'switchIp2') ?>

    <?php // echo $form->field($model, 'switchPort2') ?>

    <?php // echo $form->field($model, 'swichIp3') ?>

    <?php // echo $form->field($model, 'switchPort3') ?>

    <?php // echo $form->field($model, 'switchIp4') ?>

    <?php // echo $form->field($model, 'switchPort4') ?>

    <?php // echo $form->field($model, 'switchIp5') ?>

    <?php // echo $form->field($model, 'switchPort5') ?>

    <?php // echo $form->field($model, 'switch6') ?>

    <?php // echo $form->field($model, 'switchPort6') ?>

    <?php // echo $form->field($model, 'switchIp7') ?>

    <?php // echo $form->field($model, 'switchPort7') ?>

    <?php // echo $form->field($model, 'networkOperator') ?>

    <?php // echo $form->field($model, 'currentStatus') ?>

    <?php // echo $form->field($model, 'importantLevel') ?>

    <?php // echo $form->field($model, 'osName') ?>

    <?php // echo $form->field($model, 'raid') ?>

    <?php // echo $form->field($model, 'speed7') ?>

    <?php // echo $form->field($model, 'speed6') ?>

    <?php // echo $form->field($model, 'speed5') ?>

    <?php // echo $form->field($model, 'speed4') ?>

    <?php // echo $form->field($model, 'speed3') ?>

    <?php // echo $form->field($model, 'speed2') ?>

    <?php // echo $form->field($model, 'speed1') ?>

    <?php // echo $form->field($model, 'gateway7') ?>

    <?php // echo $form->field($model, 'gateway6') ?>

    <?php // echo $form->field($model, 'gateway5') ?>

    <?php // echo $form->field($model, 'gateway4') ?>

    <?php // echo $form->field($model, 'gateway3') ?>

    <?php // echo $form->field($model, 'gateway2') ?>

    <?php // echo $form->field($model, 'gateway1') ?>

    <?php // echo $form->field($model, 'netmask7') ?>

    <?php // echo $form->field($model, 'netmask6') ?>

    <?php // echo $form->field($model, 'netmask5') ?>

    <?php // echo $form->field($model, 'netmask4') ?>

    <?php // echo $form->field($model, 'netmask3') ?>

    <?php // echo $form->field($model, 'netmask2') ?>

    <?php // echo $form->field($model, 'netmask1') ?>

    <?php // echo $form->field($model, 'mac7') ?>

    <?php // echo $form->field($model, 'mac6') ?>

    <?php // echo $form->field($model, 'mac5') ?>

    <?php // echo $form->field($model, 'mac4') ?>

    <?php // echo $form->field($model, 'mac3') ?>

    <?php // echo $form->field($model, 'mac2') ?>

    <?php // echo $form->field($model, 'mac1') ?>

    <?php // echo $form->field($model, 'ethernet7') ?>

    <?php // echo $form->field($model, 'ethernet6') ?>

    <?php // echo $form->field($model, 'ethernet5') ?>

    <?php // echo $form->field($model, 'ethernet4') ?>

    <?php // echo $form->field($model, 'ethernet3') ?>

    <?php // echo $form->field($model, 'ethernet2') ?>

    <?php // echo $form->field($model, 'ethernet1') ?>

    <?php // echo $form->field($model, 'memorySize') ?>

    <?php // echo $form->field($model, 'diskSize') ?>

    <?php // echo $form->field($model, 'disks') ?>

    <?php // echo $form->field($model, 'uuid') ?>

    <?php // echo $form->field($model, 'serialNumber') ?>

    <?php // echo $form->field($model, 'productName') ?>

    <?php // echo $form->field($model, 'manufacturer') ?>

    <?php // echo $form->field($model, 'vender') ?>

    <?php // echo $form->field($model, 'cpuHz') ?>

    <?php // echo $form->field($model, 'cpuInfo') ?>

    <?php // echo $form->field($model, 'cpuNum') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'buyDate') ?>

    <?php // echo $form->field($model, 'majorService') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'hwInfoReportTime') ?>

    <?php // echo $form->field($model, 'lastModify') ?>

    <?php // echo $form->field($model, 'switchBoard1') ?>

    <?php // echo $form->field($model, 'switchBoard2') ?>

    <?php // echo $form->field($model, 'switchBoard3') ?>

    <?php // echo $form->field($model, 'switchBoard4') ?>

    <?php // echo $form->field($model, 'switchBoard5') ?>

    <?php // echo $form->field($model, 'switchBoard6') ?>

    <?php // echo $form->field($model, 'switchBoard7') ?>

    <?php // echo $form->field($model, 'needMonitor') ?>

    <?php // echo $form->field($model, 'shelfPlace') ?>

    <?php // echo $form->field($model, 'maintenancePeriod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
