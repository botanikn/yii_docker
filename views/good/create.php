<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <h1>New Good</h1>

    <?= $form ->field($model, 'name') ?>
    <?= $form ->field($model, 'description') ?>
    <?= $form ->field($model, 'price') ?>
    <?= $form->field($model, 'categoryID')->dropDownList($items, ['prompt' => 'Выберите категорию']) ?>

    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>
