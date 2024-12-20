<?php

namespace app\controllers;
use yii\web\Controller;

class UserController extends Controller {

    public function actionAppropUser($roleID) {
        if (\Yii::$app->user->identity->roleID != $roleID) {
            return $this->goHome();
        }
    }

}