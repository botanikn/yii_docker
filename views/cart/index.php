<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = 'My Cart';

?>

<div class="readll-grid">
    <?php $isEmpty = false ?>
    <?php foreach ($cart as $item) {?>
        <div class="category-one">
            <span class="category-create-span"> Name - <?= $item['name'] ?> </span>
            <span class="category-create-span"> Description - <?= $item['description'] ?> </span>
            <span class="category-create-span"> Quantity - <?= $item['quantity'] ?> </span>
        </div>
        <?php $isEmpty = true ?>
    <?php }?>
    <?php if (!$isEmpty) { ?>

        <h1>Ваша корзина пуста</h1>
        <?= Html::a('Выберите себе что-нибудь', ['good/readall'], ['class' => ['cl-index-a']])?>

    <?php }?>
</div>
