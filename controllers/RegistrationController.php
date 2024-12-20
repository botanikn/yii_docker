<?php

namespace app\controllers;
use \yii\web\Controller;
use Yii;
use app\models\RegistrationForm;
use app\models\User;

class RegistrationController extends Controller
{

    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->login = $model->login;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $user->firstName = $model->firstName;
            $user->lastName = $model->lastName;
            $user->email = $model->email;
            $user->phone = $model->phone;
            $user->roleID = 1;
            $user->createTime = date('Y-m-d H:i:s', time());
            $user->updateTime = date('Y-m-d H:i:s', time());

            if ($user->save()) {
                Yii::$app->user->login($user, 3600 * 24 * 30);
                return $this->goHome();
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}