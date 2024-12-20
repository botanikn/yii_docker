<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <h1>New Category</h1>

    <?= $form ->field($model, 'name') ?>
    <?= $form ->field($model, 'description') ?>

    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>
