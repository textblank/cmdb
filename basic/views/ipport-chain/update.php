<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IpportChain */

$this->title = 'Update Ipport Chain: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ipport Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ipport-chain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
