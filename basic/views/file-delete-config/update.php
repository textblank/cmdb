<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileDeleteConfig */

$this->title = '编辑日志清理配置: ' . ' ' . $model->hostname;
$this->params['breadcrumbs'][] = ['label' => 'File Delete Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-delete-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
