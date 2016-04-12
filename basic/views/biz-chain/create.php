<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BizChain */

$this->title = 'Create Biz Chain';
$this->params['breadcrumbs'][] = ['label' => 'Biz Chains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biz-chain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
