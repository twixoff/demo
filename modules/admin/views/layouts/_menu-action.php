<?php
use yii\helpers\Url;
$act = Yii::$app->controller->action->id;
$cntr = Yii::$app->controller->id;
$module = $this->context->module->id;
$contr = Yii::$app->controller->id;
$category = Yii::$app->getRequest()->get('category');
?>

<div class="list-group">
    <a href="<?= Url::to(['/admin/shop/category'])?>" class="list-group-item <?= $cntr == 'category' ? 'active' : ''?>"><i class="fa fa-grip-horizontal"></i> Категории освещения</a>
    <a href="<?= Url::to(['/admin/shop/type'])?>" class="list-group-item <?= $cntr == 'type' ? 'active' : ''?>"><i class="fa fa-grip-horizontal"></i> Типы освещения</a>
    <?php /* <a href="<?= Url::to(['/admin/shop/order'])?>" class="list-group-item <?= $contr == 'order' ? 'active' : ''?>"><i class="fa fa-shopping-cart"></i> Заказы</a> */ ?>
</div>

<div class="list-group">
    <a href="<?= Url::to(['/admin/slider', 'category' => 'fabric'])?>" class="list-group-item <?= $cntr == 'slider' && $category == 'fabric' ? 'active' : ''?>"><i class="fa fa-image"></i> Слайдер фабрик</a>
    <?php /* <a href="<?= Url::to(['/admin/slider', 'category' => 'category'])?>" class="list-group-item <?= $cntr == 'slider' && $category == 'category' ? 'active' : ''?>"><i class="fa fa-image"></i> Слайдер категорий</a> */ ?>
    <a href="<?= Url::to(['/admin/slider', 'category' => 'project'])?>" class="list-group-item <?= $cntr == 'slider' && $category == 'project' ? 'active' : ''?>"><i class="fa fa-image"></i> Слайдер проектов</a>
    <a href="<?= Url::to(['/admin/slider', 'category' => 'new'])?>" class="list-group-item <?= $cntr == 'slider' && $category == 'new' ? 'active' : ''?>"><i class="fa fa-image"></i> Новинки</a>
</div>

<div class="list-group">
    <a href="<?= Url::to(['/admin/structure/index'])?>" class="list-group-item <?= $cntr == 'structure' ? 'active' : ''?>"><i class="fa fa-sitemap"></i> Структура сайта</a>
    <?php /* <a href="<?= Url::to(['/admin/redirects'])?>" class="list-group-item <?= $cntr == 'redirects' ? 'active' : ''?>"><i class="fa fa-random"></i> Таблица редиректа</a> */ ?>
    <?php /* <a href="<?= Url::to(['/admin/file-manager'])?>" class="list-group-item <?= $cntr == 'file-manager' ? 'active' : ''?>"><i class="fa fa-folder-open"></i> Менеджер файлов</a> */ ?>
    <?php /* <a href="<?= Url::to(['/admin/notifications'])?>" class="list-group-item <?= $module == 'notifications' ? 'active' : ''?>"><i class="fa fa-envelope"></i> Автоуведомления</a> */ ?>
    <a href="<?= Url::to(['/admin/config'])?>" class="list-group-item <?= $module == 'config' && !$category ? 'active' : ''?>"><i class="fa fa-cog"></i> Настройки</a>
    <?php /* <a href="<?= Url::to(['/admin/config', 'category' => 'index'])?>" class="list-group-item <?= $module == 'config' && $category == 'index' ? 'active' : ''?>"><i class="fa fa-gears"></i> Переменные</a> */?>
    <a href="<?= Url::to(['/admin/user'])?>" class="list-group-item <?= $this->context->module->id == 'user' ? 'active' : ''?>"><i class="fa fa-users"></i> Пользователи</a>
</div>