<?php

namespace modules\tosee\models\common;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\tosee\models\common\Post;

/**
 * PostSearch represents the model behind the search form of `modules\tosee\models\common\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at'], 'safe'],
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
        $query = Post::find()->where(["=", "user_id", Yii::$app->user->identity->getId()]);

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
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'event_at' => $this->event_at,
            'post_category_id' => $this->post_category_id,
            'image_id' => $this->image_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
