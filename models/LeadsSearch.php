<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leads;

/**
 * LeadsSearch represents the model behind the search form of `app\models\Leads`.
 */
class LeadsSearch extends Leads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['first_name', 'second_name', 'phone', 'address', 'email', 'description', 'created_at', 'modified_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Leads::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->created_at) && strpos($this->created_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->created_at);
            $start_timestamp = strtotime($start_date);
            $end_timestamp = strtotime($end_date);
            if($start_date==$end_date){
                $end_timestamp+=86400;
            }
            $query->andFilterWhere(['between', 'leads.created_at', $start_timestamp, $end_timestamp]);
        }

        if (!empty($this->modified_at) && strpos($this->modified_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->modified_at);
            $start_timestamp = strtotime($start_date);
            $end_timestamp = strtotime($end_date);
            if($start_date==$end_date){
                $end_timestamp+=86400;
            }
            $query->andFilterWhere(['between', 'leads.modified_at', $start_timestamp, $end_timestamp]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
