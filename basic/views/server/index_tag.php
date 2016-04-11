<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<'JS'

$(".btn-batch").click(function(e){
    e.preventDefault();
    url = $(this).attr("href");
    console.log(url);
    form = $("#form1");
    $(form).attr("action", url);
    console.log($(form).attr("action"));
    $(form).submit();
});

JS;
$this->registerJs($js);

$this->title = '属于 '.$tag.' 的机器列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <a class="btn btn-success btn-xs" href="/index.php?r=server/listall">全部信息</a>
    <a class="btn btn-success btn-xs" href="/index.php?r=server/create">新增机器</a>
    <a class="btn btn-success btn-xs" href="/index.php?r=server/batchinput">批量添加基本信息</a>
    <!--<a class="btn btn-success btn-xs" href="/index.php?r=server/batchinput-owner">批量添加负责人</a>-->
    <a class="btn btn-success btn-xs btn-batch" href="/index.php?r=server/batchmodify">批量修改信息</a>
    <a class="btn btn-success btn-xs btn-batch" href="/index.php?r=server/batchmodify-biz">批量修改业务信息</a>
    <a class="btn btn-success btn-xs btn-batch" href="/index.php?r=server/batch-query">批量查询机器信息</a>
    <a class="btn btn-success btn-xs btn-batch" href="/index.php?r=server/exchange">机器名和ip转换工具</a>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<form id="form1" method="post" actoin=''>
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            

            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => Html::checkBox('selection_all', false, [
                    'class' => 'select-on-check-all',
                    'label' => '',
                ]),
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->hostname];
                }
            ],
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'hostname',
            'ip1',
            'entityHostname',
            //'opAdmin',
            'devAdmin',
            ['attribute' => 'biz1cname', 'value' => function($model){
                return $model->biz1 ? $model->biz1->cname :  '-';
            }],
            ['attribute' => 'biz2cname', 'value' => function($model){
                return $model->biz2 ? $model->biz2->cname :  '-';
            }],
            ['attribute' => 'biz3cname', 'value' => function($model){
                return $model->biz3 ? $model->biz3->cname :  '-';
            }],
            //'currentStatus',
            //'importantLevel',
            // 'needMonitor',
            ['attribute' => 'memorySize', 'value' => function($model){
                return ($model->memorySize / 1024).' GB';
            }],
            //'disks',
            //'diskSize',
            'cpuNum',
            //'idc',
            // 'shelf',
            // 'machineType',
            // 'assetId',
            // 'machineClass',
            // 'cpuHz',
            // 'cpuInfo',
            // 'memo',
            // 'ip2',
            // 'ip3',
            // 'ip4',
            // 'ip5',
            // 'ip6',
            // 'ip7',
            // 'onShelfTime',
            // 'uuid',
            // 'networkOperator',
            // 'osName',
            // 'raid',
            // 'serialNumber',
            // 'manufacturer',
            // 'vender',
            // 'price',
            // 'buyDate',
            // 'majorService',
            // 'hwInfoReportTime',
            // 'lastModify',
            // 'shelfPlace',
            // 'maintenancePeriod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</form>
</div>
