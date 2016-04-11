<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ngxcoderecord;

/**
 * NgxcoderecordSearch represents the model behind the search form about `app\models\Ngxcoderecord`.
 */
class NgxcoderecordSearch extends Ngxcoderecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num'], 'integer'],
            [['time', 'code', 'uri', 'upstreamaddr', 'ip'], 'safe'],
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
        $query = Ngxcoderecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'time' => SORT_DESC,
                    'num' => SORT_DESC,
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
            'num' => $this->num,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'uri', $this->uri])
            ->andFilterWhere(['like', 'upstreamaddr', $this->upstreamaddr]);

        return $dataProvider;
    }
}
