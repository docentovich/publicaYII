<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 27.11.2017
 * Time: 4:17
 */

namespace modules\probank\controllers\backend;

use yii\web\Controller;

class PhotographerController extends Controller
{
    public $layout = "@current_template/layouts/main";

    public function actionIndex()
    {
        return $this->render('index');
    }
}