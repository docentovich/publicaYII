<?php

namespace app\widgets\header;

use yii\base\Widget;
use yii\web\AssetBundle;

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

        return $this->render("view", [
            "content" => $content,
            "currentProject" => $this->project,
            "projects" => ['tosee', 'publica', 'probank', 'shootme']
        ]);
    }
}