<?php

namespace app\models;

use yii\base\Model;

class CategoryForm extends Model {

    public $id;
    public $name;
    public $description;
    public $createTime;
    public $updateTime;

    public function rules() {
        return [

            [["name", "description"], 'required'],
            [["id", "name", "description", "createTime", "updateTime"], 'safe'],

        ];
    }

}