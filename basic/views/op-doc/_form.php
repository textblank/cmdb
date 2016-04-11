<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $model app\models\OpDoc */
/* @var $form yii\widgets\ActiveForm */

$js = <<<'JS'
$('#opdoc-busi1id').on('change', function(e){
    e.preventDefault();
    var busi1id = $(this).val();
    if(!busi1id){
        $('#opdoc-busi2id').html('');
        $('#opdoc-busi3id').html('');
        return $("#opdoc-busi1id").html("<option value=''>请选择一级业务</option>");
    }
    var url = 'index.php?r=biz/getbiz2&id=' + busi1id
    $.getJSON(url, function(data){
        if(data.length>0){
            var $options = $("<option value=''>请选择二级业务</option>");
            for(var i = 0; i < data.length; i++){
                $options = $options.add($("<option>", {
                    value: data[i].id,
                    text: data[i].cname
                }));
            }
            console.log($options);
            $("#opdoc-busi2id").html($options);
            $("#opdoc-busi2id").get(0).selectedIndex = 1;
            $("#opdoc-busi2id").trigger('change');
        } else {
            $('#opdoc-busi2id').html("<option value=''>请选择二级业务</option>");
            $('#opdoc-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});
$('#opdoc-busi2id').on('change', function(e){
    e.preventDefault();
    var busi2id = $(this).val();
    if(!busi2id){
        $('#opdoc-busi3id').html('');
        return $("#opdoc-busi2id").html("<option value=''>请选择二级业务</option>");
    }
    var url = 'index.php?r=biz/getbiz3&id=' + busi2id
    $.getJSON(url, function(data){
        if(data.length > 0){
            var $options = $("<option value=''>请选择三级业务</option>");
            for(var i = 0; i < data.length; i++){
                $options = $options.add($("<option>", {
                    value: data[i].id,
                    text: data[i].cname
                }));
            }
            $("#opdoc-busi3id").html($options);
            $("#opdoc-busi3id").get(0).selectedIndex = 1;
        } else {
            $('#opdoc-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});

JS;
$this->registerJs($js);
?>

<div class="op-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'busi1Id')->dropDownList(Biz::autoTreeBiz1(), ['prompt' => '请选择一级业务']) ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'busi2Id')->dropDownList($model->busi1Id ? Biz::autoTreeBiz2($model->busi1Id) : [], ['prompt' => '请选择二级业务']) ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'busi3Id')->dropDownList($model->busi2Id ? Biz::autoTreeBiz3($model->busi2Id) : [], ['prompt' => '请选择三级业务']) ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
