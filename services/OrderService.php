<?php

namespace app\services;
use app\models\GoodInOrderActiveRecord;
use Yii;

class OrderService {

    public function createRandom($characters) {
        $random = '';
        for ($i = 0; $i < 10; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $random;
    }

    public function createOrder($random, $newOrder) {

        $newOrder->name = $random;
        $newOrder->customerID = Yii::$app->user->identity->id;
        $newOrder->createTime = date('Y-m-d H:i:s', time());
        $newOrder->updateTime = date('Y-m-d H:i:s', time());

        if ($newOrder->save()) {
            return $newOrder;
        }
        else return null;
    }

    public function createGoodsInOrders($random, $goodID, $newOrder, $quantity) {
        $giom = new GoodInOrderActiveRecord();
        $giom->name = $random;
        $giom->goodID = $goodID;
        $giom->orderID = $newOrder->id;
        $giom->quantity = $quantity;
        $giom->createTime = date('Y-m-d H:i:s', time());
        $giom->updateTime = date('Y-m-d H:i:s', time());

        $giom->save();
    }

}