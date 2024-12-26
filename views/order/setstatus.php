<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$data = [
    'received',
    'assembling',
    'delivering',
    'awaiting in pick-up point'
]

?>

<h1>Заказ <?= $name ?></h1>


<?php $form = ActiveForm::begin(); ?>

    <?= $form ->field($orderF, 'status')->dropDownList($data); ?>

    <?= Html::submitButton('Set Status', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>
