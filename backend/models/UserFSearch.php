<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserF;

/**
 * UserFSearch represents the model behind the search form about `backend\models\UserF`.
 */
class UserFSearch extends UserF
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zip', 'status', 'reg_status'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone', 'city', 'country', 'gender', 'password', 'date_of_birth', 'auth_key', 'login_type'], 'safe'],
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
    public function search($params,$status)
    {
        $query = UserF::find();

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
            'zip' => $this->zip,
            'date_of_birth' => $this->date_of_birth,
            'status' => $status,
            'reg_status' => $this->reg_status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'login_type', $this->login_type]);

        return $dataProvider;
    }
}
