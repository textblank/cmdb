<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = '机器名 －－－ ip 转换';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <form id="Server" action="/index.php?r=server/exchange" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div class="form-group">
            <button type="submit" class="btn btn-success">转换</button>
            <br><br>
        </div>
    <div class="row">
    <div class="form-group field-server-list">
        <div class="col-md-6 col-lg-6">
            <label class="control-label" for="server-ip1">转换前</label>
            <textarea id="list" class="form-control" name="Server[before]" rows="30">
<?php 
    foreach($before as $b){
        echo $b."\n";
    }
?></textarea>
            <div class="help-block"></div>
        </div>
        <div class="col-md-6 col-lg-6">
            <label class="control-label" for="server-ip1">转换后</label>
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
