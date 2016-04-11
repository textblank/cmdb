<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\MultiColumnDetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = "执行结果：";
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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

<?php if(count($mod)>0) : ?>
<h3>以下内容被修改：</h3>
<p style="color: red">
    <?php foreach($mod as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($ok)>0) : ?>
<h3>以下内容为新增：</h3>
<p style="color: green">
    <?php foreach($ok as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($del)>0) : ?>
<h3>以下内容删除成功：</h3>
<p style="color: green">
    <?php foreach($del as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

</div>
