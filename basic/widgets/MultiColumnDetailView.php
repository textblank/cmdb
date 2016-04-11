<?php
/**
 * 多列展示的详情页
 */
namespace app\widgets;

use Yii;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

class MultiColumnDetailView extends DetailView
{
	public $columns = 2;
	public $labelWidth = '15%';
	public $valueWidth = '35%';
	public $template = '<th width="{labelWidth}">{label}</th><td {option} width="{valueWidth}">{value}</td>';
    public $options = ['class' => 'table table-striped detail-view'];

	public function run()
    {
        $fields = $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
        	//属性是否独占一行
        	if(isset($attribute['single_row']) && $attribute['single_row']){
        		$singleRow = true;
        		$attribute['option'] = sprintf('colspan="%s"', $this->columns * 2 - 1);
        	}else{
        		$singleRow = false;
        	}
            $fieldCount = count($fields);
            if($fieldCount > 0 && ($fieldCount == $this->columns || $singleRow)){
            	$rows[] = Html::tag('tr', join("\n", $fields));
            	$fields = [];
            }
            if($singleRow){
            	$rows[] = Html::tag('tr', $this->renderAttribute($attribute, $i++));
            }else{
	            $fields[] = $this->renderAttribute($attribute, $i++);
            }
        }
        //补齐
        if(count($fields) > 0){
        	$rows[] = Html::tag('tr', join("\n", $fields));
        	$fields = [];
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'table');
        echo Html::tag($tag, implode("\n", $rows), $options);
    }

    protected function renderAttribute($attribute, $index)
    {
        if (is_string($this->template)) {
            return strtr($this->template, [
            	'{labelWidth}' => $this->labelWidth,	
            	'{valueWidth}' => $this->valueWidth,
            	'{option}' => isset($attribute['option']) ? $attribute['option'] : '',
                '{label}' => $attribute['label'],
                '{value}' => $this->formatter->format($attribute['value'], $attribute['format']),
            ]);
        } else {
            return call_user_func($this->template, $attribute, $index, $this);
        }
    }
}