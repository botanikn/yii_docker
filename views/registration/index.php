<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\controllers\RegistrationController;

?>
<?php $form = ActiveForm::begin(); ?>

    <h1>Registration</h1>
    <p>Please fill out the following fields to sign up:</p>

    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'firstName') ?>
    <?= $form->field($model, 'lastName') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone') ?>

    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>
