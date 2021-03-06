<?php

namespace modules\probank\models\common;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\probank\models\common\Post;
use yii\web\HttpException;

/**
 * PostSearch represents the model behind the search form of `modules\probank\models\common\Post`.
 */
class ModeratorPostSearch extends Post
{

    public $postDataTitle;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'post_category_id', 'image_id', 'status'], 'integer'],
            [['event_at', 'created_at', 'postDataTitle'], 'safe'],
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
    public function search($params, $all=false)
    {

        if(!Yii::$app->user->can("moderator"))
            throw new HttpException("Forbidden");
        $query = Post::find();
        if(!$all)
             $query->where(["=", "status", Post::STATUS_ON_MODERATE]);

        if(!Yii::$app->user->can("administrator"))
            $query->andWhere(["=", "city_id", Yii::$app->user->identity->city_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'event_at',
                'postDataTitle' => [
                    'asc' => [PostData::tableName() . '.title' => SORT_ASC],
                    'desc' => [PostData::tableName() . '.title' => SORT_DESC],
                    'label' => 'Заголовок'
                ],
                'created_at'
            ]
        ]);

        $this->load($params);

        $query->joinWith(['postData' => function ($q) {
            $q->where(PostData::tableName() . '.title LIKE "%' . $this->postDataTitle . '%" ');
        }]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_at' => $this->event_at,
            'post_category_id' => $this->post_category_id,
            'image_id' => $this->image_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
