<?php

namespace app\controllers;
use app\models\GoodActiveRecord;

class GoodController extends UserController {

    protected $goodModel;

    public function init()
    {
        parent::init();
        $this->goodModel = new GoodActiveRecord();
    }

    public function actionReadall() {
        $this->actionAppropUser(1);
        $allGoods = $this->goodModel->find()->all();

        return $this->render('readall', ['allGoods' => $allGoods]);
    }

    public function actionCreate() {
        $this->actionAppropUser(1);
    }

}