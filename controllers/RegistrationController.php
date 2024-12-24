<?php

namespace app\controllers;
use app\services\UserService;
use \yii\web\Controller;
use Yii;
use app\models\RegistrationForm;
use app\models\User;

class RegistrationController extends Controller
{

    protected $userService;
    protected $user;
    protected $registrationForm;

    public function init()
    {
        parent::init();
        $this->userService = new UserService();
        $this->user = new User();
        $this->registrationForm = new RegistrationForm();
    }

    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->roleID == 1) {
                return $this->redirect('?r=admin/index');
            }
            else if (Yii::$app->user->identity->roleID == 2) {
                return $this->redirect('?r=client/index');
            }
        }
        $model = $this->registrationForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $user = $this->userService->registerUser($model, $this->user);

            if ($user) {
                Yii::$app->user->login($user, 3600 * 24 * 30);
                return $this->goHome();
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}