<?php
use app\components\Page;
$this->title = $model->title .' - '. Page::getTitle();
?>

<div class="container page-header d-flex flex-wrap align-items-center">
    <a href="<?= $model->section->getUrl() ?>" class="root-title"><?= $model->section->name ?></a>
    <div class="project-title d-flex align-bottom">
        <a href="<?= $model->section->getUrl() ?>" class="separator">
            <img src="/static/i/arrow-left.svg">
        </a>
        <div class="sub-title"><?= $model->type->title ?></div>
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

<div class="container serie-description-box">
    <div class="portfolio-description px-3 px-md-0">
        <div class="row">
            <div class="col-md-7 offset-md-1">
                <div class="title"><?= $model->title ?></div>
            </div>
            <div class="col-md-7 offset-md-1">
                <?= $model->description ?>
                <?php if($model->file) : ?>
                    <a href="<?= $model->file ?>" class="btn btn-sm btn-outline-primary text-uppercase" download><i class="fas fa-chevron-down"></i> Инструкция</a>
                <?php endif; ?>
            </div>
            <div class="col-md-2 offset-md-1 mb-3 font-14">
                <p class="font-weight-bold">Фабрика:<br>
                    <?php if($model->fabric) : ?>
                        <a href="<?= $model->fabric->getUrl() ?>" class="fabric-link"><?= $model->fabric->title ?></a>
                    <?php else : ?>
                        не указана
                    <?php endif; ?>
                </p>
                <span class="location"><?= nl2br($model->info) ?></span>
            </div>
        </div>
    </div>
</div>

<?php $products = $model->activeProducts; ?>
<?php if($products !== null) : ?>
    <div class="product-list bg-white">
        <div class="container">
            <?php foreach($products as $p) : ?>
                <div class="product-item row">
                    <div class="col-sm-6 col-md-9">
                        <?php if($p->image) : ?>
                            <img src="<?= $p->getPhoto('big') ?>" class="img-fluid mb-5 mb-sm-0">
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="product-title"><?= $p->title ?></div>
                        <div class="product-content"><?= nl2br($p->content) ?></div>
                        <?php if($p->price) : ?>
                        <b class="product-price"><?= number_format($p->price, 0, '.', ' ') ?> тг.</b>
                        <?php endif; ?>
                        <button type="button" class="btn btn-s btn-outline-primary text-uppercase" data-modal-url="/quick-order/<?= $p->id ?>">Заказать</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="modal fade" id="modal-free" tabindex="-1" role="dialog" aria-labelledby="modal-free" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- dynamic content -->
        </div>
    </div>
</div>
