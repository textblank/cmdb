<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FileDeleteConfig */

$this->title = '创建日志清理配置';
$this->params['breadcrumbs'][] = ['label' => 'File Delete Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-delete-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
