<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'My Cart';

?>

<div class="readll-grid">
    <?php
        $isEmpty = false;
        $total = 0;
        $arr = '';
    ?>
    <?php foreach ($cart as $item) {?>
        <div class="category-one">
            <?php
                $total += $item['price']*$item['quantity'];
                $arr = $arr . ',' . $item['id'];
            ?>
            <span class="category-create-span"> Name - <?= $item['name'] ?> </span>
            <span class="category-create-span"> Description - <?= $item['description'] ?> </span>
            <span class="category-create-span"> Price - <?= $item['price'] ?>$ </span><br>

            <div class="increment-decrement">
                <?= Html::a(
                        '<span class="change-buttons">-</span>',
                        Url::to(['cart/decrement', 'id' => $item['cart_id'], 'path' => 'cart/index']),
                        ['class' => 'change-buttons']
                    )
                ?>
                <div class="div"><?= $item['quantity'] ?> </div>
                <?= Html::a(
                    '<span class="change-buttons">+</span>',
                    Url::to(['cart/increment', 'id' => $item['cart_id'], 'path' => 'cart/index']),
                    ['class' => 'change-buttons']
                )
                ?>
            </div>
        </div>
        <?php $isEmpty = true ?>
    <?php }?>
    <?php if (!$isEmpty) { ?>
        <h1>Ваша корзина пуста</h1>
        <?= Html::a('Выберите себе что-нибудь', ['good/readall'], ['class' => ['cl-index-a']])?>
    <?php }?>
</div>
<div class="total">
    Всего - <?= $total?>$

    <?=
    Html::a(
        '<span>Оформить заказ</span>',
        ['order/create', 'goodIDs' => mb_substr($arr, 1)],
        ['class' => 'make-order'])
    ?>
</div>
