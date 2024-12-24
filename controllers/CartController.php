<?php

namespace app\controllers;

use app\models\CartActiveRecord;
use app\models\GoodActiveRecord;
use Yii;
use yii\db\Query;

class CartController extends UserController {

    protected $cartModel;
    protected $goodModel;
    protected $query;

    public function init() {
        parent::init();
        $this->cartModel = new CartActiveRecord();
        $this->goodModel = new GoodActiveRecord();
        $this->query = new Query();
    }

    public function actionIndex() {
        $this->actionAppropUser(2);
        $allGoodsInCart = $this->query
            ->select(['goodscatalog.*', 'cartitems.quantity as quantity'])
            ->from('cartitems')
            ->innerJoin('goodscatalog', 'goodscatalog.id = "goodID"')
            ->where('"userID" = ' . Yii::$app->user->getId())
            ->all();

        return $this->render('index', ['cart' => $allGoodsInCart]);
    }

}