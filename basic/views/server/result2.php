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

<?php if(count($ono)>0) : ?>
<h3>以下内容已经存在，更新失败：</h3>
<p style="color: red">
    <?php foreach($ono as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($nno)>0) : ?>
<h3>以下内容为新内容，插入失败：</h3>
<p style="color: red">
    <?php foreach($nno as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($ook)>0) : ?>
<h3>以下内容已经存在，更新成功：</h3>
<p style="color: green">
    <?php foreach($ook as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

<?php if(count($nok)>0) : ?>
<h3>以下内容为新内容，插入成功：</h3>
<p style="color: green">
    <?php foreach($nok as $r) : ?>
        <?= $r ?>
        <br>
    <?php endforeach ?>
</p>
<?php endif ?>

</div>
