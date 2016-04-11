<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HostnameTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hostname-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostnames')->label('hostname，每行一个')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'tags')->label('Tag')->checkboxList($tags) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
