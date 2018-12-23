<?php

namespace app\widgets\header;

use app\models\City;
use yii\base\Widget;

/**
 * Самая врхняя плашечка
 *
 * Class Header
 * @package app\widgets\header
 */
class Header extends Widget
{
    /** @var string */
    public $project;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        $city_cookie =  \Yii::$app->request->cookies->getValue('city_id');
        $current_city = City::findOne(["id" => $city_cookie]);
        $current_city = $current_city ?? City::findDefault();

        return $this->render("view", [
            "content" => $content,
            "currentProject" => $this->project,
            "cities" => City::find()->all(),
            "current_city" => $current_city
        ]);
    }
}