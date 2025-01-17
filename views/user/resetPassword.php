<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <h1>Password Reset</h1>
    <p>Enter new password</p>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'confirm_password')->passwordInput() ?>

    <?= Html::submitButton('Change password', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>