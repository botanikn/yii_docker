<?php

namespace app\controllers;
use \yii\web\Controller;
use Yii;
use app\models\RegistrationForm;

class RegistrationController extends Controller
{

    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();
        return $this->render('index', ['model' => $model]);
    }

}