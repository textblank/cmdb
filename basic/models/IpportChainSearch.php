<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IpportChain;

/**
 * IpportChainSearch represents the model behind the search form about `app\models\IpportChain`.
 */
class IpportChainSearch extends IpportChain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'times'], 'integer'],
            [['hostname', 'local_ip', 'local_port', 'peer_ip', 'peer_port', 'uptime'], 'safe'],
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
        $query = IpportChain::find();
        $query->andWhere(['>','times',2]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    ],
                ],
            'pagination' => ['pageSize'=>100],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'uptime' => $this->uptime,
            'times' => $this->times,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'local_ip', $this->local_ip])
            ->andFilterWhere(['like', 'local_port', $this->local_port])
            ->andFilterWhere(['like', 'peer_ip', $this->peer_ip])
            ->andFilterWhere(['like', 'peer_port', $this->peer_port]);

        return $dataProvider;
    }
}
