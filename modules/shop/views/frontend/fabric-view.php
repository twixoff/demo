<?php
use app\components\Page;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$this->title = $model->title .' - '. Page::getTitle();
?>

<div class="container page-cover">
    <div class="row">
        <div class="col-sm-4 pr-sm-0 cover-left">
            <div class="cover-bg"></div>
            <?php if($model->logo) : ?>
                <img src="<?= $model->getPhoto('big', 'logo') ?>" class="cover-logo">
            <?php endif; ?>
        </div>
        <div class="col-sm-8 pl-sm-0">
            <?php if($model->cover) : ?>
                <img src="<?= $model->getPhoto('big', 'cover') ?>" class="img-fluid">
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container mb-3 mb-md-5">
    <div class="fabric-info-block full-width-mobile py-3 py-md-5">
        <div class="row">
            <div class="col-md-5 offset-md-1 mb-3 mb-md-0">
                <?= $model->text ?>
                <?php if($model->catalog) : ?>
                    <a href="<?= $model->catalog ?>" class="btn btn-outline-primary text-uppercase mt-3 mb-3 mb-md-0" download><i class="fas fa-chevron-down"></i> Скачать каталог</a>
                <?php endif; ?>
            </div>
            <div class="col-md-4 offset-md-1 font-14"><?= $model->description ?></div>
        </div>
    </div>
</div>

<div class="container page-header d-flex flex-wrap align-items-center">
    <div class="root-title"><?= $model->title ?></div>
    <button class="navbar-toggler align-self-center d-md-none mb-3" type="button" data-toggle="collapse" data-target="#navbar-left" aria-controls="navbar-left" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-chevron-down"></i>
    </button>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?= $this->render('_menu-left') ?>
        </div>
        <div class="col-md-9 col-lg-8 offset-lg-1">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'row ias-container'],
                'itemOptions' => ['tag' => false],
                'layout' => "{items}\n<div class='d-none'>{pager}</div> ",
                'itemView' => '_view',
                'emptyText' => 'В данной категории еще не добавлено продуктов.',
                'emptyTextOptions' => ['class' => 'my-4'],
                'pager' => [
                    'class' => ScrollPager::class,
                    'container' => '.ias-container',
                    'item' => '.col-6.col-md-4',
//                    'triggerText' => 'Показать ещё',
//                    'triggerTemplate' => '<div class="text-center py-4"><button type="button">{text}</button></div>',
                    'spinnerSrc' => '/static/i/spinner.svg',
                    'spinnerTemplate' => '<div class="text-center w-100 my-3"><img src="{src}" class="ias-spinner"></div>',
                    'enabledExtensions' => [
//                        ScrollPager::EXTENSION_TRIGGER,
                        ScrollPager::EXTENSION_SPINNER,
//                        ScrollPager::EXTENSION_NONE_LEFT,
                        ScrollPager::EXTENSION_PAGING,
//                        ScrollPager::EXTENSION_HISTORY
                    ]
                ]
            ]); ?>
        </div>
    </div>
</div>
