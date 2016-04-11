<?php
/**
 * 文档关联组件，可以用于业务表单中关联文档
 * 会在当前位置插入一个添加文档的按钮，点击后即可上传或选择文档
 */

namespace app\widgets;

use Yii;
use yii\widgets\ActiveField;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\web\View;

class DocumentInserter extends ActiveField
{
    public $html = [];

    public $enable = true;

    public function init(){
        parent::init();
        $this->enable = $this->model->bizType->has_document;
        if($this->enable){
            Yii::$app->view->on(View::EVENT_END_BODY, [$this, 'renderDialog']);
        }
    }

    public function render($content = null){
        if(!$this->enable){
            return '';
        }
        if($content === null){
            $content = $this->renderContent();
        }
        $this->registerJs();
        return $this->begin() . "\n" . $content . "\n" . $this->end();
    }

    public function renderContent(){
        $this->registerJs();
        $this->renderButton();

        $this->html[] = sprintf('<ul class="list-group doc-list" style="margin-top:15px">');
        foreach($this->model->documents as $document){
            $this->html[] = sprintf('<li class="list-group-item" data-id="%s"><span>%s - %s</span> <a href="#" class="delete">删除</a></li>', $document->id, $document->sn, $document->title);
        }
        $this->html[] = "</ul>";
        return join('', $this->html);
    }

    public function renderDialog(){
        Modal::begin([
            'id' => 'doc-dialog',
            'closeButton' => false,
            'footer' => 
                Html::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']).
                Html::submitButton('提交', ['class' => 'btn btn-success', 'id' => 'modal-confirm-btn'])
        ]);
        echo Html::button('&times;', ['class' => 'close', 'data-dismiss' => 'modal']);
        echo Tabs::widget([
            'items' => [
                [
                    'label' => '上传文档',
                    'active' => true,
                    'content' => Yii::$app->view->render('/document/embed_form'),
                ],
                [
                    'label' => '关联已有文档',
                    'content' => Yii::$app->view->render('/document/embed_search'),
                ]
            ]
        ]);
        Modal::end();
    }

    public function renderButton(){
        $this->html[] = Html::button('添加文档', ['class' => 'btn btn-primary doc-inserter', 'data-toggle' => 'modal', 'data-target' => '#doc-dialog']);
        $this->html[] = Html::activeHiddenInput($this->model, $this->attribute);
    }

    public function registerJs(){
        $attrId = Html::getInputId($this->model, $this->attribute);
        $js = <<<JS
        $($('.doc-inserter')[0].form).on('beforeSubmit', function(e){
            var idList = [];
            $('.doc-list li').each(function(){
                idList.push($(this).data('id'));
            });
            $('#$attrId').val(idList.join(','));
        });
        $('.modal').on('show.bs.modal', function(){
            $(this).find('form')[0].reset();
            $('#document-url').val('');
            $('#document-url-flist').empty();
        });
        $('.doc-list').on('click', '.delete', function(e){
            $(this).closest('li').remove();
        });
        function addDoc(doc){
            if($('.doc-list li[data-id=' + doc.id + ']').length > 0){
                return false;
            }
            var li = '<li class="list-group-item" data-id="' + doc.id + '"><span>' + doc.sn + ' - ' + doc.title + '</span> <a href="#" class="delete">删除</a></li>';
            $('.doc-list').append(li);
        }
        $('#modal-confirm-btn').on('click', function(){
            //如果是上传，直接提交表单
            if($('#doc-dialog .nav-tabs li').eq(0).hasClass('active')){
                $('#new-doc-form').submit();
            }else{
                var selected = $('#search-doc-list').find('.active');
                if(selected.length == 0){
                    $('#not-select-error').text('请选择要关联的文档');
                    return false; 
                }
                $('#not-select-error').text('');
                $('#doc-dialog').modal('hide');
                $('#search-doc-list').find('.active').each(function(){
                    var doc = $(this).data();
                    addDoc(doc);
                });
            }
        });

        $('#new-doc-form').on('beforeSubmit', function(e){
            var form = $(this);
            var data = form.serialize();
            $.post(form.attr('action'), data, function(res){
                if(!res || !res.success){
                    alert('系统发生错误');
                    return false;
                }
                $('#doc-dialog').modal('hide');
                addDoc(res.data);
            }, 'json');
            return false;
        });
JS;
        Yii::$app->view->registerJs($js);
    }
}
