<?php

namespace app\controllers;

use app\models\CartActiveRecord;
use app\models\GoodActiveRecord;
use app\services\CartService;
use Yii;
use yii\db\Query;

class CartController extends UserController {

    protected $cartModel;
    protected $goodModel;
    protected $query;
    protected $cartService;

    public function init() {
        parent::init();
        $this->cartModel = new CartActiveRecord();
        $this->goodModel = new GoodActiveRecord();
        $this->query = new Query();
        $this->cartService = new CartService();
    }

    public function actionIndex() {
        $this->actionAppropUser(2);

        $allGoodsInCart = $this->cartService->findGoodsInCart($this->query);

        return $this->render('index', ['cart' => $allGoodsInCart]);
    }

}