<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model */

$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['/category/readall']];
$this->params['breadcrumbs'][] = 'Change category';

?>

<?php $form = ActiveForm::begin() ?>

    <?= $form ->field($model, 'name')->textInput(); ?>
    <?= $form ->field($model, 'description')->textInput(); ?>

    <?= Html::submitButton('Change category', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end()?>
