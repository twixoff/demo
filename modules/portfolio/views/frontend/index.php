<?php
use app\components\Page;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$this->title = Page::getTitle();
?>

<div class="container mb-5">
    <?php foreach($items as $part) : ?>
        <div class="row">
            <div class="col-sm-3 col-md-2 pr-sm-0">
                <div class="portfolio-category-title"><?= $part['part']->title ?></div>
            </div>
            <div class="col-sm-9 col-md-10">
                <?php foreach($part['items'] as $item) : ?>
                    <?= $this->render('_view', ['model' => $item]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>