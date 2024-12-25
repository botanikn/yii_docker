<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'My Cart';

?>

<div class="readll-grid">
    <?php $isEmpty = false ?>
    <?php foreach ($cart as $item) {?>
        <div class="category-one">
            <span class="category-create-span"> Name - <?= $item['name'] ?> </span>
            <span class="category-create-span"> Description - <?= $item['description'] ?> </span>

            <div class="increment-decrement">
                <?= Html::a(
                        '<span class="change-buttons">-</span>',
                        Url::to(['cart/decrement', 'id' => $item['cart_id'], 'path' => 'cart/index']),
                        ['class' => 'change-buttons']
                    )
                ?>
                <span class="category-create-span"><?= $item['quantity'] ?> </span>
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
