<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $model app\models\Server */
/* @var $form yii\widgets\ActiveForm */

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
        userName = $("#server-devadmin").val();
        userId = $("#server-devadminid").val();
        inputUser = $("#input_user").val();
        inputUserId = $("#input_user_id").val();
        if((inputUser != '') || (inputUserId == '')){
            if(userName == ''){
                $("#server-devadmin").val(inputUser);
                $("#server-devadminid").val(inputUserId);
            }else{
                $("#server-devadmin").val(userName+";"+inputUser);
                $("#server-devadminid").val(userId+";"+inputUserId);
            }
        }
    });

JS;
$this->registerJs($js);
?>
<link rel="stylesheet" href="/css/jquery.coolautosuggest.css" type="text/css" />
<div class="server-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hostnames')->label('hostnames，每行一个')->textarea(['rows' => 10]) ?>

    <div class="form-group field-server-busi1id">
        <label class="control-label" for="input_user">输入负责人的名字、拼音简写等信息搜索，并点选添加</label><br>
        <input type="text" name="input_user" id="input_user" autocomplete="off" class="form-control suggestions-input">
        <input type="text" name="input_user_id" id="input_user_id" size="8" class="form-control suggestions-input-id" readonly="readOnly">
        <a id="add-user-btn" href="javascript: void(0);" class="btn btn-primary btn-xs">添加</a>
    </div>

    <?= $form->field($model, 'devAdmin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'devAdminId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currentStatus')->dropDownList(Yii::$app->params['currentStatus'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'importantLevel')->dropDownList(Yii::$app->params['importantLevel'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'needMonitor')->dropDownList(Yii::$app->params['needMonitor'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'entityHostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memorySize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskSize')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuNum')->textInput() ?>

    <?= $form->field($model, 'idc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shelf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineType')->dropDownList(Yii::$app->params['machineType'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'assetId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'machineClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuHz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpuInfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'onShelfTime')->textInput() ?>

    <?= $form->field($model, 'uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'networkOperator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'osName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serialNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyDate')->textInput() ?>

    <?= $form->field($model, 'majorService')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hwInfoReportTime')->textInput() ?>

    <?= $form->field($model, 'lastModify')->textInput() ?>

    <?= $form->field($model, 'shelfPlace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maintenancePeriod')->textInput() ?>

    <?= $form->field($model, 'opAdmin')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
