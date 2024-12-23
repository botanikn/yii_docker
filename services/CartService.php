<?php

namespace app\services;
use Yii;

class CartService {

    public function addItemInCart($query, $cartForm) {
        $found = false;

        // Если id полученного товара уже имеется в корзине, добавляем к нему ещё один
        foreach ($query as $item) {
            if ($item->goodID == Yii::$app->request->post('id')) {
                $item->quantity += 1;
                $item->updateTime = date('Y-m-d H:i:s', time());
                $item->save();
                $found = true;
                break;
            }
        }

        // Если id товара не найден, то создаём новый
        if (!$found) {
            $cartForm->goodID = Yii::$app->request->post('id');
            $cartForm->userID = Yii::$app->user->id;
            $cartForm->quantity = 1;
            $cartForm->createTime = date('Y-m-d H:i:s', time());
            $cartForm->updateTime = date('Y-m-d H:i:s', time());
            $cartForm->save();
        }
    }

    public function findClientCart($query) {
        $result = $query::find()
            ->where([
                'userID' => Yii::$app->user->id
            ])
            ->all();

        return $result;
    }

    public function findGoodsInCart($query) {

        $allGoodsInCart = $query
            ->select(['goodscatalog.*', 'cartitems.quantity as quantity'])
            ->from('cartitems')
            ->innerJoin('goodscatalog', 'goodscatalog.id = "goodID"')
            ->where('"userID" = ' . Yii::$app->user->getId())
            ->all();

        return $allGoodsInCart;

    }

}