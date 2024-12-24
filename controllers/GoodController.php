<?php

namespace app\controllers;
use app\models\CartActiveRecord;
use app\models\CategoryActiveRecord;
use app\models\GoodActiveRecord;
use app\models\GoodForm;
use app\services\GoodService;
use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

class GoodController extends UserController {

    protected $goodModel;
    protected $goodForm;
    protected $categoryModel;
    protected $cartModel;
    protected $query;
    protected $goodService;

    public function init()
    {
        parent::init();
        $this->goodModel = new GoodActiveRecord();
        $this->goodForm = new GoodForm();
        $this->categoryModel = new CategoryActiveRecord();
        $this->cartModel = new CartActiveRecord();
        $this->query = new Query();

        $this->goodService = new GoodService();
    }

    public function actionReadall() {

        // Вызов сервиса по поиску всех категорий товаров
        $allGoodsWithCategories = $this->goodService->getCategories($this->query);

        if (Yii::$app->request->isPost) {
            // Все товары в корзине текущего пользователя
            $query = $this->cartModel::find()
                ->where([
                    'userID' => Yii::$app->user->id
                ])
                ->all();

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
                $this->cartModel->goodID = Yii::$app->request->post('id');
                $this->cartModel->userID = Yii::$app->user->id;
                $this->cartModel->quantity = 1;
                $this->cartModel->createTime = date('Y-m-d H:i:s', time());
                $this->cartModel->updateTime = date('Y-m-d H:i:s', time());
                $this->cartModel->save();
            }

        }

        return $this->render('readall', ['allGoods' => $allGoodsWithCategories]);
    }

    public function actionCreate() {
        $this->actionAppropUser(1);
        $model = $this->goodForm;

        // Если в модель были загружены и провалидированы данные, они вносятся в activeRecord, затем сохраняются
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // Вызов сервиса, который создаёт новый товар
            $good = $this->goodService->createGoods($model, $this->goodModel);

            if($good->save()) {
                $this->redirect(['good/readall']);
            }
        }

        $categories = $this->categoryModel->find()->all();
        $items = ArrayHelper::map($categories, 'id', 'name');

        return $this->render("create", ["model" => $model, "items" => $items]);
    }

}