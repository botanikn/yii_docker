<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = 'Catalog';

?>
<div class="category-readall-header">
    <h1>Catalog</h1>
    <?= Yii::$app->user->identity->roleID == 1 ? Html::a('New good', ['good/create'], ['class' => ['profile-link', 'index-a', 'small-buttons']]) : '' ?>
</div>

<div class="readll-grid">

    <?php /** @var $allGoods */
    foreach ($allGoods as $good): ?>
        <div class="category-one">
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'ID -' . $good['id'] : ''  ?> </span><br>
            <span class="category-create-span"> Name - <?= $good['name'] ?> </span><br>
            <span class="category-create-span"> Description - <?= $good['description'] ?> </span><br>
            <span class="category-create-span"> Price - <?= $good['price'] ?> $</span><br>
            <span class="category-create-span"> Category - <?= $good['category'] ?> </span><br>
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'createTime - ' . $good['createTime'] : '' ?> </span><br>
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'updateTime - ' . $good['updateTime'] : '' ?> </span><br>

            <?= Yii::$app->user->identity->roleID == 1 ?
                Html::a(
                    '<span class="change-buttons">Изменить</span>',
                    Url::to(['good/readone', 'id' => $good['id']]),
                    ['class' => 'change-buttons']
                ) : ''
            ?><br>
            <?= Yii::$app->user->identity->roleID == 1 ?
                Html::a(
                '<span class="change-buttons">Удалить</span>',
                    Url::to(['good/deleteone', 'id' => $good['id']]),
                    ['class' => 'change-buttons']
            ) : ''
            ?>

            <?php $cart = $good;
            $found = false;

            ?>

            <?php /** @var  $allItemsInCarts */

            foreach ($allItemsInCarts as $item): ?>

                    <?php if ($good['id'] == $item['goodID'] && $item['userID'] == Yii::$app->user->getId()) { $found = true; $cart = $item; } ?>

            <?php endforeach;?>
            <?php if ($found === true && Yii::$app->user->identity->roleID == 2) {?>
                <div class="increment-decrement">
                    <?= Html::a(
                        '<span class="change-buttons">-</span>',
                        Url::to(['cart/decrement', 'id' => $cart['id'], 'path' => 'good/readall']),
                        ['class' => 'change-buttons']
                    )
                    ?>
                    <div class="div"><?= $cart['quantity'] ?> </div>
                    <?= Html::a(
                        '<span class="change-buttons">+</span>',
                        Url::to(['cart/increment', 'id' => $cart['id'], 'path' => 'good/readall']),
                        ['class' => 'change-buttons']
                    )
                    ?>
                </div>
            <?php } else {?>
                <?= Yii::$app->user->identity->roleID == 2 ? Html::a(
                    '<span class="change-buttons">Добавить в корзину</span>',
                    Url::to(['cart/add', 'id' => $good['id'], 'path' => 'good/readall']),
                    ['class' => 'change-buttons']
                ) : ''
                ?>
            <?php }?>
        </div>
    <?php endforeach;?>
</div>