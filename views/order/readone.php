<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $name */
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['/order/readfew']];
$this->params['breadcrumbs'][] = 'Order ' . $name;

?>

<h1>Order <?= $name ?></h1>

<div class="readll-grid">
    <?php /** @var $gio */
    foreach ($gio as $good) {?>
        <div class="category-one">
            <span class="category-create-span"> Name - <?= $good['good_name'] ?> </span>
            <span class="category-create-span"> Description - <?= $good['description'] ?> </span>
            <span class="category-create-span"> Quantity - <?= $good['quantity'] ?> </span>
            <span class="category-create-span"> Price - <?= $good['price'] ?>$ </span><br>
        </div>
    <?php }?>
</div>
