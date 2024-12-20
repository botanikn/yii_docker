<?php

namespace app\controllers;
use app\models\GoodActiveRecord;

class GoodController extends UserController {

    protected $goodModel;

    public function init()
    {
        parent::init();
        // Создаем экземпляр CategoryActiveRecord и помещаем его в свойство
        $this->goodModel = new GoodActiveRecord();
    }

    public function actionReadall() {
        $this->actionAppropUser(1);
        $allGoods = $this->goodModel->find()->all();

        return $this->render('readall', ['allGoods' => $allGoods]);
    }

}