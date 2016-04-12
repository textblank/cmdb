<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BizChain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biz-chain-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'local_biz_id')->textInput() ?>

    <?= $form->field($model, 'local_biz_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peer_biz_id')->textInput() ?>

    <?= $form->field($model, 'peer_biz_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
