<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BlockCode;

/**
 * BlockCodeSearch represents the model behind the search form about `app\models\BlockCode`.
 */
class BlockCodeSearch extends BlockCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'platform_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'hash_block'], 'safe'],
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
        $query = BlockCode::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'platform_id' => $this->platform_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'hash_block', $this->hash_block]);

        return $dataProvider;
    }
}
