<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceImprovementTrackingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-improvement-tracking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'find_date') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'intro') ?>

    <?= $form->field($model, 'query_count') ?>

    <?php // echo $form->field($model, 'fail_count') ?>

    <?php // echo $form->field($model, 'fail_rate') ?>

    <?php // echo $form->field($model, 'timeout_rate') ?>

    <?php // echo $form->field($model, 'latency') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'owner') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <?php // echo $form->field($model, 'plan_date') ?>

    <?php // echo $form->field($model, 'finish_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
