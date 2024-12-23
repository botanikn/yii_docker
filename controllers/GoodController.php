<?php

namespace app\controllers;
use app\models\CategoryActiveRecord;
use app\models\GoodActiveRecord;
use app\models\GoodForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

class GoodController extends UserController {

    protected $goodModel;
    protected $goodForm;
    protected $categoryModel;

    public function init()
    {
        parent::init();
        $this->goodModel = new GoodActiveRecord();
        $this->goodForm = new GoodForm();
        $this->categoryModel = new CategoryActiveRecord();
    }

    public function actionReadall() {
        $this->actionAppropUser(1);

        $query = new Query();
        $allGoodsWithCategories = $query
            ->select(['goodscatalog.id', 'categories.name AS category'])
            ->from('goodscatalog')
            ->innerJoin('categories', '"categoryID" = categories.id')
            ->all();

        var_dump($allGoodsWithCategories);
        die();
//        $allGoods = $this->goodModel->find()->join('INNER JOIN', 'categories', 'categories.id = goodscatalog.categoryID')->all();

        return $this->render('readall', ['allGoods' => $allGoodsWithCategories]);
    }

    public function actionCreate() {
        $this->actionAppropUser(1);
        $model = $this->goodForm;

        // Если в модель были загружены и провалидированы данные, они вносятся в activeRecord, затем сохраняются
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->goodModel->name = $model->name;
            $this->goodModel->description = $model->description;
            $this->goodModel->price = $model->price;
            $this->goodModel->categoryID = $model->categoryID;
            $this->goodModel->createTime = date('Y-m-d H:i:s', time());
            $this->goodModel->updateTime = date('Y-m-d H:i:s', time());

            if($this->goodModel->save()) {
                $this->redirect(['good/readall']);
            }
        }

        $categories = $this->categoryModel->find()->all();
        $items = ArrayHelper::map($categories, 'id', 'name');

        return $this->render("create", ["model" => $model, "items" => $items]);
    }

}