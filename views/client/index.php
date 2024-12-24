<?php

    use yii\helpers\Html;

?>
<div class="cl-div-index-a">
    <?= Html::a('Catalog', ['good/readall'], ['class' => ['profile-link', 'cl-index-a']]); ?>
    <?= Html::a('My Cart', ['cart/index'], ['class' => ['profile-link', 'cl-index-a']]); ?>
    <?= Html::a('My Orders', ['order/readfew'], ['class' => ['profile-link', 'cl-index-a']]); ?>
</div>