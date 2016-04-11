<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hostport */

$this->title = 'Create Hostport';
$this->params['breadcrumbs'][] = ['label' => 'Hostports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hostport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
