<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Maintenance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-form">

<p>
    <h3><span style="color:#ff0000">即将对以下机器设置维护时间，请仔细检查机器信息：</span></h3>
<?php if($model->hostnames) : ?>
    <ul class="list-inline">
    <?php foreach(explode(',', $model->hostnames) as $hostname) : ?>
        <li><?= $hostname ?></li>
    <?php endforeach ?>
    <ul>
<?php endif ?>
</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostnames')->label('')->hiddenInput() ?>

    <?= $form->field($model, 'start_time')->widget(DateTimePicker::className(), [
            'language' => 'en',
            'size' => 'ms',
            'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
                'startView' => 2,
                'minView' => 0,
                'maxView' => 4,
                'autoclose' => true,
                //'linkFormat' => 'HH:ii P', // if inline = true
                'format' => 'yyyy-mm-dd HH:ii:ss', // if inline = false
                'todayBtn' => true
            ]
        ]);?>

    <?= $form->field($model, 'end_time')->widget(DateTimePicker::className(), [
            'language' => 'en',
            'size' => 'ms',
            'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
                'startView' => 2,
                'minView' => 0,
                'maxView' => 4,
                'autoclose' => true,
                //'linkFormat' => 'HH:ii P', // if inline = true
                'format' => 'yyyy-mm-dd HH:ii:ss', // if inline = false
                'todayBtn' => true
            ]
        ]);?>

    <?= $form->field($model, 'reson')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
