<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OpDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$js = <<<'JS'
$('#opdocsearch-busi1id').on('change', function(e){
    e.preventDefault();
    var busi1id = $(this).val();
    if(!busi1id){
        $('#opdocsearch-busi2id').html('');
        $('#opdocsearch-busi3id').html('');
        return $("#opdocsearch-busi1id").html("<option value=''>请选择一级业务</option>");
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
            $("#opdocsearch-busi2id").html($options);
            $("#opdocsearch-busi2id").get(0).selectedIndex = 1;
            $("#opdocsearch-busi2id").trigger('change');
        } else {
            $('#opdocsearch-busi2id').html("<option value=''>请选择二级业务</option>");
            $('#opdocsearch-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});
$('#opdocsearch-busi2id').on('change', function(e){
    e.preventDefault();
    var busi2id = $(this).val();
    if(!busi2id){
        $('#opdocsearch-busi3id').html('');
        return $("#opdocsearch-busi2id").html("<option value=''>请选择二级业务</option>");
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
            $("#opdocsearch-busi3id").html($options);
            $("#opdocsearch-busi3id").get(0).selectedIndex = 1;
        } else {
            $('#opdocsearch-busi3id').html("<option value=''>请选择三级业务</option>");
            return false;
        }
    });
});

JS;
$this->registerJs($js);

$this->title = '业务运维文档';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="op-doc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('撰写', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'owner_id',
            'owner_name',
            ['attribute' => 'busi1Id', 'value' => function($model){
                return $model->biz1 ? $model->biz1->cname :  '-';
            }, 'filter' => Biz::listBiz(1),
                'filterInputOptions' => ['prompt' => '所有', 'class' => 'form-control']],
            ['attribute' => 'busi2Id', 'value' => function($model){
                return $model->biz2 ? $model->biz2->cname :  '-';
            }, 'filter' => Biz::listBiz(2),
                'filterInputOptions' => ['prompt' => '所有', 'class' => 'form-control']],
            ['attribute' => 'busi3Id', 'value' => function($model){
                return $model->biz3 ? $model->biz3->cname :  '-';
            }, 'filter' => Biz::listBiz(3),
                'filterInputOptions' => ['prompt' => '所有', 'class' => 'form-control']],
            ['attribute' => 'content', 'value' => function($model){
                return '可搜索全文内容，比如ip';
            }, 'format' => 'raw'],
            'last_name',
            'last_time',
            // 'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
