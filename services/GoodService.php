<?php

namespace app\services;

class GoodService
{
    public function getCategories($query) {

        $allGoodsWithCategories = $query
            ->select(['goodscatalog.*', 'categories.name AS category'])
            ->from('goodscatalog')
            ->innerJoin('categories', '"categoryID" = categories.id')
            ->all();

        return $allGoodsWithCategories;
    }

    public function createGoods($model, $activeForm) {

        $activeForm->name = $model->name;
        $activeForm->description = $model->description;
        $activeForm->price = $model->price;
        $activeForm->categoryID = $model->categoryID;
        $activeForm->createTime = date('Y-m-d H:i:s', time());
        $activeForm->updateTime = date('Y-m-d H:i:s', time());

        if($activeForm->save()) {
            return $activeForm;
        }
        else return null;
    }

}