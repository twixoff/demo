<?php if($fabricSlider) : ?>
    <div class="container slider-fabric section-numbered num-1 mb-3 mb-md-5">
        <div class="owl-carousel owl-dark">
            <?php foreach($fabricSlider as $fs) : ?>
            <div class="slide-item">
                <div class="slide-bg"></div>
                <div class="slide-info">
                    <span>Фабрика</span>
                    <img src="<?= $fs->getPhoto('big', 'image_logo') ?>">
                    <p><?= $fs->descr ?></p>
                    <?php if($fs->link) : ?>
                        <a href="<?= $fs->link ?>" class="btn btn-sm btn-outline-secondary text-uppercase d-sm-inline-block">Подробнее</a>
                    <?php endif; ?>
                </div>
                <div class="slide-img">
                    <img src="<?= $fs->getPhoto('big') ?>">
                </div>
                <?php /*
                <a href="<?= $fs->link ?>" class="btn btn-outline-secondary text-uppercase d-sm-none">Подробнее</a>
                */ ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="slider-counter"></div>
    </div>
<?php endif; ?>

<?php if($categorySlider) : ?>
    <div class="container slider-category section-numbered num-2 pt-3 pt-md-5 mb-3 mb-md-5 wow customAnimate" data-wow-offset="250">
        <div class="row">
            <div class="col-sm-11 offset-sm-1">
                <div class="section-header">Выбирите направление<br>светового оборудования</div>
            </div>
        </div>
        <div class="owl-carousel owl-dark">
            <?php foreach($categorySlider as $cs) : ?>
                <div class="slide-item">
                    <img src="<?= $cs->getPhoto('big') ?>">
                    <div class="inner-wrap d-flex flex-column justify-content-between">
                        <div class="slide-title">Освещение <?= $cs->title ?></div>
                        <div>
                            <a href="/category/<?= $cs->id ?>" class="btn btn-sm btn-outline-secondary stretched-link d-md-none text-uppercase">Подробнее</a>
                            <a href="/category/<?= $cs->id ?>" class="btn btn-outline-secondary stretched-link d-none d-md-inline-block text-uppercase">Подробнее</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if($newItems) : ?>
    <div class="container section-new-items section-numbered num-3 pt-3 pt-md-5 pb-3 pb-md-5 mb-3 mb-md-5">
        <div class="row">
            <?php foreach($newItems as $k => $nI) : ?>
                <?php if($k === 0) : ?>
                    <div class="col-sm-8 mb-3 mb-md-0">
                        <div class="new-item-left h-100 wow customAnimate" data-wow-offset="250">
                            <div class="item-bg" style="background-image: url('<?= $nI->getPhoto('big') ?>');"></div>
                            <div class="inner-wrap d-flex flex-column justify-content-between">
                                <div class="item-header">
                                    <div class="label">New</div>
                                    <div class="title"><?= $nI->title ?></div>
                                </div>
                                <div>
                                    <a href="<?= $nI->link ?>" class="btn btn-outline-secondary stretched-link text-uppercase">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-sm-4">
                        <div class="new-item-right h-100 wow customAnimate" data-wow-offset="250" data-wow-delay=".5s">
                            <div class="item-bg" style="background-image: url('<?= $nI->getPhoto('big') ?>');"></div>
                            <div class="inner-wrap d-flex flex-column justify-content-between">
                                <div class="item-header">
                                    <div class="label">New</div>
                                    <div class="title"><?= $nI->title ?></div>
                                </div>
                                <div>
                                    <a href="<?= $nI->link ?>" class="btn btn-outline-primary stretched-link text-uppercase">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if($projectSlider) : ?>
    <div class="slider-projects pt-4 pb-2">
        <div class="container section-numbered num-4 wow customAnimate" data-wow-offset="250">
            <div class="section-header">
                <div class="label">Проекты</div>
                <div class="title"></div>
            </div>
            <div class="owl-carousel owl-light">
                <?php foreach($projectSlider as $ps) : ?>
                    <a href="<?= $ps->link ?>">
                        <img src="<?= $ps->getPhoto('big') ?>" title="<?= $ps->title ?>">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="section-about pt-3 pt-md-5">
    <div class="container section-numbered num-5 py-3 py-md-5 wow customAnimate" data-wow-offset="250">
        <div class="row">
            <div class="col-sm-11 offset-sm-1">
                <div class="section-header text-uppercase mb-3 mb-md-5">Union light systems</div>
            </div>
            <div class="col-sm-10 col-md-5 offset-sm-1 font-20 mb-4 mb-md-5">
                <p class="mb-3 mb-md-5">Union Light Systems – комплексные световые решения любой сложности, применимые в разных сферах жизни. Мы ценим высокое качество и оригинальный световой дизайн. Поэтому – вкладываем ресурсы на создание инновационных аксессуаров.</p>
                <a href="/company" class="btn btn-outline-primary text-uppercase">Подробнее</a>
            </div>
            <div class="col-sm-10 col-md-5 offset-sm-1 font-light">
                <p>Мы помогаем спроектировать систему освещения, учитывая два аспекта: эстетическое восприятие и эргономический аспект. Каждый продукт – результат упорства и стремления к совершенству.</p>
                <p>Union Light Systems – это потолочные, настенные, уличные светильники и споты, которые идеально вписываются не только в производственные и торговые помещения, но также прекрасно адаптируются в офисном и домашнем интерьере.</p>
            </div>
        </div>
    </div>
</div>

<?php /* if($infoBlocks) : ?>
    <div class="main-page-info-blocks">
        <div class="container">
            <?php foreach($infoBlocks as $i) : ?>
                <?= $this->render('@app/modules/infoblocks/views/frontend/_view-'.$i->type, ['model' => $i]); ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; */ ?>