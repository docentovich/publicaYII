<?php
namespace app\widgets\userpanel;

use app\models\Profile;
use yii\base\Widget;

/**
 * Юзерпанель
 *
 * Class Href
 * @package app\widgets\href
 */
class Userpanel extends Widget
{
    public $profile;

    public function init()
    {
        parent::init();
        $this->profile = Profile::find()->where(["=","user_id",\Yii::$app->user->identity->getId()])->one();
    }

    public function run()
    {
        return $this->render('view', ["image" => $this->profile->image, "name" => $this->profile->name]);
    }
}