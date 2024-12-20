<?php

namespace app\controllers;

use app\models\CategoryActiveRecord;
use app\models\CategoryForm;
use Yii;

class CategoryController extends UserController {

    public function actionCreate() {

        $this->actionAppropUser(1);

        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category = new CategoryActiveRecord();
            $category->name = $model->name;
            $category->description = $model->description;
            $category->createTime = date('Y-m-d H:i:s', time());
            $category->updateTime = date('Y-m-d H:i:s', time());

            if($category->save()) {
                $this->goBack();
            }
        }

        return $this->render("create", ["model" => $model]);

    }

}