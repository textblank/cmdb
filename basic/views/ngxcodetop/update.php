<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ngxcodetop */

$this->title = 'Update Ngxcodetop: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ngxcodetops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ngxcodetop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
