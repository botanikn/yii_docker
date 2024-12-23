<?php

namespace app\controllers;

class ClientController extends UserController {

    public function actionIndex() {
        return $this->render('index');
    }

}