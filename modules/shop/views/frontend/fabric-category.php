<?php
use app\components\Page;
use kop\y2sp\ScrollPager;
use yii\widgets\ListView;
use app\modules\admin\models\Structure;

$menuLeft = Structure::find()->where(['type_id' => 60, 'is_publish' => 1])->orderBy(['sort' => SORT_ASC])->all();
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
<div class="container mb-5">
    <div class="fabric-info-block full-width-mobile py-3 py-md-5">
        <div class="row">
            <div class="col-md-5 offset-md-1 mb-3 mb-md-0">
                <?= $model->text ?>
                <?php if($model->catalog) : ?>
                    <a href="<?= $model->catalog ?>" class="btn btn-outline-primary text-uppercase mt-3 mb-3 mb-md-0" download><i class="fas fa-chevron-down"></i> Скачать каталог</a>
                <?php endif; ?>
            </div>
            <div class="col-sm-4 offset-sm-1 font-14"><?= $model->description ?></div>
        </div>
    </div>
</div>

<div class="container page-header d-flex flex-wrap align-items-center">
    <a href="<?= $model->id ?>" class="root-title"><?= $model->title ?></a>
    <div class="project-title d-flex align-bottom">
        <a href="<?= $model->id ?>" class="separator">
            <img src="/static/i/arrow-left.svg">
        </a>
        <div class="sub-title"><?= $category->name ?></div>
    </div>
</div>

<div class="container mb-5">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'ias-container'],
        'itemOptions' => ['tag' => false],
        'viewParams' => ['category_id' => $category->id, 'fabric_id' => $model->id],
        'layout' => "{items}\n<div class='d-none'>{pager}</div> ",
        'itemView' => '_view-list',
        'emptyText' => 'В данной категории еще не добавлено продуктов.',
        'emptyTextOptions' => ['class' => 'my-4'],
        'pager' => [
            'class' => ScrollPager::class,
            'container' => '.ias-container',
            'item' => '.row.mb-5',
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
