<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IpportChain */

$this->title = 'Create Ipport Chain';
$this->params['breadcrumbs'][] = ['label' => 'Ipport Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipport-chain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
