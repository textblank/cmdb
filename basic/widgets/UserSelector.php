<?php
/**
 * 用户选择组件，渲染两个select，先选择公司，再选择用户
 */
namespace app\widgets;

use Yii;
use yii\widgets\InputWidget;
use yii\widgets\ActiveField;
use yii\helpers\Html;
use yii\web\View;
use app\models\User;
use app\models\Company;

class UserSelector extends ActiveField{
	
	public static $counter = 0;

	public $company_id = 0;
	public $user_id = 0;
	public $userList = [];

	public function init(){
		self::$counter++;
		$this->user_id = $this->model[$this->attribute];
		//获取用户的公司id
		if($this->user_id){
			$user = User::find()->select('company_id')->where(['id' => $this->user_id])->one();
			$this->company_id = $user->company_id;
			$this->userList = User::getCompanyUsers($this->company_id);
		}
	}

	public function render($content = null){
		if($content === null){
			$content = $this->content();
		}
		$this->registerJs();
		return $this->begin() . "\n" . $content . "\n" . $this->end();
	}

	public function content(){

		$companyInputName =Html::getInputName($this->model, 'company' . self::$counter);
		$label = Html::activeLabel($this->model, $this->attribute);
		$id = Html::getInputId($this->model, $this->attribute);
		$companySelect = Html::dropDownList($companyInputName, $this->company_id, Company::autoTree(), ['prompt' => '请选择公司', 'class' => 'form-control j-company-list', 'data-target' => '#' . $id]);
		$userSelect = Html::activeDropDownList($this->model, $this->attribute, $this->userList, ['prompt' => '请选择用户', 'class' => 'form-control']);

		$html = <<<HTML
		$label
		<div class="row">
            <div class="col-md-6 col-sm-6">
            	$companySelect
            </div>
            <div class="col-md-6 col-sm-6">
            	$userSelect
            </div>
        </div>
        <div class="help-block"></div>
HTML;
		return $html;

	}

	public function registerJs(){
		$js = <<<JS
		$('.j-company-list').on('change', function(e){
		    var target = $($(this).data('target'));
			var options = $("<option value=''>请选择用户</option>");
			if(!this.value){
				target.html(options);
			}
		    var url = 'index.php?r=ajax/user&id=' + this.value;
		    $.getJSON(url, function(data){
		        for(var i = 0; i < data.length; i++){
		            options = options.add($("<option>", {
		                value: data[i].id,
		                text: data[i].name
		            }));
		        }
		        target.html(options);
		    });
		});
JS;
		Yii::$app->view->registerJs($js);
	}
}