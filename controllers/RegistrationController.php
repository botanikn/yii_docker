<?php

namespace app\controllers;
use \yii\web\Controller;
use Yii;
use app\models\RegistrationForm;
use app\models\User;

class RegistrationController extends Controller
{

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
        }
        return $this->render('index', ['model' => $model]);
    }

}