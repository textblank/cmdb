<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "server".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $ip1
 * @property string $opAdmin
 * @property string $devAdmin
 * @property integer $busi1Id
 * @property integer $busi2Id
 * @property integer $busi3Id
 * @property integer $currentStatus
 * @property integer $importantLevel
 * @property integer $needMonitor
 * @property string $entityHostname
 * @property string $memorySize
 * @property string $disks
 * @property string $diskSize
 * @property integer $cpuNum
 * @property string $idc
 * @property string $shelf
 * @property integer $machineType
 * @property string $assetId
 * @property string $machineClass
 * @property string $cpuHz
 * @property string $cpuInfo
 * @property string $memo
 * @property string $ip2
 * @property string $ip3
 * @property string $ip4
 * @property string $ip5
 * @property string $ip6
 * @property string $ip7
 * @property string $onShelfTime
 * @property string $uuid
 * @property string $networkOperator
 * @property string $osName
 * @property string $raid
 * @property string $serialNumber
 * @property string $manufacturer
 * @property string $vender
 * @property string $price
 * @property string $buyDate
 * @property string $majorService
 * @property string $hwInfoReportTime
 * @property string $lastModify
 * @property string $shelfPlace
 * @property string $maintenancePeriod
 */
class Server extends \yii\db\ActiveRecord
{
    public $hostnames;

    const CURRENT_STATUS_BEFORE_ONLINE = 0;
    const CURRENT_STATUS_ONLINE = 1;
    const CURRENT_STATUS_MAINTENANCE = 2;
    const CURRENT_STATUS_OFFLINE = 3;

    const IMPORTANT_LEVEL_1 = 1;
    const IMPORTANT_LEVEL_2 = 2;
    const IMPORTANT_LEVEL_3 = 3;

    const MACHINE_TYPE_P = 1;
    const MACHINE_TYPE_V = 2;

    const NEED_MONITOR_Y = 1;
    const NEED_MONITOR_N = 0;



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['busi1Id', 'busi2Id', 'busi3Id', 'currentStatus',  'importantLevel', 'needMonitor', 'cpuNum', 'machineType'], 'integer'],
            [['onShelfTime', 'buyDate', 'hwInfoReportTime', 'lastModify', 'maintenancePeriod'], 'safe'],
            [['devAdminId', 'hostname', 'opAdmin', 'devAdmin', 'entityHostname', 'memorySize', 'cpuHz', 'uuid', 'osName', 'serialNumber', 'manufacturer', 'vender'], 'string', 'max' => 128],
            [['ip1', 'ip2', 'ip3', 'ip4', 'ip5', 'ip6', 'ip7'], 'string', 'max' => 15],
            [['disks'], 'string', 'max' => 512],
            [['diskSize', 'cpuInfo', 'memo', 'majorService'], 'string', 'max' => 256],
            [['idc', 'shelf', 'machineClass', 'price', 'shelfPlace'], 'string', 'max' => 32],
            [['assetId', 'networkOperator', 'raid'], 'string', 'max' => 16],
            [['hostname'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '服务器ID',
            'hostnames' => 'hostnames',
            'hostname' => 'hostname',
            'ip1' => 'ip1',
            'opAdmin' => 'ops',
            'devAdmin' => '负责人',
            'devAdminId' => '负责人ID',
            'busi1Id' => '一级业务',
            'busi2Id' => '二级业务',
            'busi3Id' => '三级业务',
            'currentStatus' => '状态',
            'importantLevel' => '重要级别',
            'needMonitor' => '监控',
            'entityHostname' => '宿主机',
            'memorySize' => '内存',
            'disks' => 'Disks',
            'diskSize' => 'Disk Size',
            'cpuNum' => 'Cpu Num',
            'idc' => '机房',
            'shelf' => '机架',
            'machineType' => '类别',
            'assetId' => '固资编号',
            'machineClass' => '机型',
            'cpuHz' => 'Cpu Hz',
            'cpuInfo' => 'Cpu Info',
            'memo' => '备注',
            'ip2' => 'ip2',
            'ip3' => 'ip3',
            'ip4' => 'ip4',
            'ip5' => 'ip5',
            'ip6' => 'Ip6',
            'ip7' => 'Ip7',
            'onShelfTime' => '上架时间',
            'uuid' => 'Uuid',
            'networkOperator' => '运营商',
            'osName' => 'Os Name',
            'raid' => 'Raid',
            'serialNumber' => 'Serial Number',
            'manufacturer' => 'Manufacturer',
            'vender' => 'Vender',
            'price' => 'Price',
            'buyDate' => 'Buy Date',
            'majorService' => '主服务',
            'hwInfoReportTime' => 'Hw Info Report Time',
            'lastModify' => 'Last Modify',
            'shelfPlace' => '机位',
            'maintenancePeriod' => '保修期',
        ];
    }

    public function getBiz1(){
        return $this->hasOne(Biz::className(), ['id' => 'busi1Id'])->from('biz as biz1');
    }

    public function getBiz2(){
        return $this->hasOne(Biz::className(), ['id' => 'busi2Id'])->from('biz as biz2');
    }

    public function getBiz3(){
        return $this->hasOne(Biz::className(), ['id' => 'busi3Id'])->from('biz as biz3');
    }
    /*
    public function getBiz($id){
        static $nameList;
        $nameList = Biz::nameList();
        return isset($nameList[$id]) ? $nameList[$id] : '';
    }
    */
}
