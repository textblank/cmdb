<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = '批量查询机器信息';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <form id="Server" action="/index.php?r=server/batch-query" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div class="row">
            <div class="col-md-2 col-lg-2">
                请勾选要查询的项目:
            <button type="submit" class="btn btn-success btn-sm">查询</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
<?php
foreach ($model->attributes as $key => $value) {
    echo '<input type="checkbox" name="selection[]" value="'.$key.'"> '.$model->getAttributeLabel($key).'&nbsp;&nbsp;&nbsp;&nbsp;';
}
?>
<br><br>
        </div>
    </div>
    <div class="row">
    <div class="form-group field-server-list">
        <div class="col-md-2 col-lg-2">
            <label class="control-label" for="server-ip1">输入hostname</label>
            <textarea id="list" class="form-control" name="Server[before]" rows="30">
<?php 
    foreach($before as $b){
        echo $b."\n";
    }
?></textarea>
            <div class="help-block"></div>
        </div>
        <div class="col-md-10 col-lg-10">
            <label class="control-label" for="server-ip1">查询结果</label>
            <textarea id="exchanged" class="form-control" name="Server[after]" rows="30">
<?php 
    foreach($after as $a){
        echo $a."\n";
    }
?>
</textarea>
            <div class="help-block"></div>
        </div>
    </div>
    </div>
    </form>

</div>
