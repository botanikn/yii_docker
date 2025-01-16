<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\mail\BaseMailer;

class UserController extends Controller {

    private PasswordResetRequestForm $passwordResetRequestForm;
    private ResetPasswordForm $resetPasswordForm;

    public function __construct(
        PasswordResetRequestForm $passwordResetRequestForm,
        ResetPasswordForm $resetPasswordForm
    ) {
        $this->passwordResetRequestForm = $passwordResetRequestForm;
        $this->resetPasswordForm = $resetPasswordForm;
    }

    public function actionAppropUser($roleID) {
        if (\Yii::$app->user->identity->roleID != $roleID) {
            return $this->goHome();
        }
    }

    public function actionPasswordReset() {
        $requestModel = $this->passwordResetRequestForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne(['email' => $model->email]);

            if ($user) {
                $user->generatePasswordResetToken();
                $user->save();

                $resetUrl = Url::to(['user/reset-password', 'token' => $user->password_reset_token], true);
                Yii::$app->mailer->compose()
                ->setFrom('german_string@mail.ru')
                ->setTo($model->email)
                ->setSubject('Восстановление пароля')
                ->setHtmlBody(Html::a('Сбросить пароль', $resetUrl))
                ->send();
            }
        }
        return $this->render('requestPasswordReset', ['model' => $model]);
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