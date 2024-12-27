<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Progress;

$this->params['breadcrumbs'][] = 'Orders';

?>

<div class="readll-grid">
    <?php /** @var $orders */
    foreach ($orders as $order) {?>
        <?php
        $percent = ($order['status'] == 'received') ? 20 :
            (($order['status'] == 'assembling') ? 40 :
                (($order['status'] == 'delivering') ? 70 : 100));
        ?>
        <div class="category-one">
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> ID - <?= $order['id'] ?> </span>
            <?php }?>
            <span class="category-create-span"> Name - <?= $order['name'] ?> </span>
            <span class="category-create-span"> Total Price - <?= $order['t_price'] ?>$ </span><br>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Created at - <?= $order['createTime'] ?> </span>
            <?php }?>
            <?php if (Yii::$app->user->identity->id == 1) {?>
                <span class="category-create-span"> Updated at - <?= $order['updateTime'] ?> </span>
            <?php }?><br>
            <?= Html::a('View goods', ['order/readone', 'id' => $order['id'], 'name' => $order['name']], ['class' => ['profile-link', 'change-buttons']])?>

            <?= Yii::$app->user->identity->id == 1 ? Html::a('Set status', ['order/setstatus', 'id' => $order['id']], ['class' => ['profile-link', 'change-buttons']]) : ''?>
            <br><?= Progress::widget([
            'percent' => $percent,
                'label' => $order['status'],
            ]); ?>
        </div>
    <?php }?>
</div>


