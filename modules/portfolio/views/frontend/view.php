<?php
use app\components\Page;
$root = Page::getRoot();
?>

<div class="container page-header d-flex flex-wrap align-items-center">
    <a href="<?= $root->getUrl() ?>" class="root-title"><?= $root->name ?></a>
    <div class="project-title d-flex align-bottom">
        <a href="<?= $root->getUrl() ?>" class="separator">
            <img src="/static/i/arrow-left.svg">
        </a>
        <h1 class="sub-title"><?= $model->title ?></h1>
    </div>
</div>

<?php if($model->images) : ?>
    <div class="container">
        <div class="portfolio-gallery">
            <div class="owl-carousel owl-dark">
                <?php foreach($model->images as $k=>$image) : ?>
                    <img src="<?= $image->getPhoto('big') ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container mb-5">
    <div class="portfolio-description px-3 px-md-0">
        <div class="row">
            <div class="col-md-7 offset-md-1">
                <div class="title"><?= $model->title ?></div>
            </div>
            <div class="col-md-7 offset-md-1">
                <?= $model->text ?>
            </div>
            <div class="col-md-2 offset-md-1 mb-3">
                <span class="location"><?= $model->location ?></span>
            </div>
        </div>
    </div>
</div>

<?php if($model->use_series) : ?>
    <div class="container mb-5">
        <div class="font-20 font-medium text-uppercase mb-3">В проекте использованы</div>
        <div class="row">
            <?php foreach($model->series as $serie) : ?>
                <?= $this->render('_view-serie', ['model' => $serie]) ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
