<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NgxlatencydaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ngxlatencyday-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'uri') ?>

    <?= $form->field($model, 'num') ?>

    <?= $form->field($model, 't100') ?>

    <?php // echo $form->field($model, 't200') ?>

    <?php // echo $form->field($model, 't500') ?>

    <?php // echo $form->field($model, 't1000') ?>

    <?php // echo $form->field($model, 't3000') ?>

    <?php // echo $form->field($model, 'tt') ?>

    <?php // echo $form->field($model, 'pt100') ?>

    <?php // echo $form->field($model, 'pt200') ?>

    <?php // echo $form->field($model, 'pt500') ?>

    <?php // echo $form->field($model, 'pt1000') ?>

    <?php // echo $form->field($model, 'pt3000') ?>

    <?php // echo $form->field($model, 'ptt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
