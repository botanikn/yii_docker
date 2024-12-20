<?php

namespace app\controllers;

use yii\web\Controller;

class AdminController extends Controller {

    public function actionIndex() {
        if (\Yii::$app->user->identity->roleID != 1) {
            return $this->goHome();
        }
        return $this->render('index');
    }

}