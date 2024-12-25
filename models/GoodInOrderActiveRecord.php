<?php

namespace app\models;

use yii\db\ActiveRecord;

class GoodInOrderActiveRecord extends ActiveRecord{

    public static function tableName(){
        return '{{%goodsinorders}}';
    }

}