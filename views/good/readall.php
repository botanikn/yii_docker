<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'Goods';

?>
<div class="good-readall-header">
    <h1>Categories</h1>
    <?= Html::a('New category', ['good/create'], ['class' => ['profile-link', 'index-a', 'small-buttons']]); ?>
</div>

<div class="readll-grid">
    <?php foreach ($allGoods as $good) { ?>
        <div class="category-one">
            <span class="category-create-span"> ID - <?= $good->id ?> </span>
            <span class="category-create-span"> Name - <?= $good->name ?> </span>
            <span class="category-create-span"> Description - <?= $good->description ?> </span>
            <span class="category-create-span"> Price - <?= $good->price ?> </span>
            <span class="category-create-span"> Category - <?= $good->description ?> </span>
            <span class="category-create-span"> createTime - <?= $good->createTime ?> </span>
            <span class="category-create-span"> updateTime - <?= $good->updateTime ?> </span>
        </div>
    <?php }?>
</div>