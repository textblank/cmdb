<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HostnameTag */

$this->title = '批量创建hostname-tag';
$this->params['breadcrumbs'][] = ['label' => 'Hostname Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hostname-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_batch_create', [
        'model' => $model,
        'tags' => $tags,
    ]) ?>

</div>
