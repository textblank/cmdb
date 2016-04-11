<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property string $id
 * @property string $hostname
 * @property string $assetId
 * @property string $busi1Id
 * @property string $idc
 * @property string $machineClass
 * @property integer $machineType
 * @property string $entityHostname
 * @property string $ip1
 * @property string $ip2
 * @property string $ip3
 * @property string $ip4
 * @property string $ip5
 * @property string $ip6
 * @property string $ip7
 * @property string $opAdmin
 * @property string $devAdmin
 * @property string $shelf
 * @property string $onShelfTime
 * @property string $switchIp1
 * @property string $switchPort1
 * @property string $switchIp2
 * @property string $switchPort2
 * @property string $swichIp3
 * @property string $switchPort3
 * @property string $switchIp4
 * @property string $switchPort4
 * @property string $switchIp5
 * @property string $switchPort5
 * @property string $switch6
 * @property string $switchPort6
 * @property string $switchIp7
 * @property string $switchPort7
 * @property string $networkOperator
 * @property integer $currentStatus
 * @property integer $importantLevel
 * @property string $osName
 * @property string $raid
 * @property string $speed7
 * @property string $speed6
 * @property string $speed5
 * @property string $speed4
 * @property string $speed3
 * @property string $speed2
 * @property string $speed1
 * @property string $gateway7
 * @property string $gateway6
 * @property string $gateway5
 * @property string $gateway4
 * @property string $gateway3
 * @property string $gateway2
 * @property string $gateway1
 * @property string $netmask7
 * @property string $netmask6
 * @property string $netmask5
 * @property string $netmask4
 * @property string $netmask3
 * @property string $netmask2
 * @property string $netmask1
 * @property string $mac7
 * @property string $mac6
 * @property string $mac5
 * @property string $mac4
 * @property string $mac3
 * @property string $mac2
 * @property string $mac1
 * @property string $ethernet7
 * @property string $ethernet6
 * @property string $ethernet5
 * @property string $ethernet4
 * @property string $ethernet3
 * @property string $ethernet2
 * @property string $ethernet1
 * @property string $memorySize
 * @property string $diskSize
 * @property string $disks
 * @property string $uuid
 * @property string $serialNumber
 * @property string $productName
 * @property string $manufacturer
 * @property string $vender
 * @property string $cpuHz
 * @property string $cpuInfo
 * @property integer $cpuNum
 * @property string $price
 * @property string $buyDate
 * @property string $majorService
 * @property string $memo
 * @property string $hwInfoReportTime
 * @property string $lastModify
 * @property string $switchBoard1
 * @property string $switchBoard2
 * @property string $switchBoard3
 * @property string $switchBoard4
 * @property string $switchBoard5
 * @property string $switchBoard6
 * @property string $switchBoard7
 * @property integer $needMonitor
 * @property string $shelfPlace
 * @property string $maintenancePeriod
 */
class Machine extends \yii\db\ActiveRecord
{
    public $hostnames;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['machineType', 'currentStatus', 'importantLevel', 'cpuNum', 'needMonitor'], 'integer'],
            [['onShelfTime', 'buyDate', 'hwInfoReportTime', 'lastModify', 'maintenancePeriod'], 'safe'],
            [['hostname', 'busi1Id', 'entityHostname', 'opAdmin', 'devAdmin', 'speed7', 'speed6', 'speed5', 'speed4', 'speed3', 'speed2', 'speed1', 'gateway7', 'gateway6', 'gateway5', 'gateway4', 'gateway3', 'gateway2', 'gateway1', 'netmask7', 'netmask6', 'netmask5', 'netmask4', 'netmask3', 'netmask2', 'netmask1', 'mac7', 'mac6', 'mac5', 'mac4', 'mac3', 'mac2', 'mac1', 'ethernet7', 'ethernet6', 'ethernet5', 'ethernet4', 'ethernet3', 'ethernet2', 'ethernet1', 'memorySize', 'uuid', 'serialNumber', 'productName', 'manufacturer', 'vender', 'cpuHz'], 'string', 'max' => 128],
            [['assetId', 'networkOperator', 'raid'], 'string', 'max' => 16],
            [['idc', 'machineClass', 'shelf', 'price', 'switchBoard1', 'switchBoard2', 'switchBoard3', 'switchBoard4', 'switchBoard5', 'switchBoard6', 'switchBoard7', 'shelfPlace'], 'string', 'max' => 32],
            [['ip1', 'ip2', 'ip3', 'ip4', 'ip5', 'ip6', 'ip7', 'switchIp1', 'switchIp2', 'swichIp3', 'switchIp4', 'switchIp5', 'switch6', 'switchIp7'], 'string', 'max' => 15],
            [['switchPort1', 'switchPort2', 'switchPort3', 'switchPort4', 'switchPort5', 'switchPort6', 'switchPort7'], 'string', 'max' => 6],
            [['osName'], 'string', 'max' => 64],
            [['diskSize', 'cpuInfo', 'majorService', 'memo'], 'string', 'max' => 256],
            [['disks'], 'string', 'max' => 512],
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
            'hostnames' => '机器列表',
            'hostname' => 'hostname',
            'assetId' => '固资编号',
            'busi1Id' => '一级业务',
            'idc' => '机房',
            'machineClass' => '机型',
            'machineType' => '1:实机,2:虚机',
            'entityHostname' => '宿主机',
            'ip1' => 'ip1',
            'ip2' => 'ip2',
            'ip3' => 'ip3',
            'ip4' => 'ip4',
            'ip5' => 'ip5',
            'ip6' => 'Ip6',
            'ip7' => 'Ip7',
            'opAdmin' => 'ops',
            'devAdmin' => 'Dev Admin',
            'shelf' => '机架',
            'onShelfTime' => '上架时间',
            'switchIp1' => 'Switch Ip1',
            'switchPort1' => 'Switch Port1',
            'switchIp2' => 'Switch Ip2',
            'switchPort2' => 'Switch Port2',
            'swichIp3' => 'Swich Ip3',
            'switchPort3' => 'Switch Port3',
            'switchIp4' => 'Switch Ip4',
            'switchPort4' => 'Switch Port4',
            'switchIp5' => 'Switch Ip5',
            'switchPort5' => 'Switch Port5',
            'switch6' => 'Switch6',
            'switchPort6' => 'Switch Port6',
            'switchIp7' => 'Switch Ip7',
            'switchPort7' => 'Switch Port7',
            'networkOperator' => '运营商',
            'currentStatus' => '状态',
            'importantLevel' => '重要级别',
            'osName' => 'Os Name',
            'raid' => 'Raid',
            'speed7' => 'Speed7',
            'speed6' => 'Speed6',
            'speed5' => 'Speed5',
            'speed4' => 'Speed4',
            'speed3' => 'Speed3',
            'speed2' => 'Speed2',
            'speed1' => 'Speed1',
            'gateway7' => 'Gateway7',
            'gateway6' => 'Gateway6',
            'gateway5' => 'Gateway5',
            'gateway4' => 'Gateway4',
            'gateway3' => 'Gateway3',
            'gateway2' => 'Gateway2',
            'gateway1' => 'Gateway1',
            'netmask7' => 'Netmask7',
            'netmask6' => 'Netmask6',
            'netmask5' => 'Netmask5',
            'netmask4' => 'Netmask4',
            'netmask3' => 'Netmask3',
            'netmask2' => 'Netmask2',
            'netmask1' => 'Netmask1',
            'mac7' => 'Mac7',
            'mac6' => 'Mac6',
            'mac5' => 'Mac5',
            'mac4' => 'Mac4',
            'mac3' => 'Mac3',
            'mac2' => 'Mac2',
            'mac1' => 'Mac1',
            'ethernet7' => 'Ethernet7',
            'ethernet6' => 'Ethernet6',
            'ethernet5' => 'Ethernet5',
            'ethernet4' => 'Ethernet4',
            'ethernet3' => 'Ethernet3',
            'ethernet2' => 'Ethernet2',
            'ethernet1' => 'Ethernet1',
            'memorySize' => '内存',
            'diskSize' => 'Disk Size',
            'disks' => 'Disks',
            'uuid' => 'Uuid',
            'serialNumber' => 'Serial Number',
            'productName' => '产品',
            'manufacturer' => 'Manufacturer',
            'vender' => 'Vender',
            'cpuHz' => 'Cpu Hz',
            'cpuInfo' => 'Cpu Info',
            'cpuNum' => 'Cpu Num',
            'price' => 'Price',
            'buyDate' => 'Buy Date',
            'majorService' => '主服务',
            'memo' => '备注',
            'hwInfoReportTime' => 'Hw Info Report Time',
            'lastModify' => 'Last Modify',
            'switchBoard1' => 'Switch Board1',
            'switchBoard2' => 'Switch Board2',
            'switchBoard3' => 'Switch Board3',
            'switchBoard4' => 'Switch Board4',
            'switchBoard5' => 'Switch Board5',
            'switchBoard6' => 'Switch Board6',
            'switchBoard7' => 'Switch Board7',
            'needMonitor' => '需监控？',
            'shelfPlace' => '机位',
            'maintenancePeriod' => '保修期',
        ];
    }
}
