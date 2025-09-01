<?php

namespace app\models;
use yii\base\Model;

class RegistrationForm extends Model {

    public $login;
    public $password;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    // Валидация параметров с формы
    public function rules() {
        return [
            [['login', 'password', 'firstName', 'lastName', 'email', 'phone'], 'required'],
            ['email', 'email'],
            ['login', 'unique', 'targetClass' => User::class, 'message' => 'Этот логин уже занят.'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот email уже занят.'],
            ['phone', 'unique', 'targetClass' => User::class, 'message' => 'Этот номер телефона уже занят.'],
            ['password', 'string', 'min' => 10]
        ];
    }

}