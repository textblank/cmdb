<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ngxlatency */

$this->title = 'Create Ngxlatency';
$this->params['breadcrumbs'][] = ['label' => 'Ngxlatencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxlatency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
