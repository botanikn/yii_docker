<?php

namespace app\controllers;

class AdminController extends UserController {

    public function actionIndex() {

        $this->actionAppropUser(1);
        return $this->render('index');
    }

}