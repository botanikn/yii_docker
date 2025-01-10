<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SendEmailForm extends Model {
    public $email;

    public function rules() {
        return [
            ['email', 'filter', 'filter' => 'trim']
        ];
    }

    public function attributeLabels() {
        return [
            'email' => 'Email'
        ];
    }

    public function sendEmail() {

        $user = User::findOne(
            ['email' => $this->email]
        );

        if ($user) {
            $user->gererateSecretKey();
            if ($user->save()) {
                return Yii::$app->mailer->compose('resetPassword', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.'отправлено роботом'])
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля для ' .Yii::$app->name)
                    ->send();
            }
        }
        else return false;
    }
}

?>