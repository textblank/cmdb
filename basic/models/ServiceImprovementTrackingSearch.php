<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceImprovementTracking;

/**
 * ServiceImprovementTrackingSearch represents the model behind the search form about `app\models\ServiceImprovementTracking`.
 */
class ServiceImprovementTrackingSearch extends ServiceImprovementTracking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'query_count', 'fail_count', 'status', 'type'], 'integer'],
            [['find_date', 'name', 'intro', 'employee_id', 'owner', 'plan', 'plan_date', 'finish_date'], 'safe'],
            [['fail_rate', 'timeout_rate', 'latency'], 'number'],
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
        $query = ServiceImprovementTracking::find();

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
            'find_date' => $this->find_date,
            'query_count' => $this->query_count,
            'fail_count' => $this->fail_count,
            'fail_rate' => $this->fail_rate,
            'timeout_rate' => $this->timeout_rate,
            'latency' => $this->latency,
            'plan_date' => $this->plan_date,
            'finish_date' => $this->finish_date,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'plan', $this->plan]);

        return $dataProvider;
    }
}
