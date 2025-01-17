<?php

namespace app\services;

class CategoryService {

    public static function createCategory($categoryForm, $categoryModel) {

        $categoryModel->name = $categoryForm->name;
        $categoryModel->description = $categoryForm->description;
        $categoryModel->updated_by = Yii::$app->identity->id;
        $categoryModel->createTime = date('Y-m-d H:i:s', time());
        $categoryModel->updateTime = date('Y-m-d H:i:s', time());

        if($categoryModel->save()) {
            return $categoryModel;
        }

    }

}