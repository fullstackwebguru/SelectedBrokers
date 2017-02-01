<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Feature;

/**
 * FeatureSearch represents the model behind the search form about `common\models\Feature`.
 */
class FeatureSearch extends Feature
{
    public $defaultSearch = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id','created_at', 'updated_at'], 'integer'],
            [['value', 'slug'], 'safe'],
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
        $query = Feature::find();

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
        
        // grid filtering conditions
        $where = [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        foreach($this->defaultSearch as $key => $value) {
            $where[$key] = $value;
        }

        $query->andFilterWhere($where);


        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
