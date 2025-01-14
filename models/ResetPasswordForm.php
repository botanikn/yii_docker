<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ResetPasswordModel extends Model {
    public $password;
    private $_user;

    public function rules() {
        return [
            ['password', 'required']
        ];
    }

    public function attributeLabel() {
        return [
            'password' => 'Пароль'
        ];
    }

    public function resetPassword() {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecretKey();
        return $user->save();
    }
}

?>