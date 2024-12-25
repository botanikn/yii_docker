<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderActiveRecord extends ActiveRecord{

    public static function tableName(){
        return '{{%orders}}';
    }

}