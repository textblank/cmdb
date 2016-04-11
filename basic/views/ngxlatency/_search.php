<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NgxlatencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ngxlatency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'uri') ?>

    <?= $form->field($model, 'num') ?>

    <?php // echo $form->field($model, 'min') ?>

    <?php // echo $form->field($model, 'avg') ?>

    <?php // echo $form->field($model, 'max') ?>

    <?php // echo $form->field($model, 't100') ?>

    <?php // echo $form->field($model, 't200') ?>

    <?php // echo $form->field($model, 't500') ?>

    <?php // echo $form->field($model, 't1000') ?>

    <?php // echo $form->field($model, 't3000') ?>

    <?php // echo $form->field($model, 'tt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
