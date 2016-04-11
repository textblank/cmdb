<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FileDeleteConfig;

/**
 * FileDeleteConfigDetailSearch represents the model behind the search form about `app\models\FileDeleteConfig`.
 */
class FileDeleteConfigSearch extends FileDeleteConfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'threshold'], 'integer'],
            [['hostname', 'path', 'matching'], 'safe'],
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
        $query = FileDeleteConfig::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'hostname' => SORT_ASC,
                    ],
                ],
            'pagination' => ['pageSize'=>50],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'threshold' => $this->threshold,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'matching', $this->matching]);

        return $dataProvider;
    }
}
