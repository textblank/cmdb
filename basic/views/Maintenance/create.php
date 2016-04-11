<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Maintenance */

$this->title = '创建维护信息';
$this->params['breadcrumbs'][] = ['label' => 'Maintenances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
