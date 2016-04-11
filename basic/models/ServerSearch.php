<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Server;

/**
 * ServerSearch represents the model behind the search form about `app\models\Server`.
 */
class ServerSearch extends Server
{
    public $biz1cname;
    public $biz2cname;
    public $biz3cname;
    public $hosts;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'busi1Id', 'busi2Id', 'busi3Id', 'currentStatus', 'importantLevel', 'needMonitor', 'cpuNum', 'machineType'], 'integer'],
            [['hostname', 'ip1', 'opAdmin', 'devAdmin', 'entityHostname', 'memorySize', 'disks', 'diskSize', 'idc', 'shelf', 'assetId', 'machineClass', 'cpuHz', 'cpuInfo', 'memo', 'ip2', 'ip3', 'ip4', 'ip5', 'ip6', 'ip7', 'onShelfTime', 'uuid', 'networkOperator', 'osName', 'raid', 'serialNumber', 'manufacturer', 'vender', 'price', 'buyDate', 'majorService', 'hwInfoReportTime', 'lastModify', 'shelfPlace', 'maintenancePeriod', 'biz1cname', 'biz2cname', 'biz3cname'], 'safe'],
        ];
    }

    public function attributeLabels(){
        return array_merge(parent::attributeLabels(),  [
            'biz1cname' => '一级业务',
            'biz2cname' => '二级业务',
            'biz3cname' => '三级业务',
        ]);
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
        $query = self::find()->joinWith(['biz1','biz2','biz3']);

        $query->andWhere(['<','currentStatus', Server::CURRENT_STATUS_OFFLINE]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'hostname' => SORT_DESC,
                    ],
                ],
            'pagination' => ['pageSize'=>100],
        ]);

        //给用tag查询hostname用
        if($this->hosts)
            $dataProvider->query->andWhere(['hostname' => $this->hosts]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'busi1Id' => $this->busi1Id,
            'busi2Id' => $this->busi2Id,
            'busi3Id' => $this->busi3Id,
            'currentStatus' => $this->currentStatus,
            'importantLevel' => $this->importantLevel,
            'needMonitor' => $this->needMonitor,
            'cpuNum' => $this->cpuNum,
            'machineType' => $this->machineType,
            'onShelfTime' => $this->onShelfTime,
            'buyDate' => $this->buyDate,
            'hwInfoReportTime' => $this->hwInfoReportTime,
            'lastModify' => $this->lastModify,
            'maintenancePeriod' => $this->maintenancePeriod,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'ip1', $this->ip1])
            ->andFilterWhere(['like', 'opAdmin', $this->opAdmin])
            ->andFilterWhere(['like', 'devAdmin', $this->devAdmin])
            ->andFilterWhere(['like', 'devAdminId', $this->devAdminId])
            ->andFilterWhere(['like', 'entityHostname', $this->entityHostname])
            ->andFilterWhere(['like', 'memorySize', $this->memorySize])
            ->andFilterWhere(['like', 'disks', $this->disks])
            ->andFilterWhere(['like', 'diskSize', $this->diskSize])
            ->andFilterWhere(['like', 'idc', $this->idc])
            ->andFilterWhere(['like', 'shelf', $this->shelf])
            ->andFilterWhere(['like', 'assetId', $this->assetId])
            ->andFilterWhere(['like', 'machineClass', $this->machineClass])
            ->andFilterWhere(['like', 'cpuHz', $this->cpuHz])
            ->andFilterWhere(['like', 'cpuInfo', $this->cpuInfo])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'ip2', $this->ip2])
            ->andFilterWhere(['like', 'ip3', $this->ip3])
            ->andFilterWhere(['like', 'ip4', $this->ip4])
            ->andFilterWhere(['like', 'ip5', $this->ip5])
            ->andFilterWhere(['like', 'ip6', $this->ip6])
            ->andFilterWhere(['like', 'ip7', $this->ip7])
            ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'networkOperator', $this->networkOperator])
            ->andFilterWhere(['like', 'osName', $this->osName])
            ->andFilterWhere(['like', 'raid', $this->raid])
            ->andFilterWhere(['like', 'serialNumber', $this->serialNumber])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'vender', $this->vender])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'majorService', $this->majorService])
            ->andFilterWhere(['like', 'shelfPlace', $this->shelfPlace])
            ->andFilterWhere(['like', 'biz1.cname', $this->biz1cname])
            ->andFilterWhere(['like', 'biz2.cname', $this->biz2cname])
            ->andFilterWhere(['like', 'biz3.cname', $this->biz3cname]);

        $dataProvider->sort->attributes['biz1cname'] = [
            'asc' => ['biz1.cname' => SORT_ASC],
            'desc' => ['biz1.cname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['biz2cname'] = [
            'asc' => ['biz2.cname' => SORT_ASC],
            'desc' => ['biz2.cname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['biz3cname'] = [
            'asc' => ['biz3.cname' => SORT_ASC],
            'desc' => ['biz3.cname' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
