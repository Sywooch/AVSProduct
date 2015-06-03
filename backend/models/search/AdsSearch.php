<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ads;

/**
 * AdsSearch represents the model behind the search form about `app\models\Ads`.
 */
class AdsSearch extends Ads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type_id', 'created_at', 'updated_at'], 'integer'],
            [['banner_path', 'banner_base_url', 'name'], 'safe'],
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
        $query = Ads::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'banner_path', $this->banner_path])
            ->andFilterWhere(['like', 'banner_base_url', $this->banner_base_url])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
