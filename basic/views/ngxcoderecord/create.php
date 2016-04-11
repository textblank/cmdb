<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ngxcoderecord */

$this->title = 'Create Ngxcoderecord';
$this->params['breadcrumbs'][] = ['label' => 'Ngxcoderecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngxcoderecord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
