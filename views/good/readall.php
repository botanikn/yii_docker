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
    <?php foreach ($allGoods as $good) { ?>
        <div>
            <?php $form = ActiveForm::begin(['options' => [
                'class' => 'form'
            ]])?>
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

            <?= Html::hiddenInput('id', $good['id']) ?>

            <?= Yii::$app->user->identity->roleID == 2 ? Html::submitButton('Add to cart', ['class' => 'btn btn-primary']) : ''?>
            <?php ActiveForm::end()?>

        </div>
    <?php }?>
</div>