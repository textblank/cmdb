<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = '批量删除机器信息';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">
    <h1>不在输入的列表里的机器将被删除</h1>

    <form id="Server" action="/index.php?r=server/batch-delete" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <div class="form-group field-server-list">
    <textarea id="list" class="form-control" name="Server[list]" rows="10"></textarea>
    <label class="control-label" for="server-ip1">输入机器信息，每个一行</label>
    <div class="help-block"></div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">执行</button>
        </div>
    </form>
</div>

<div>
    <h4>以下服务器被删除</h4>
    <?php 
        foreach($deletes as $d){
            echo $d."<br>";
        }
    ?>
</div>
