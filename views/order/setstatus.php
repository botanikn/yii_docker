<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$data = [
    'received' => 'received',
    'assembling' => 'assembling',
    'delivering' => 'delivering',
    'awaiting in pick-up point' => 'awaiting in pick-up point'
];

/** @var $orderF */
/** @var $status */
/** @var $name */
$orderF->status = $status;

$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['/order/readfew']];
$this->params['breadcrumbs'][] = 'Order ' . $name . ' status';



?>

<h1>Заказ <?= $name ?></h1>


<?php $form = ActiveForm::begin(); ?>

    <?= $form ->field($orderF, 'status')->dropDownList($data); ?>

    <?= Html::submitButton('Set Status', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end(); ?>
