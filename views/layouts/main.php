<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use \app\models\CartActiveRecord;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);

    $menuItems = [['label' => 'Sign Up', 'url' => ['/registration/index']]];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        // Элемент выхода для авторизованных пользователей
        $menuItems[] = [
            'label' => 'Logout (' . Html::encode(Yii::$app->user->identity->login) . ')',
            'url' => '#',
            'linkOptions' => [
                'onclick' => '$("#logout-form").submit(); return false;',
            ],
        ];
        $menuItems[] = ['label' => 'Catalog', 'url' => ['/good/readall']];

        // Вывод для администраторов
        if (\Yii::$app->user->identity->roleID == 1) {
            $menuItems[] = ['label' => 'Categories', 'url' => ['/category/readall']];
            $menuItems[] = ['label' => 'Orders', 'url' => ['/order/readfew']];
        }

        // Вывод для клиентов
        else if (\Yii::$app->user->identity->roleID == 2) {
            $cart = new CartActiveRecord();
            $query = $cart::find()
                ->where(['userID' => Yii::$app->user->id])
                ->all();
            $totalItems = 0;
            foreach ($query as $item) {
                $totalItems += $item->quantity;
            }
            $menuItems[] = [
                    'label' => 'My Cart (' . $totalItems . ')',
                    'url' => ['/cart/index']
            ];
            $menuItems[] = [
                'label' => 'My Orders',
                'url' => ['/order/readfew']
            ];
        }
    }

    echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logout-form']);
    echo Html::endForm();

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Pet LLC <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
