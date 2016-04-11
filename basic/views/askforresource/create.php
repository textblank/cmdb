<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Askforresource */

$this->title = '资源申请';
$this->params['breadcrumbs'][] = ['label' => 'Askforresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askforresource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
