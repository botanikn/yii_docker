<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div>
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'email')->passwordInput() ?>

    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>
</div>