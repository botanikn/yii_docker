<?php

namespace app\models;

use yii\base\Model;

class CategoryForm extends Model {

    public $name;
    public $description;

    public function rules() {
        return [

            [["name", "description"], 'required'],

        ];
    }

}