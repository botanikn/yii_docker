<?php

namespace app\controllers;
use app\models\CartActiveRecord;
use app\models\CategoryActiveRecord;
use app\models\GoodActiveRecord;
use app\models\GoodForm;
use app\services\CartService;
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
    protected $cartService;

    public function init()
    {
        parent::init();
        $this->goodModel = new GoodActiveRecord();
        $this->goodForm = new GoodForm();
        $this->categoryModel = new CategoryActiveRecord();
        $this->cartModel = new CartActiveRecord();

        $this->query = new Query();
        $this->goodService = new GoodService();
        $this->cartService = new CartService();
    }

    public function actionReadall() {

        // Вызов сервиса по поиску всех категорий товаров
        $allGoodsWithCategories = $this->goodService->getCategories($this->query);

        if (Yii::$app->request->isPost && Yii::$app->user->identity->roleID == 2) {

            // Все товары в корзине текущего пользователя
            $query = $this->cartService->findClientCart($this->cartModel);


            // Добавление товара в корзину
            $this->cartService->addItemInCart($query, $this->cartModel);

        }

        return $this->render('readall', ['allGoods' => $allGoodsWithCategories]);
    }

    public function actionReadone($id) {
        $this->actionAppropUser(1);

        // Нахожу необходимый товар
        $good = $this->goodService->getOneGood($this->query, $id);

        // Перевожу данные из запроса в форму
        $this->goodForm->attributes = $good;

        // Нахожу все категории
        $categories = $this->categoryModel->find()->all();
        $items = ArrayHelper::map($categories, 'id', 'name');

        // Если форма заполнена и провалидирована
        if ($this->goodForm->load(Yii::$app->request->post()) && $this->goodForm->validate()) {

            // Вызываем метод обновдения и передаём ему все параметры из формы
            $updatedGood = $this->goodService->updateOneGood($this->goodModel, $this->goodForm, $id);
            if ($updatedGood) {
                $this->redirect(['good/readall']);
            }
        }

        return $this->render('readone', ['good' => $this->goodForm, 'items' => $items]);
    }

    public function actionDeleteone($id) {

        $currentGood = $this->goodModel::findOne($id);
        try {
            if ($currentGood->delete()) {
                $this->redirect(['good/readall']);
                Yii::$app->session->setFlash('success', 'Запись успешно удалена.');
            }
        } catch (\yii\db\IntegrityException $e) {
            $this->redirect(['good/readall']);
            Yii::$app->session->setFlash('error', 'Ошибка: Невозможно удалить товар, так как он уже имеется в корзине пользователя.');
        }
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