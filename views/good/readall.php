<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'Goods';

?>
<div class="good-readall-header">
    <h1>Goods in catalog</h1>
    <?= Html::a('New good', ['good/create'], ['class' => ['profile-link', 'index-a', 'small-buttons']]); ?>
</div>

<div class="readll-grid">
    <?php foreach ($allGoods as $good) { ?>
        <div class="category-one">
            <span class="category-create-span"> ID - <?= $good->id ?> </span>
<!--            <span class="category-create-span"> Name - --><?php //= $good['name'] ?><!-- </span>-->
<!--            <span class="category-create-span"> Description - --><?php //= $good['description'] ?><!-- </span>-->
<!--            <span class="category-create-span"> Price - --><?php //= $good['price'] ?><!-- </span>-->
<!--            <span class="category-create-span"> Category - --><?php //= $good['categoryName'] ?><!-- </span>-->
<!--            <span class="category-create-span"> createTime - --><?php //= $good['createTime'] ?><!-- </span>-->
<!--            <span class="category-create-span"> updateTime - --><?php //= $good['updateTime'] ?><!-- </span>-->
        </div>
    <?php }?>
</div>