<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="server-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hostname') ?>

    <?= $form->field($model, 'ip1') ?>

    <?= $form->field($model, 'opAdmin') ?>

    <?= $form->field($model, 'devAdmin') ?>

    <?php // echo $form->field($model, 'busi1Id') ?>

    <?php // echo $form->field($model, 'busi2Id') ?>

    <?php // echo $form->field($model, 'busi3Id') ?>

    <?php // echo $form->field($model, 'currentStatus') ?>

    <?php // echo $form->field($model, 'importantLevel') ?>

    <?php // echo $form->field($model, 'needMonitor') ?>

    <?php // echo $form->field($model, 'entityHostname') ?>

    <?php // echo $form->field($model, 'memorySize') ?>

    <?php // echo $form->field($model, 'disks') ?>

    <?php // echo $form->field($model, 'diskSize') ?>

    <?php // echo $form->field($model, 'cpuNum') ?>

    <?php // echo $form->field($model, 'idc') ?>

    <?php // echo $form->field($model, 'shelf') ?>

    <?php // echo $form->field($model, 'machineType') ?>

    <?php // echo $form->field($model, 'assetId') ?>

    <?php // echo $form->field($model, 'machineClass') ?>

    <?php // echo $form->field($model, 'cpuHz') ?>

    <?php // echo $form->field($model, 'cpuInfo') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'ip2') ?>

    <?php // echo $form->field($model, 'ip3') ?>

    <?php // echo $form->field($model, 'ip4') ?>

    <?php // echo $form->field($model, 'ip5') ?>

    <?php // echo $form->field($model, 'ip6') ?>

    <?php // echo $form->field($model, 'ip7') ?>

    <?php // echo $form->field($model, 'onShelfTime') ?>

    <?php // echo $form->field($model, 'uuid') ?>

    <?php // echo $form->field($model, 'networkOperator') ?>

    <?php // echo $form->field($model, 'osName') ?>

    <?php // echo $form->field($model, 'raid') ?>

    <?php // echo $form->field($model, 'serialNumber') ?>

    <?php // echo $form->field($model, 'manufacturer') ?>

    <?php // echo $form->field($model, 'vender') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'buyDate') ?>

    <?php // echo $form->field($model, 'majorService') ?>

    <?php // echo $form->field($model, 'hwInfoReportTime') ?>

    <?php // echo $form->field($model, 'lastModify') ?>

    <?php // echo $form->field($model, 'shelfPlace') ?>

    <?php // echo $form->field($model, 'maintenancePeriod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
