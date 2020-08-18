<?php

namespace modava\pages\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modava\pages\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `modava\pages\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'position', 'status', 'views', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'image', 'description', 'content', 'tech', 'ads_pixel', 'ads_session', 'language'], 'safe'],
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
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'status' => $this->status,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tech', $this->tech])
            ->andFilterWhere(['like', 'ads_pixel', $this->ads_pixel])
            ->andFilterWhere(['like', 'ads_session', $this->ads_session])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
