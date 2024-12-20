<?php

namespace app\models;

use yii\db\ActiveRecord;

class CategoryActiveRecord extends ActiveRecord{
    public static function tableName() {
        return '{{%categories}}';
    }
}