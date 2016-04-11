<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ngxlatencyday */

$this->title = 'Create Ngxlatencyday';
$this->params['breadcrumbs'][] = ['label' => 'Ngxlatencydays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxlatencyday-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
