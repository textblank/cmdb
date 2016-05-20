<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceImprovementTrackingInfo */

$this->title = '新增后续信息：'.$model->parent->name;
$this->params['breadcrumbs'][] = ['label' => 'Service Improvement Tracking Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-improvement-tracking-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
