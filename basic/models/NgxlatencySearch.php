<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ngxlatency;

/**
 * NgxlatencySearch represents the model behind the search form about `app\models\Ngxlatency`.
 */
class NgxlatencySearch extends Ngxlatency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num', 't100', 't200', 't500', 't1000', 't3000', 'tt'], 'integer'],
            [['time', 'ip', 'uri', 'pt100', 'pt200', 'pt500', 'pt1000', 'pt3000', 'ptt'], 'safe'],
            [['min', 'avg', 'max'], 'number'],
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
        $query = Ngxlatency::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'time' => SORT_DESC,
                    'num' => SORT_DESC,
                    'ptt' => SORT_DESC,
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
            'min' => $this->min,
            'avg' => $this->avg,
            'max' => $this->max,
            't100' => $this->t100,
            't200' => $this->t200,
            't500' => $this->t500,
            't1000' => $this->t1000,
            't3000' => $this->t3000,
            'tt' => $this->tt,
            'pt100' => $this->pt100,
            'pt200' => $this->pt200,
            'pt500' => $this->pt500,
            'pt1000' => $this->pt1000,
            'pt3000' => $this->pt3000,
            'ptt' => $this->ptt,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'uri', $this->uri]);

        return $dataProvider;
    }
}
