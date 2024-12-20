<?php

namespace app\controllers;

use app\models\CategoryActiveRecord;
use app\models\CategoryForm;
use Yii;

class CategoryController extends UserController {

    protected $categoryModel;

    public function init()
    {
        parent::init();
        // Создаем экземпляр CategoryActiveRecord и помещаем его в свойство
        $this->categoryModel = new CategoryActiveRecord();
    }

    public function actionReadall() {
        $allCategory = $this->categoryModel->find()->all();

        return $this->render('readall', ['allCategory' => $allCategory]);
    }

    public function actionCreate() {

        $this->actionAppropUser(1);

        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $this->categoryModel->name = $model->name;
            $this->categoryModel->description = $model->description;
            $this->categoryModel->createTime = date('Y-m-d H:i:s', time());
            $this->categoryModel->updateTime = date('Y-m-d H:i:s', time());

            if($this->categoryModel->save()) {
                $this->redirect(['category/readall']);
            }
        }

        return $this->render("create", ["model" => $model]);

    }

}