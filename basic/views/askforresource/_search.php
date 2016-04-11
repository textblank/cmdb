<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AskforresourceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askforresource-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'owner') ?>

    <?= $form->field($model, 'neworexpansion') ?>

    <?= $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'os') ?>

    <?php // echo $form->field($model, 'osver') ?>

    <?php // echo $form->field($model, 'machineType') ?>

    <?php // echo $form->field($model, 'num') ?>

    <?php // echo $form->field($model, 'cpu') ?>

    <?php // echo $form->field($model, 'mem') ?>

    <?php // echo $form->field($model, 'sysdisk') ?>

    <?php // echo $form->field($model, 'userdisk') ?>

    <?php // echo $form->field($model, 'insideBandwidth') ?>

    <?php // echo $form->field($model, 'outsideBandwidth') ?>

    <?php // echo $form->field($model, 'expectDate') ?>

    <?php // echo $form->field($model, 'explan') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
