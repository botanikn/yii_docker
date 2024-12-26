<?php

namespace app\services;
use Yii;
use yii\db\Query;

class CartService {

    public function addItemInCart($id, $cartModel) {

        $cartModel->goodID = $id;
        $cartModel->userID = Yii::$app->user->id;
        $cartModel->quantity = 1;
        $cartModel->createTime = date('Y-m-d H:i:s', time());
        $cartModel->updateTime = date('Y-m-d H:i:s', time());
        $cartModel->save();

    }

    public function findClientCart($query) {
        $result = $query::find()
            ->where([
                'userID' => Yii::$app->user->id
            ])
            ->all();

        return $result;
    }

    public function findGoodsInCart() {

        $result = new Query();

        $allGoodsInCart = $result
            ->select(['goodscatalog.*', 'cartitems.quantity as quantity', 'cartitems.id AS cart_id'])
            ->from('cartitems')
            ->innerJoin('goodscatalog', 'goodscatalog.id = "goodID"')
            ->where('"userID" = ' . Yii::$app->user->getId())
            ->orderBy(['name' => SORT_ASC])
            ->all();

        return $allGoodsInCart;

    }

    public function removeItemsInCart($cartModel) {
        $cartModel::deleteAll(['userID' => Yii::$app->user->id]);
    }

}