<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Biz */

$this->title = '创建一级业务';
$this->params['breadcrumbs'][] = ['label' => 'Bizs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cshortname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eshortname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
