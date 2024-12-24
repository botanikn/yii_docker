<?php

namespace app\models;

use yii\db\ActiveRecord;

class CartActiveRecord extends ActiveRecord {

    public static function tableName() {
        return '{{%cartitems}}';
    }

}