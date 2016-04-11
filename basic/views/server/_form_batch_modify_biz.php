<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $model app\models\Server */
/* @var $form yii\widgets\ActiveForm */

$js = <<<'JS'
$('#server-busi1id').on('change', function(e){
    e.preventDefault();
    var busi1id = $(this).val();
    if(!busi1id){
        $('#server-busi2id').html('');
        $('#server-busi3id').html('');
        return $("#server-busi1id").html("<option value=''>请选择一级业务</option>");
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
            $("#server-busi2id").html($options);
            $("#server-busi2id").get(0).selectedIndex = 1;
            $("#server-busi2id").trigger('change');
        } else {
            $('#server-busi2id').html("<option value=''>请选择二级业务</option>");
            $('#server-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});
$('#server-busi2id').on('change', function(e){
    e.preventDefault();
    var busi2id = $(this).val();
    if(!busi2id){
        $('#server-busi3id').html('');
        return $("#server-busi2id").html("<option value=''>请选择二级业务</option>");
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
            $("#server-busi3id").html($options);
            $("#server-busi3id").get(0).selectedIndex = 1;
        } else {
            $('#server-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});

JS;
$this->registerJs($js);
?>
<div class="server-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostnames')->label('hostnames，每行一个')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'busi1Id')->dropDownList(Biz::autoTreeBiz1(), ['prompt' => '请选择一级业务']) ?>

    <?= $form->field($model, 'busi2Id')->dropDownList($model->busi1Id ? Biz::autoTreeBiz2($model->busi1Id) : [], ['prompt' => '请选择二级业务']) ?>

    <?= $form->field($model, 'busi3Id')->dropDownList($model->busi2Id ? Biz::autoTreeBiz3($model->busi2Id) : [], ['prompt' => '请选择三级业务']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
