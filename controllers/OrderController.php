<?php

namespace app\controllers;

use app\models\CartActiveRecord;
use app\models\GoodInOrderActiveRecord;
use app\models\OrderActiveRecord;
use app\services\CartService;
use app\services\OrderService;
use Yii;

class OrderController extends UserController {

    protected $orderModel;
    protected $cartModel;
    protected $cartService;
    protected $goodInOrderModel;
    protected $orderService;

    public function init()
    {
        parent::init();
        // Создаем экземпляр CategoryActiveRecord и помещаем его в свойство
        $this->orderModel = new OrderActiveRecord();
        $this->cartModel = new CartActiveRecord();
        $this->cartService = new CartService();
        $this->goodInOrderModel = new GoodInOrderActiveRecord();
        $this->orderService = new OrderService();
    }

    public function actionCreate($goodIDs, $quantities) {

        // Создание рандомного названия для заказа
        $characters = '0123456789';
        $random = $this->orderService->createRandom($characters);

        // Создание заказа
        $newOrder = $this->orderService->createOrder($random, $this->orderModel);

        // Превращаем строку с id товаров в массив
        $IDs = explode(',', $goodIDs);
        $Qs = explode(',', $quantities);

        if($newOrder) {

            for ($i = 0; $i < count($IDs); $i++) {

                $characters = '0123456789abcdefghij';
                $random = $this->orderService->createRandom($characters);

                $this->orderService->createGoodsInOrders($random, $IDs[$i], $newOrder, $Qs[$i]);
            }

            $this->cartService->removeItemsInCart($this->cartModel);
            $this->redirect(['order/readfew']);
            Yii::$app->session->setFlash('success', 'Заказ с номером ' . $random . ' создан');
        }

    }

    public function actionReadfew() {
        $orders = $this->orderModel::find()
            ->where(['customerID' => Yii::$app->user->identity->id])
            ->all();

        $this->render('readfew', ['orders' => $orders]);
    }

}