<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceImprovementTrackingInfo;

/**
 * ServiceImprovementTrackingInfoSearch represents the model behind the search form about `app\models\ServiceImprovementTrackingInfo`.
 */
class ServiceImprovementTrackingInfoSearch extends ServiceImprovementTrackingInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'creator_id'], 'integer'],
            [['info', 'creator', 'ctime'], 'safe'],
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
        $query = ServiceImprovementTrackingInfo::find();

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
            'parent_id' => $this->parent_id,
            'creator_id' => $this->creator_id,
            'ctime' => $this->ctime,
        ]);

        $query->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'creator', $this->creator]);

        return $dataProvider;
    }
}
