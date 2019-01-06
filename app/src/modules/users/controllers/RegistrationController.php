<?php

namespace users\controllers;

use users\models\UsersUserForm;
use users\dto\UserServiceConfig;
use users\events\UserFormEvent;
use users\services\UserService;
use dektrium\user\Finder;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends \dektrium\user\controllers\RegistrationController
{
    use AjaxValidationTrait;
    use EventTrait;
    /** @var Finder */
    protected $finder;
    /** @var UserService */
    private $userService;

    public $layout = "@current_template/layouts/user";

    public function setUserService($userService)
    {
        $this->userService = $userService;
    }

    public function getUserService()
    {
        return $this->userService;
    }


    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'actions' => ['register', 'connect'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['confirm', 'resend', 'choose-role'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }

    /**
     * Wrap the dekctrium controller's event handlers into the object, and send to service
     *
     * @param array $config
     * @return UserServiceConfig
     */
    private function prepareConfig($config = []): UserServiceConfig
    {
        $self = $this;
        $config = ArrayHelper::merge($config,
            [
                'performAjaxValidation' => function ($form_model) use ($self) {
                    return $self->performAjaxValidation($form_model);
                },
                'getFormEvent' => function ($form_model) use ($self) {
                    return $self->getFormEvent($form_model);
                },
            ]
        );
        return new UserServiceConfig($config);
    }


    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\ExitException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRegister()
    {
        $user_form_model = new UsersUserForm(['scenario' => UsersUserForm::SCENARIO_REGISTER]);
        $this->performAjaxValidation($user_form_model);

        // bind on service event decktrium event
        $this->userService->on(UserService::EVENT_AFTER_REGISTER, function ($serviceEvent) {
            /** @var UserFormEvent $serviceEvent */
            $event = $this->getFormEvent($serviceEvent->userForm);
            $this->trigger(RegistrationController::EVENT_AFTER_REGISTER, $event);
        });

        // bind on service event decktrium event
        $this->userService->on(UserService::EVENT_BEFORE_REGISTER, function ($serviceEvent) use ($user_form_model) {
            $event = $this->getFormEvent($user_form_model);
            $this->trigger(RegistrationController::EVENT_BEFORE_REGISTER, $event);
        });

        $transport_model = $this->userService->action(
            $this->prepareConfig([
                'action' => UserService::ACTION_REGISTRATION,
                'userFormModel' => $user_form_model
            ])
        );

        return $this->render('register', [
            'identity' => \Yii::$app->user->identity,
            'transport_model' => $transport_model
        ]);
    }


    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int $id
     * @param string $code
     * @return string|void
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        $event = $this->getUserEvent($user);
        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);
        $user->attemptConfirmation($code);
        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);

        //получаем id и присваеваем роль
        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole("user"), $id);

        $this->redirect(Url::home(), 302);
        \Yii::$app->getSession()->setFlash('error', 'Аккаунт активирован');
    }

    public function actionChooseRole()
    {
        $this->layout = "@current_template/layouts/user";
        $this->userService->action(
            $this->prepareConfig(['action' => UserService::ACTION_CHOOSE_ROLE])
        );
        return $this->render('choose-role');
    }
}
