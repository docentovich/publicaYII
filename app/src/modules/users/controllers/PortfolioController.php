<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PortfolioController extends  UserPanelController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['show', 'update'],
                        'allow' => true,
                        'roles' => ['model', 'photograph'],
                    ],
                ],
            ],
        ];
    }

    public function actionShow()
    {

    }
    public function actionUpdate()
    {

    }
}