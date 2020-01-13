<?php
use app\components\Page;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$this->title = $model->title .' - '. Page::getTitle();
?>

<div class="container page-cover">
    <div class="row">
        <div class="col-md-4 pr-0 cover-left">
            <div class="cover-bg"></div>
            <div class="cover-title">Освещение<br> <?= $model->title ?></div>
        </div>
        <div class="col-md-8 pl-0">
            <?php if($model->image) : ?>
                <img src="<?= $model->getPhoto('big', 'image') ?>" class="img-fluid">
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="fabric-info-block full-width-mobile py-3 py-md-5">
        <div class="row">
            <div class="col-md-5 offset-md-1"><?= $model->intro ?></div>
            <div class="col-md-4 offset-md-1 font-14"><?= $model->text ?></div>
        </div>
    </div>
</div>

<div class="container page-header d-flex flex-wrap align-items-center">
    <div class="root-title"><?= $model->title ?></div>
    <button class="navbar-toggler align-self-center d-md-none mb-3" type="button" data-toggle="collapse" data-target="#navbar-left" aria-controls="navbar-left" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-chevron-down"></i>
    </button>
</div>

<div class="container">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'ias-container'],
        'itemOptions' => ['tag' => false],
        'layout' => "{items}\n<div class='d-none'>{pager}</div> ",
        'itemView' => '_view-list-new',
        'emptyText' => 'В данной категории еще не добавлено продуктов.',
        'emptyTextOptions' => ['class' => 'my-4'],
        'pager' => [
            'class' => ScrollPager::class,
            'container' => '.ias-container',
            'item' => '.row.mb-5',
//            'triggerText' => 'Показать ещё',
//            'triggerTemplate' => '<div class="text-center py-4"><button type="button">{text}</button></div>',
            'spinnerSrc' => '/static/i/spinner.svg',
            'spinnerTemplate' => '<div class="text-center w-100 my-3"><img src="{src}" class="ias-spinner"></div>',
            'enabledExtensions' => [
//                ScrollPager::EXTENSION_TRIGGER,
                ScrollPager::EXTENSION_SPINNER,
//                ScrollPager::EXTENSION_NONE_LEFT,
                ScrollPager::EXTENSION_PAGING,
//                ScrollPager::EXTENSION_HISTORY
            ]
        ]
    ]); ?>
</div>