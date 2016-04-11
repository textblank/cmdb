<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sysuser */

$this->title = 'Create Sysuser';
$this->params['breadcrumbs'][] = ['label' => 'Sysusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sysuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
