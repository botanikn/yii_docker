<?php

namespace app\controllers;

use app\models\CartActiveRecord;
use app\models\GoodInOrderActiveRecord;
use app\models\OrderActiveRecord;
use app\models\OrderForm;
use app\services\CartService;
use app\services\OrderService;
use Yii;
use yii\db\Query;

class OrderController extends UserController {

    protected $orderModel;
    protected $cartModel;
    protected $cartService;
    protected $goodInOrderModel;
    protected $orderService;
    protected $query;
    protected $orderForm;

    public function init()
    {
        parent::init();
        // Создаем экземпляр CategoryActiveRecord и помещаем его в свойство
        $this->orderModel = new OrderActiveRecord();
        $this->cartModel = new CartActiveRecord();
        $this->cartService = new CartService();
        $this->goodInOrderModel = new GoodInOrderActiveRecord();
        $this->orderService = new OrderService();
        $this->query = new Query();
        $this->orderForm = new OrderForm();
    }

    public function actionCreate($goodIDs, $quantities, $t_price) {

        // Создание рандомного названия для заказа
        $characters = '0123456789';
        $order_random = $this->orderService->createRandom($characters);

        // Создание заказа
        $newOrder = $this->orderService->createOrder($order_random, $this->orderModel, $t_price);

        // Превращаем строки с id и количеством товаров в массивы
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
            Yii::$app->session->setFlash('success', 'Заказ с номером ' . $order_random . ' создан');
        }

    }

    public function actionReadfew() {

        if (Yii::$app->user->identity->roleID == 1) {
            $orders = $this->orderModel::find()
                ->orderBy(['id' => SORT_ASC])
                ->all();
        } else {
            $orders = $this->orderModel::find()
                ->where(['customerID' => Yii::$app->user->identity->id])
                ->orderBy(['id' => SORT_ASC])
                ->all();
        }

        return $this->render('readfew', ['orders' => $orders]);
    }

    public function actionReadone($id, $name) {
        $gio = $this->orderService->getGoodsInOrder($id, $this->query);
        return $this->render('readone', ['gio' => $gio, 'name' => $name]);
    }

    public function actionSetstatus($id) {

        $order = $this->orderModel::findOne($id);
        $form = new OrderForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $order->status = Yii::$app->request->post()['OrderForm']['status'];
            $order->updateTime = date('Y-m-d H:i:s', time());

            if ($order->save()) {
                return $this->redirect(['order/readfew', 'id' => $order->id, 'name' => $order->name]);
                Yii::$app->session->setFlash('success', 'Статус заказа с номером ' . $order->name . ' был изменён на ' . $this->orderForm->status);
            }

        }

        return $this->render('setstatus', ['name' => $order['name'], 'orderF' => $form, 'status' => $order['status']]);

    }

}