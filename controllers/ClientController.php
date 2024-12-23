<?php

namespace app\controllers;

class ClientController extends UserController {

    public function actionIndex() {
        $this->actionAppropUser(2);
        return $this->render('index');
    }

}