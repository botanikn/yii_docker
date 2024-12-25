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

    public function actionCreate($goodIDs) {

        $characters = '0123456789';
        $random = $this->orderService->createRandom($characters);

        $newOrder = $this->orderModel;

        $newOrder->name = $random;
        $newOrder->customerID = Yii::$app->user->identity->id;
        $newOrder->createTime = date('Y-m-d H:i:s', time());
        $newOrder->updateTime = date('Y-m-d H:i:s', time());

        $IDs = explode(',', $goodIDs);

        if($newOrder->save()) {

            foreach ($IDs as $goodID) {

                $characters = '0123456789abcdefghij';
                $random = $this->orderService->createRandom($characters);

                $this->goodInOrderModel->name = $random;
                $this->goodInOrderModel->goodID = $goodID;
                $this->goodInOrderModel->orderID = $newOrder->id;
                $this->goodInOrderModel->createTime = date('Y-m-d H:i:s', 124235425);
                $this->goodInOrderModel->updateTime = date('Y-m-d H:i:s', time());

                $this->goodInOrderModel->save();
            }

            $this->cartService->removeItemsInCart();
            $this->redirect(['order/readfew']);
            Yii::$app->session->setFlash('success', 'Заказ с номером ' . $random . ' создан');
        }

    }

    public function actionReadfew() {
        $orders = $this->orderModel::find()
            ->where(['customerID' => Yii::$app->user->identity->id])
            -all();

        $this->render('readfew', ['orders' => $orders]);
    }

}