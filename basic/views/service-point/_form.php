<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->registerJsFile('/js/jquery.coolautosuggest.js', ['depends' => ['app\assets\AppAsset']]);

$js = <<<'JS'

    $("#input_user").coolautosuggest({
      url:"/index.php?r=user/json-user-id&q=",
      showThumbnail:false,
      showDescription:true,
      onSelected:function(result){
        // Check if the result is not null
        if(result!=null){
          $("#input_user_id").val(result.id); // Get the ID field
          $("#input_user_description").val(result.description); // Get the description
        }
        else{
          $("#input_user_id").val(""); // Empty the ID field
          $("#input_user_description").val(""); // Empty the description
        }
      }
    });

    $("#add-user-btn").click(function(){
    	var inputName = $("#servicepoint-name");
    	var inputId = $("#servicepoint-employee_id");
        userName = inputName.val();
        userId = inputId.val();
        inputUser = $("#input_user").val();
        inputUserId = $("#input_user_id").val();
        if((inputUser != '') || (inputUserId == '')){
            if(userName == ''){
                inputName.val(inputUser);
                inputId.val(inputUserId);
            }else{
                inputName.val(userName+";"+inputUser);
                inputId.val(userId+";"+inputUserId);
            }
        }
    });

JS;
$this->registerJs($js);
?>
<link rel="stylesheet" href="/css/jquery.coolautosuggest.css" type="text/css" />
<div class="service-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-server-busi1id">
        <label class="control-label" for="input_user">输入负责人的名字、拼音简写等信息搜索，并点选添加</label><br>
        <input type="text" name="input_user" id="input_user" autocomplete="off" class="form-control suggestions-input">
        <input type="text" name="input_user_id" id="input_user_id" size="8" class="form-control suggestions-input-id" readonly="readOnly">
        <a id="add-user-btn" href="javascript: void(0);" class="btn btn-primary btn-xs">添加</a>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '增加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
