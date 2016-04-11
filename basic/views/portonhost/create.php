<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Portonhost */

$this->title = 'Create Portonhost';
$this->params['breadcrumbs'][] = ['label' => 'Portonhosts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portonhost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
