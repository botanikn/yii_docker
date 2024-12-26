<?php

namespace app\services;
use app\models\GoodInOrderActiveRecord;
use Yii;

class OrderService {

    protected $giom;

    public function init()
    {

        $this->giom = new GoodInOrderActiveRecord();

    }

    public function createRandom($characters) {
        $random = '';
        for ($i = 0; $i < 10; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $random;
    }

    public function createOrder($order_random, $newOrder, $t_price) {

        $newOrder->name = $order_random;
        $newOrder->customerID = Yii::$app->user->identity->id;
        $newOrder->t_price = $t_price;
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

    public function getGoodsInOrder($id, $query) {

        $result = $query
        ->select(['goodscatalog.name AS good_name', 'goodscatalog.description', 'goodscatalog.price', 'goodsinorders.*'])
            ->from('goodsinorders')
            ->innerJoin('goodscatalog', 'goodsinorders."goodID" = goodscatalog."id"')
            ->where(['"orderID"' => $id])
            ->all();

        return $result;

    }

}