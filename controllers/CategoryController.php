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

    public function actionReadone($id) {
        $this->actionAppropUser(1);
        $category = $this->categoryModel->findOne($id);

        $modelCat = $this->categoryForm;

        $modelCat->setAttributes($category->getAttributes());

        if ($modelCat->load(Yii::$app->request->post()) && $modelCat->validate()) {

            $category->name = $modelCat->name;
            $category->description = $modelCat->description;
            $category->updateTime = date('Y-m-d H:i:s', time());

            if ($category->save()) {
                $this->redirect(['category/readall']);
            }

        }

        return $this->render('readone', ['category' => $category, 'model' => $modelCat]);
    }

    public function actionDeleteone($id) {
        $this->actionAppropUser(1);
        $category = $this->categoryModel->findOne($id);
        if ($category->delete()) {
            $this->redirect(['category/readall']);
        }
    }

}