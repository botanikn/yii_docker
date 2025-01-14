<?php

use yii\helpers\Html;
use yii\web\UrlManager;

?>

<div>
    <p>Привет <?= Html::encode($user->login) ?></p>
    <p><?= Html::a('Для смены пароля перейдите по этой ссылке', Yii::$app->UrlManager->createAbsoluteUrl(
        [
            'main/reset-password',
            'key' => $user->secret_key
        ]
    ))
    ?>
    </p>
</div>