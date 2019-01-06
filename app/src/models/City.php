<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $name
 * @property string $label
 *
 * @property \app\models\Post[] $posts
 * @property User[] $users
 */
class City extends \yii\db\ActiveRecord
{
    const DEFAULT_CITY_ID = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 5],
            [['label'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/tosee', 'ID'),
            'name' => Yii::t('app/tosee', 'Name'),
            'label' => Yii::t('app/tosee', 'Label'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['city_id' => 'id']);
    }

    public static function findDefault(){
        return self::findOne(['id' => 1]);
    }

    public static function asArray()
    {
        return  ArrayHelper::map(self::find()->all(), 'id', function ($val){
            return \Yii::t('app/cities', $val->label);
        });
    }

    public static function getCurrentCityId()
    {
        return \Yii::$app->request->cookies->getValue('city_id') ?? self::DEFAULT_CITY_ID;
    }

}
