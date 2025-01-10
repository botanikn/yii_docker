<?php

namespace app\controllers;

use yii\web\ForbiddenHttpException;

class AdminController extends UserController {

    public function actionIndex() {

        $this->actionAppropUser(1);
        return $this->render('index');
    }

}