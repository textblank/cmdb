<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OpDoc */

$this->title = '撰写运维文档';
$this->params['breadcrumbs'][] = ['label' => '业务运维文档', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="op-doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
