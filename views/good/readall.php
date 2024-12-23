<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'Catalog';

?>
<div class="category-readall-header">
    <h1>Catalog</h1>
    <?= Yii::$app->user->identity->roleID == 1 ? Html::a('New good', ['good/create'], ['class' => ['profile-link', 'index-a', 'small-buttons']]) : '' ?>
</div>

<div class="readll-grid">
    <?php foreach ($allGoods as $good) { ?>
        <div class="category-one">
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'ID -' . $good['id'] : ''  ?> </span>
            <span class="category-create-span"> Name - <?= $good['name'] ?> </span>
            <span class="category-create-span"> Description - <?= $good['description'] ?> </span>
            <span class="category-create-span"> Price - <?= $good['price'] ?> $</span>
            <span class="category-create-span"> Category - <?= $good['category'] ?> </span>
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'createTime - ' . $good['createTime'] : '' ?> </span>
            <span class="category-create-span"><?= Yii::$app->user->identity->roleID == 1 ?  'updateTime - ' . $good['updateTime'] : '' ?> </span>

        </div>
    <?php }?>
</div>