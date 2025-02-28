<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'Categories';

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
            <span class="category-create-span"> Created at - <?= $category->createTime ?> </span>
            <span class="category-create-span"> Update at - <?= $category->updateTime ?> </span><br>
            <div class="increment-decrement">
                <?= Html::a('Update', ['category/readone', 'id' => $category->id], ['class' => ['profile-link', 'change-buttons']]); ?>
                <?= Html::a('Delete', ['category/deleteone', 'id' => $category->id], ['class' => ['profile-link', 'change-buttons']]); ?>
            </div>
        </div>
    <?php }?>
</div>
