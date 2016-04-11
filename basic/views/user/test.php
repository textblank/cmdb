<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('/js/jquery.coolautosuggest.js', ['depends' => ['app\assets\AppAsset']]);
$js = <<<'JS'
	$("#text1").coolautosuggest({
	  url:"/index.php?r=user/json-user-id&q=",
	  showThumbnail:false,
	  showDescription:true,
	  onSelected:function(result){
	    // Check if the result is not null
	    if(result!=null){
	      $("#text1_id").val(result.id); // Get the ID field
	      $("#text1_description").val(result.description); // Get the description
	    }
	    else{
	      $("#text1_id").val(""); // Empty the ID field
	      $("#text1_description").val(""); // Empty the description
	    }
	  }
	});
JS;
$this->registerJs($js);

?>
<link rel="stylesheet" href="/css/jquery.coolautosuggest.css" type="text/css" />
<div class="user-form">
<h1>输入用户信息</h1>

<div>
<form>
	Public figure name : <input type="text" name="text1" id="text1" autocomplete="off" class="suggestions-input">
	 ID : <input type="text" name="text1_id" id="text1_id" size="8" class="suggestions-input">		
</form>
</div>

</div>
