<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\User;
use Yii;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use \yii\symfonymailer\Mailer;
use \yii\symfonymailer\Message;

class UserController extends Controller {

    private $passwordResetRequestForm;
    private $resetPasswordForm;

    public function init() {
        parent::init();
        $this->passwordResetRequestForm = new PasswordResetRequestForm();
        $this->resetPasswordForm = new ResetPasswordForm();
    }

    public function actionAppropUser($roleID) {
        if (\Yii::$app->user->identity->roleID != $roleID) {
            return $this->goHome();
        }
    }

    public function actionPasswordReset() {
        $requestModel = $this->passwordResetRequestForm;

        if ($requestModel->load(Yii::$app->request->post()) && $requestModel->validate()) {
            $user = User::findOne(['email' => $requestModel->email]);

            if ($user) {
                $user->generatePasswordResetToken();
                $user->save();

                $resetUrl = Url::to(['user/reset-password', 'token' => urlencode($user->password_reset_token)], true);
                try {
                    Yii::$app->mailer->compose()
                        ->setFrom('german_string@pet.com')
                        ->setTo('horizon_dawn@pet.com')
                        ->setSubject('Восстановление пароля')
                        ->setHtmlBody(Html::a('Сбросить пароль', $resetUrl))
                        ->send();

                    Yii::$app->session->setFlash('success', 'Письмо было отправлено на почту ' . $requestModel->email);
                    return $this->redirect(['site/login']);
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', 'Ошибка при отправке письма: ' . $e->getMessage());
                    return $this->redirect(['user/request-password-reset']);
                }
            }
        }
        return $this->render('requestPasswordReset', ['model' => $requestModel]);
    }

    public function actionResetPassword($token) {
        $user = User::findOne(['password_reset_token' => $token]);
        $model = $this->resetPasswordForm;

        if ($user) {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($model->password);
                $user->password_reset_token = null;
                $user->save();
                return $this->redirect(['site/login']);
            }

            return $this->render('resetPassword', ['model' => $model]);
        }
    }

}