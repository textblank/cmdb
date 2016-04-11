<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ngxcodetop */

$this->title = 'Create Ngxcodetop';
$this->params['breadcrumbs'][] = ['label' => 'Ngxcodetops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxcodetop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
