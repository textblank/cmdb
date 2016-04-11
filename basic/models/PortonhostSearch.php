<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Portonhost;

/**
 * PortonhostSearch represents the model behind the search form about `app\models\Portonhost`.
 */
class PortonhostSearch extends Portonhost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'port'], 'integer'],
            [['hostname', 'user', 'processname', 'cmdline', 'owner', 'lasttime', 'firsttime'], 'safe'],
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
        $time = date('Y-m-d H:i:s', time()-3600);
        $query = Portonhost::find();
        $query->andWhere(['>', 'lasttime', $time]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'port' => $this->port,
            'lasttime' => $this->lasttime,
            'firsttime' => $this->firsttime,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'processname', $this->processname])
            ->andFilterWhere(['like', 'cmdline', $this->cmdline])
            ->andFilterWhere(['like', 'owner', $this->owner]);

        return $dataProvider;
    }
}
