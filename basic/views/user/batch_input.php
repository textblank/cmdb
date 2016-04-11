<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
<h1>输入用户信息</h1>
<form id="w0" action="/index.php?r=user/batch-input" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <textarea id="users" class="form-control" name="Users[list]" rows="10"></textarea>
    <button type="submit" class="btn btn-success">导入</button>
</form>

</div>
