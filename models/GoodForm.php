<?php

namespace app\models;

use yii\base\Model;

class GoodForm extends Model {

    public $name;
    public $description;
    public $price;
    public $categoryID;

    public function rules() {
        return [
            [['name', 'description', 'price', 'categoryID'], 'required'],
            ['price', 'number'],
        ];
    }

}