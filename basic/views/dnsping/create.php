<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dnsipdetectsum */

$this->title = 'Create Dnsipdetectsum';
$this->params['breadcrumbs'][] = ['label' => 'Dnsipdetectsums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dnsipdetectsum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
