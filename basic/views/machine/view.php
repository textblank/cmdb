<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Machine */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Machines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hostname',
            'assetId',
            'busi1Id',
            'idc',
            'machineClass',
            'machineType',
            'entityHostname',
            'ip1',
            'ip2',
            'ip3',
            'ip4',
            'ip5',
            'ip6',
            'ip7',
            'opAdmin',
            'devAdmin',
            'shelf',
            'onShelfTime',
            'switchIp1',
            'switchPort1',
            'switchIp2',
            'switchPort2',
            'swichIp3',
            'switchPort3',
            'switchIp4',
            'switchPort4',
            'switchIp5',
            'switchPort5',
            'switch6',
            'switchPort6',
            'switchIp7',
            'switchPort7',
            'networkOperator',
            'currentStatus',
            'importantLevel',
            'osName',
            'raid',
            'speed7',
            'speed6',
            'speed5',
            'speed4',
            'speed3',
            'speed2',
            'speed1',
            'gateway7',
            'gateway6',
            'gateway5',
            'gateway4',
            'gateway3',
            'gateway2',
            'gateway1',
            'netmask7',
            'netmask6',
            'netmask5',
            'netmask4',
            'netmask3',
            'netmask2',
            'netmask1',
            'mac7',
            'mac6',
            'mac5',
            'mac4',
            'mac3',
            'mac2',
            'mac1',
            'ethernet7',
            'ethernet6',
            'ethernet5',
            'ethernet4',
            'ethernet3',
            'ethernet2',
            'ethernet1',
            'memorySize',
            'diskSize',
            'disks',
            'uuid',
            'serialNumber',
            'productName',
            'manufacturer',
            'vender',
            'cpuHz',
            'cpuInfo',
            'cpuNum',
            'price',
            'buyDate',
            'majorService',
            'memo',
            'hwInfoReportTime',
            'lastModify',
            'switchBoard1',
            'switchBoard2',
            'switchBoard3',
            'switchBoard4',
            'switchBoard5',
            'switchBoard6',
            'switchBoard7',
            'needMonitor',
            'shelfPlace',
            'maintenancePeriod',
        ],
    ]) ?>

</div>
