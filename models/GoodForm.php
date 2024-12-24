<?php

namespace app\models;

use yii\base\Model;

class GoodForm extends Model {

    public $id;
    public $name;
    public $description;
    public $price;
    public $categoryID;
    public $createTime;
    public $updateTime;

    public function rules() {
        return [
            [['name', 'description', 'price', 'categoryID'], 'required'],
            ['price', 'number'],
            [['id', 'createTime', 'updateTime'], 'safe'],
        ];
    }

}