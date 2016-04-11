<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\MultiColumnDetailView;
use app\models\Biz;

/* @var $this yii\web\View */
/* @var $model app\models\Server */

$this->title = $model->hostname;
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-view">

    <h1><?= Html::encode($this->title) ?> <a class="btn btn-primary btn-xs" href="http://trend.mon.foneshare.cn/charts?host_name=<?= $model->hostname ?>&graph_type=h&info=on" target="_blank"><span class="glyphicon glyphicon-signal"></span> 查看监控图</a> 
    <?php if(isset($tags[0])) : ?>
    <?php foreach($tags[0] as $tag){ echo '<a class="btn btn-info btn-xs" href="/index.php?r=hostnametag/listhostnamebytag&tag='.$tag.'" target="_blank"><span class="glyphicon glyphicon-tag"></span> '.$tag." </a>"; } ?>
    <?php endif ?>
    </h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= MultiColumnDetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hostname',
            'ip1',
            'opAdmin',
            'devAdmin',
            'devAdminId',
            ['attribute' => 'busi1Id', 'value' => $model->busi1Id ? $model->biz1->cname : '-'],
            ['attribute' => 'busi2Id', 'value' => $model->busi2Id ? $model->biz2->cname : '-'],
            ['attribute' => 'busi3Id', 'value' => $model->busi3Id ? $model->biz3->cname : '-'],
            ['attribute' => 'currentStatus', 'value' => $model->currentStatus ? Yii::$app->params['currentStatus'][$model->currentStatus] : '-'],
            ['attribute' => 'importantLevel', 'value' => $model->importantLevel ? Yii::$app->params['importantLevel'][$model->importantLevel] : '-'],
            ['attribute' => 'needMonitor', 'value' => $model->needMonitor ? Yii::$app->params['needMonitor'][$model->needMonitor] : '-'],
            'entityHostname',
            'memorySize',
            'disks',
            'diskSize',
            'cpuNum',
            'idc',
            'shelf',
            'machineType',
            'assetId',
            'machineClass',
            'cpuHz',
            'cpuInfo',
            'ip2',
            'ip3',
            'ip4',
            'ip5',
            'ip6',
            'ip7',
            'onShelfTime',
            'uuid',
            'networkOperator',
            'osName',
            'raid',
            'serialNumber',
            'manufacturer',
            'vender',
            'price',
            'buyDate',
            'majorService',
            'hwInfoReportTime',
            'lastModify',
            'shelfPlace',
            'maintenancePeriod',
            ['attribute' => 'memo', 'single_row' => true],
        ],
    ]) ?>

</div>

<?php if($dataProvider) : ?>
<?= $this->render('ports', [
        'dataProvider' => $dataProvider,
    ]) ?>
<?php endif ?>
