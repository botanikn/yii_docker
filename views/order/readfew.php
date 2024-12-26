<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'My Orders';

echo 'Hello';

?>

<div class="readll-grid">
    <?php /** @var $orders */
    foreach ($orders as $order) {?>
        <div class="category-one">
            <span class="category-create-span"> Name - <?= $order['name'] ?> </span>
            <span class="category-create-span"> Status - <?= $order['status'] ?> </span>
            <span class="category-create-span"> Total Price - <?= $order['t_price'] ?>$ </span><br>
            <?= Html::a('View goods', ['order/readone', 'id' => $order['id'], 'name' => $order['name']])?>
        </div>
    <?php }?>
</div>


