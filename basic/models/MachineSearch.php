<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Machine;

/**
 * MachineSearch represents the model behind the search form about `app\models\Machine`.
 */
class MachineSearch extends Machine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'machineType', 'shelf', 'switchIp1', 'switchIp2', 'swichIp3', 'switchIp4', 'switchIp5', 'switch6', 'switchIp7', 'currentStatus', 'importantLevel', 'cpuNum', 'needMonitor'], 'integer'],
            [['hostname', 'assetId', 'busi1Id', 'idc', 'machineClass', 'entityHostname', 'ip1', 'ip2', 'ip3', 'ip4', 'ip5', 'ip6', 'ip7', 'opAdmin', 'devAdmin', 'onShelfTime', 'switchPort1', 'switchPort2', 'switchPort3', 'switchPort4', 'switchPort5', 'switchPort6', 'switchPort7', 'networkOperator', 'osName', 'raid', 'speed7', 'speed6', 'speed5', 'speed4', 'speed3', 'speed2', 'speed1', 'gateway7', 'gateway6', 'gateway5', 'gateway4', 'gateway3', 'gateway2', 'gateway1', 'netmask7', 'netmask6', 'netmask5', 'netmask4', 'netmask3', 'netmask2', 'netmask1', 'mac7', 'mac6', 'mac5', 'mac4', 'mac3', 'mac2', 'mac1', 'ethernet7', 'ethernet6', 'ethernet5', 'ethernet4', 'ethernet3', 'ethernet2', 'ethernet1', 'memorySize', 'diskSize', 'disks', 'uuid', 'serialNumber', 'productName', 'manufacturer', 'vender', 'cpuHz', 'cpuInfo', 'price', 'buyDate', 'majorService', 'memo', 'hwInfoReportTime', 'lastModify', 'switchBoard1', 'switchBoard2', 'switchBoard3', 'switchBoard4', 'switchBoard5', 'switchBoard6', 'switchBoard7', 'shelfPlace', 'maintenancePeriod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Machine::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'machineType' => $this->machineType,
            'shelf' => $this->shelf,
            'onShelfTime' => $this->onShelfTime,
            'switchIp1' => $this->switchIp1,
            'switchIp2' => $this->switchIp2,
            'swichIp3' => $this->swichIp3,
            'switchIp4' => $this->switchIp4,
            'switchIp5' => $this->switchIp5,
            'switch6' => $this->switch6,
            'switchIp7' => $this->switchIp7,
            'currentStatus' => $this->currentStatus,
            'importantLevel' => $this->importantLevel,
            'cpuNum' => $this->cpuNum,
            'buyDate' => $this->buyDate,
            'hwInfoReportTime' => $this->hwInfoReportTime,
            'lastModify' => $this->lastModify,
            'needMonitor' => $this->needMonitor,
            'maintenancePeriod' => $this->maintenancePeriod,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'assetId', $this->assetId])
            ->andFilterWhere(['like', 'busi1Id', $this->busi1Id])
            ->andFilterWhere(['like', 'idc', $this->idc])
            ->andFilterWhere(['like', 'machineClass', $this->machineClass])
            ->andFilterWhere(['like', 'entityHostname', $this->entityHostname])
            ->andFilterWhere(['like', 'ip1', $this->ip1])
            ->andFilterWhere(['like', 'ip2', $this->ip2])
            ->andFilterWhere(['like', 'ip3', $this->ip3])
            ->andFilterWhere(['like', 'ip4', $this->ip4])
            ->andFilterWhere(['like', 'ip5', $this->ip5])
            ->andFilterWhere(['like', 'ip6', $this->ip6])
            ->andFilterWhere(['like', 'ip7', $this->ip7])
            ->andFilterWhere(['like', 'opAdmin', $this->opAdmin])
            ->andFilterWhere(['like', 'devAdmin', $this->devAdmin])
            ->andFilterWhere(['like', 'switchPort1', $this->switchPort1])
            ->andFilterWhere(['like', 'switchPort2', $this->switchPort2])
            ->andFilterWhere(['like', 'switchPort3', $this->switchPort3])
            ->andFilterWhere(['like', 'switchPort4', $this->switchPort4])
            ->andFilterWhere(['like', 'switchPort5', $this->switchPort5])
            ->andFilterWhere(['like', 'switchPort6', $this->switchPort6])
            ->andFilterWhere(['like', 'switchPort7', $this->switchPort7])
            ->andFilterWhere(['like', 'networkOperator', $this->networkOperator])
            ->andFilterWhere(['like', 'osName', $this->osName])
            ->andFilterWhere(['like', 'raid', $this->raid])
            ->andFilterWhere(['like', 'speed7', $this->speed7])
            ->andFilterWhere(['like', 'speed6', $this->speed6])
            ->andFilterWhere(['like', 'speed5', $this->speed5])
            ->andFilterWhere(['like', 'speed4', $this->speed4])
            ->andFilterWhere(['like', 'speed3', $this->speed3])
            ->andFilterWhere(['like', 'speed2', $this->speed2])
            ->andFilterWhere(['like', 'speed1', $this->speed1])
            ->andFilterWhere(['like', 'gateway7', $this->gateway7])
            ->andFilterWhere(['like', 'gateway6', $this->gateway6])
            ->andFilterWhere(['like', 'gateway5', $this->gateway5])
            ->andFilterWhere(['like', 'gateway4', $this->gateway4])
            ->andFilterWhere(['like', 'gateway3', $this->gateway3])
            ->andFilterWhere(['like', 'gateway2', $this->gateway2])
            ->andFilterWhere(['like', 'gateway1', $this->gateway1])
            ->andFilterWhere(['like', 'netmask7', $this->netmask7])
            ->andFilterWhere(['like', 'netmask6', $this->netmask6])
            ->andFilterWhere(['like', 'netmask5', $this->netmask5])
            ->andFilterWhere(['like', 'netmask4', $this->netmask4])
            ->andFilterWhere(['like', 'netmask3', $this->netmask3])
            ->andFilterWhere(['like', 'netmask2', $this->netmask2])
            ->andFilterWhere(['like', 'netmask1', $this->netmask1])
            ->andFilterWhere(['like', 'mac7', $this->mac7])
            ->andFilterWhere(['like', 'mac6', $this->mac6])
            ->andFilterWhere(['like', 'mac5', $this->mac5])
            ->andFilterWhere(['like', 'mac4', $this->mac4])
            ->andFilterWhere(['like', 'mac3', $this->mac3])
            ->andFilterWhere(['like', 'mac2', $this->mac2])
            ->andFilterWhere(['like', 'mac1', $this->mac1])
            ->andFilterWhere(['like', 'ethernet7', $this->ethernet7])
            ->andFilterWhere(['like', 'ethernet6', $this->ethernet6])
            ->andFilterWhere(['like', 'ethernet5', $this->ethernet5])
            ->andFilterWhere(['like', 'ethernet4', $this->ethernet4])
            ->andFilterWhere(['like', 'ethernet3', $this->ethernet3])
            ->andFilterWhere(['like', 'ethernet2', $this->ethernet2])
            ->andFilterWhere(['like', 'ethernet1', $this->ethernet1])
            ->andFilterWhere(['like', 'memorySize', $this->memorySize])
            ->andFilterWhere(['like', 'diskSize', $this->diskSize])
            ->andFilterWhere(['like', 'disks', $this->disks])
            ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'serialNumber', $this->serialNumber])
            ->andFilterWhere(['like', 'productName', $this->productName])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'vender', $this->vender])
            ->andFilterWhere(['like', 'cpuHz', $this->cpuHz])
            ->andFilterWhere(['like', 'cpuInfo', $this->cpuInfo])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'majorService', $this->majorService])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'switchBoard1', $this->switchBoard1])
            ->andFilterWhere(['like', 'switchBoard2', $this->switchBoard2])
            ->andFilterWhere(['like', 'switchBoard3', $this->switchBoard3])
            ->andFilterWhere(['like', 'switchBoard4', $this->switchBoard4])
            ->andFilterWhere(['like', 'switchBoard5', $this->switchBoard5])
            ->andFilterWhere(['like', 'switchBoard6', $this->switchBoard6])
            ->andFilterWhere(['like', 'switchBoard7', $this->switchBoard7])
            ->andFilterWhere(['like', 'shelfPlace', $this->shelfPlace]);

        return $dataProvider;
    }
}
