<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'Orders';

?>

<div class="readll-grid">
    <?php /** @var $orders */
    foreach ($orders as $order) {?>
        <div class="category-one">
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> ID - <?= $order['id'] ?> </span>
            <?php }?>
            <span class="category-create-span"> Name - <?= $order['name'] ?> </span>
            <span class="category-create-span"> Status - <?= $order['status'] ?> </span>
            <span class="category-create-span"> Total Price - <?= $order['t_price'] ?>$ </span><br>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Create Time - <?= $order['createTime'] ?> </span>
            <?php }?>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Update Time - <?= $order['updateTime'] ?> </span>
            <?php }?><br>
            <?= Html::a('View goods', ['order/readone', 'id' => $order['id'], 'name' => $order['name']])?>

            <?= Yii::$app->user->identity->id == 1 ? Html::a('Set status', ['order/setstatus', 'id' => $order['id']]) : ''?>
        </div>
    <?php }?>
</div>


