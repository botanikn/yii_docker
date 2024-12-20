<?php

use yii\helpers\Html;

?>
<div class="category-readall-header">
    <h1>Categories</h1>
    <?= Html::a('New category', ['category/create'], ['class' => ['profile-link', 'index-a', 'small-buttons']]); ?>
</div>

<div class="readll-grid">
    <?php foreach ($allCategory as $category) { ?>
        <div class="category-one">
            <span class="category-create-span"> ID - <?= $category->id ?> </span>
            <span class="category-create-span"> Name - <?= $category->name ?> </span>
            <span class="category-create-span"> Description - <?= $category->description ?> </span>
            <span class="category-create-span"> createTime - <?= $category->createTime ?> </span>
            <span class="category-create-span"> updateTime - <?= $category->updateTime ?> </span>
        </div>
    <?php }?>
</div>
