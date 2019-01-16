<?php

namespace tosee\models;

use Yii;
use app\models\PostData;

class ToseePostData extends PostData
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tosee_post_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sub_header'], 'required'],
            [['sub_header', 'post_desc'], 'string'],
            [['post_like_count', 'post_view_count'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToseePost::class, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => \Yii::t('app/tosee', 'Post ID'),
            'title' => \Yii::t('app/tosee', 'Заголовок'),
            'sub_header' => \Yii::t('app/tosee', 'Подзаголовок'),
            'post_short_desc' => \Yii::t('app/tosee', 'Sub header'),
            'post_desc' => \Yii::t('app/tosee', 'Text'),
            'post_like_count' => \Yii::t('app/tosee', 'Post Like Count'),
            'post_view_count' => \Yii::t('app/tosee', 'Post View Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(ToseePost::class, ['id' => 'post_id']);
    }
}