<?php

use yii\helpers\Html;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use app\models\ServiceImprovementTracking;


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
        var inputName = $("#serviceimprovementtracking-owner");
        var inputId = $("#serviceimprovementtracking-employee_id");
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
            $("#input_user").val("");
            $("#input_user_id").val("");
        }
    });

    $("#clean-user-btn").click(function(){
        $("#serviceimprovementtracking-owner").val("");
        $("#serviceimprovementtracking-employee_id").val("");
    });

JS;
$this->registerJs($js);
?>
<link rel="stylesheet" href="/css/jquery.coolautosuggest.css" type="text/css" />

    <?= Alert::widget(); ?>

<div class="service-improvement-tracking-form">

    <?php $form = ActiveForm::begin(); ?>

<?php if($model->isNewRecord) : ?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'oss')->textInput() ?>
        </div>
    </div>
<?php endif ?>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'type')->radioList(ServiceImprovementTracking::$typeList, ['prompt' => '请选择']) ?>
        </div>
    </div>

<?php if(!$model->isNewRecord) : ?>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'query_count')->textInput() ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'fail_count')->textInput() ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'fail_rate')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'timeout_rate')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'latency')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
<?php endif ?>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'plan')->textArea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'plan_date')->widget(DateTimePicker::className(), 
                ['template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                'inline' => false,
                'clientOptions' => [
                    'startView' => 2,
                    'minView' => 3,
                    'maxView' => 4,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayBtn' => true
                ]]) ?>
        </div>

        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'finish_date')->widget(DateTimePicker::className(), 
                ['template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                'inline' => false,
                'clientOptions' => [
                    'startView' => 2,
                    'minView' => 3,
                    'maxView' => 4,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayBtn' => true
                ]]) ?>
        </div>

        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'status')->dropDownList(ServiceImprovementTracking::$statusList, ['prompt' => '请选择']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'owner')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group field-server-busi1id col-md-6 col-lg-6">
            <label class="control-label" for="input_user">输入负责人的名字、拼音简写等信息搜索，并点选添加</label><br>
            <input type="text" name="input_user" id="input_user" autocomplete="off" class="form-control suggestions-input">
            <input type="text" name="input_user_id" id="input_user_id" size="8" class="form-control suggestions-input-id" readonly="readOnly">
            <a id="add-user-btn" href="javascript: void(0);" class="btn btn-primary btn-xs">添加</a>
            <a id="clean-user-btn" href="javascript: void(0);" class="btn btn-primary btn-xs">清空</a>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
