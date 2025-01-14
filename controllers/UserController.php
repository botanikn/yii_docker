<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use Yii;

class UserController extends Controller {

    public function actionAppropUser($roleID) {
        if (\Yii::$app->user->identity->roleID != $roleID) {
            return $this->goHome();
        }
    }

    public function actionSendEmail() {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return;
        }
        return $this->render('sendEmail', [
            'model' => $model
        ]);
    }

    public function actionResetPassword() {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            return;

        }
        return $this->render('resetPassword', [
            'model' => $model
        ]);
    }

}