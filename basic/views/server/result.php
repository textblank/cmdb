<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\MultiColumnDetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = "执行结果：";
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-view">

    <h1><?= Html::encode($this->title) ?></h1>

<?php if(count($no)>0) : ?>
<h3>以下内容执行失败：</h3>
<p style="color: red">
    <?php foreach($no as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($ok)>0) : ?>
<h3>以下内容执行成功：</h3>
<p style="color: green">
    <?php foreach($ok as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

</div>
