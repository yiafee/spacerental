<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Land;

/**
 * LandSearch represents the model behind the search form about `backend\models\Land`.
 */
class LandSearch extends Land
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id'], 'integer'],
            [['title', 'address', 'short_desc', 'power_source', 'public_restroom', 'property_type', 'property_size', 'street_address'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
    public function search($params,$status = '')
    {
        $query = Land::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'status' => $status,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'power_source', $this->power_source])
            ->andFilterWhere(['like', 'public_restroom', $this->public_restroom])
            ->andFilterWhere(['like', 'property_type', $this->property_type])
            ->andFilterWhere(['like', 'property_size', $this->property_size])
            ->andFilterWhere(['like', 'street_address', $this->street_address]);

        return $dataProvider;
    }
}
