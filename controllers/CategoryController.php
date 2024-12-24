<?php

namespace app\controllers;

use app\models\CategoryActiveRecord;
use app\models\CategoryForm;
use app\services\CategoryService;
use Yii;

class CategoryController extends UserController {

    protected $categoryModel;
    protected $categoryForm;
    protected $categoryService;

    public function init()
    {
        parent::init();
        // Создаем экземпляр CategoryActiveRecord и помещаем его в свойство
        $this->categoryModel = new CategoryActiveRecord();
        $this->categoryForm = new CategoryForm();
        $this->categoryService = new CategoryService();
    }

    public function actionReadall() {

        $this->actionAppropUser(1);
        $allCategory = $this->categoryModel->find()->all();

        return $this->render('readall', ['allCategory' => $allCategory]);
    }

    public function actionCreate() {

        $this->actionAppropUser(1);

        $model = $this->categoryForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $category = $this->categoryService->createCategory($model, $this->categoryModel);

            if($category) {
                $this->redirect(['category/readall']);
            }
        }

        return $this->render("create", ["model" => $model]);

    }

}