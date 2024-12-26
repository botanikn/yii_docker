<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $name */
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['/order/readfew']];
$this->params['breadcrumbs'][] = 'Order ' . $name;

?>

<div class="title">
    <h1>Order <?= $name ?></h1>
</div>

<div class="readll-grid">
    <?php /** @var $gio */
    foreach ($gio as $good) {?>
        <div class="category-one">
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> ID - <?= $good['id'] ?> </span>
            <?php }?>
            <span class="category-create-span"> Name - <?= $good['good_name'] ?> </span>
            <span class="category-create-span"> Description - <?= $good['description'] ?> </span>
            <span class="category-create-span"> Quantity - <?= $good['quantity'] ?> </span>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Create Time - <?= $good['createTime'] ?> </span>
            <?php }?>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Update Time - <?= $good['updateTime'] ?> </span>
            <?php }?><br>
            <span class="category-create-span"> Price - <?= $good['price'] ?>$ </span><br>
        </div>
    <?php }?>
</div>
