<?php

use yii\helpers\Html;

?>
<h1>Categories</h1>
<?= Html::a('New category', ['category/create'], ['class' => ['profile-link', 'index-a']]); ?>
<div class="readll-grid">
    <?php foreach ($allCategory as $category) { ?>
        <div class="category-one">
            <span> ID - <?= $category->id ?> </span>
            <span> Name - <?= $category->name ?> </span>
            <span> Description - <?= $category->description ?> </span>
            <span> createTime - <?= $category->createTime ?> </span>
            <span> updateTime - <?= $category->updateTime ?> </span>
        </div>
    <?php }?>
</div>
