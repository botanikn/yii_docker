<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="div-index-a">
    <?= Html::a('Create category', ['category/create'], ['class' => ['profile-link', 'index-a']]); ?>
    <?= Html::a('Create good in catalog', ['good/create'], ['class' => ['profile-link', 'index-a']]); ?>
    <?= Html::a('View orders', ['order/read_all'], ['class' => ['profile-link', 'index-a']]); ?>
</div>
