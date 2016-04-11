<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = '批量修改服务器';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_batch_modify', [
        'model' => $model,
    ]) ?>

</div>
