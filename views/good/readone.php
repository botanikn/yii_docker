<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/good/readall']];
$this->params['breadcrumbs'][] = 'Change the Good';

?>

<h1>Change the good</h1>

<?php $form = ActiveForm::begin([]) ?>

    <?= $form ->field($good, 'name') ?>
    <?= $form ->field($good, 'description') ?>
    <?= $form ->field($good, 'price') ?>
    <?= $form ->field($good, 'categoryID')->dropDownList($items, ['prompt' => 'Выберите категорию']) ?>

    <?= Html::submitButton('Change the good', ['class' => 'btn btn-primary']) ?>



<?php ActiveForm::end() ?>
