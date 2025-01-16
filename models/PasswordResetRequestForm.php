<?php

namespace app\models;

use yii\base\Model;

class PasswordResetRequestModel extends Model {
    public $email;

    public function rules() {
        return [
            ['email', 'required'],
            ['email', 'email']
        ];
    }
}

?>