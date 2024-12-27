<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="div-index-a">
    <?= Html::a('Categories', ['category/readall'], ['class' => ['profile-link', 'index-a']]); ?>
    <?= Html::a('Goods in catalog', ['good/readall'], ['class' => ['profile-link', 'index-a']]); ?>
    <?= Html::a('View orders', ['order/readfew'], ['class' => ['profile-link', 'index-a']]); ?>
</div>
