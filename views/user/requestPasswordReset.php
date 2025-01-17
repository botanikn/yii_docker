<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <h1>Resetting the password</h1>
    <p>Please enter your email</p>

    <?= $form->field($model, 'email') ?>

    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>