<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Askforresource;

/**
 * AskforresourceSearch represents the model behind the search form about `app\models\Askforresource`.
 */
class AskforresourceSearch extends Askforresource
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'machineType', 'num', 'cpu', 'mem', 'sysdisk', 'userdisk', 'insideBandwidth', 'outsideBandwidth', 'status'], 'integer'],
            [['product', 'module', 'owner', 'neworexpansion', 'purpose', 'os', 'osver', 'expectDate', 'explan', 'memo'], 'safe'],
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
        $query = Askforresource::find();

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
            'num' => $this->num,
            'cpu' => $this->cpu,
            'mem' => $this->mem,
            'sysdisk' => $this->sysdisk,
            'userdisk' => $this->userdisk,
            'insideBandwidth' => $this->insideBandwidth,
            'outsideBandwidth' => $this->outsideBandwidth,
            'expectDate' => $this->expectDate,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'os', $this->os])
            ->andFilterWhere(['like', 'osver', $this->osver])
            ->andFilterWhere(['like', 'explan', $this->explan])
            ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
