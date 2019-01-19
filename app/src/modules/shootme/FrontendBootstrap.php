<?php

namespace shootme;

use orders\controllers\OrdersController;
use yii\base\BootstrapInterface;

class FrontendBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(ShootmeUrls::frontUrls());

        $ordersService = \Yii::$container->set(
            OrdersController::class,
            ['layout' => "@current_template/layouts/main"]
        );
    }
}