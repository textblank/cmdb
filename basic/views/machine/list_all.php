<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MachineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Machines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增机器', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('全部信息', ['listall'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hostname',
            'opAdmin',
            'devAdmin',
            'currentStatus',
            'importantLevel',
            'needMonitor',
            'shelfPlace',
            'shelf',
            'onShelfTime',
            'serialNumber',
            'assetId',
            'busi1Id',
            'productName',
            'idc',
            'machineClass',
            'machineType',
            'entityHostname',
            'ip1',
            'networkOperator',
            'osName',
            'raid',
            'memorySize',
            'diskSize',
            'disks',
            'uuid',
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
            'ip2',
            'ip3',
            'ip4',
            'ip5',
            'ip6',
            'ip7',
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
            'speed1',
            'speed2',
            'speed3',
            'speed4',
            'speed5',
            'speed6',
            'speed7',
            'gateway1',
            'gateway2',
            'gateway3',
            'gateway4',
            'gateway5',
            'gateway6',
            'gateway7',
            'netmask1',
            'netmask2',
            'netmask3',
            'netmask4',
            'netmask5',
            'netmask6',
            'netmask7',
            'mac1',
            'mac2',
            'mac3',
            'mac4',
            'mac4',
            'mac5',
            'mac6',
            'ethernet1',
            'ethernet2',
            'ethernet3',
            'ethernet4',
            'ethernet5',
            'ethernet6',
            'ethernet7',
            'switchBoard1',
            'switchBoard2',
            'switchBoard3',
            'switchBoard4',
            'switchBoard5',
            'switchBoard6',
            'switchBoard7',
            'maintenancePeriod',

            [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view}{update}{delete}{tag}',
                  'buttons' => [
                        'tag' => function($url, $model, $key) {
                              $url = Yii::$app->urlManager->createUrl(['hostnametag/listtagbyhostname', 'hostname' => $model->hostname]);
                              //$url = '/index.php?r=hostname/viewbyhostname&hostname='.$model->hostname;
                              $options = [
                                    'title' => '变更tag',
                                    'data-pjax' => '0',
                              ];
                              return Html::a('<span class="glyphicon glyphicon-tags"></span>', $url, $options);
                        },
                  ]
            ],
        ],
    ]); ?>

</div>
