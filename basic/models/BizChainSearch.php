<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BizChain;

/**
 * BizChainSearch represents the model behind the search form about `app\models\BizChain`.
 */
class BizChainSearch extends BizChain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'local_biz_id', 'peer_biz_id', 'num'], 'integer'],
            [['local_biz_name', 'peer_biz_name'], 'safe'],
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
        $query = BizChain::find();

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
            'local_biz_id' => $this->local_biz_id,
            'peer_biz_id' => $this->peer_biz_id,
            'num' => $this->num,
        ]);

        $query->andFilterWhere(['like', 'local_biz_name', $this->local_biz_name])
            ->andFilterWhere(['like', 'peer_biz_name', $this->peer_biz_name]);

        return $dataProvider;
    }
}
