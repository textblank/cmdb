<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = '批量导入机器负责人信息';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <form id="Server" action="/index.php?r=server/batchinput-owner" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <div class="form-group field-server-list">
    <textarea id="list" class="form-control" name="Server[list]" rows="10"></textarea>
    <label class="control-label" for="server-ip1">输入机器信息，每个一行</label>
    <div class="help-block"></div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">导入</button>
        </div>
    </form>

</div>
