<?php

namespace app\models;

use yii\db\ActiveRecord;

class GoodActiveRecord extends ActiveRecord {

    public static function tableName() {
        return '{{%goodscatalog}}';
    }

}