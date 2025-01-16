<?php

namespace app\services;
use Yii;

class UserService {

    public static function registerUser($model, $user) {

        $user->login = $model->login;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
        $user->load($model);
        $user->firstName = $model->firstName;
        $user->lastName = $model->lastName;
        $user->email = $model->email;
        $user->phone = $model->phone;
        $user->roleID = 2;
        $user->createTime = date('Y-m-d H:i:s', time());
        $user->updateTime = date('Y-m-d H:i:s', time());

        if ($user->save()) {
            return $user;
        }
        else return null;

    }

}