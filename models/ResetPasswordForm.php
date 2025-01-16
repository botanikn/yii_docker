<?php

namespace app\models;

use yii\base\Model;

class ResetPasswordForm extends Model {
    public $password;
    public $confirm_password;

    public function rules() {
        return [
            [['password', 'confirm_password'], 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password']
        ];
    }
}

?>