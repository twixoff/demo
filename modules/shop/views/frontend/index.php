<?php

use app\components\Page;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$this->title = Page::getTitle();

?>

<div class="container page-header d-flex flex-wrap align-items-center">
    <div class="root-title"><?= Page::getName() ?></div>
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
                'options' => ['class' => 'row'],
                'layout' => "{items}\n{pager}",
                'itemView' => '_view',
                'itemOptions' => ['tag' => false],
                'emptyText' => 'В данной категории еще не добавлено продуктов.',
                'emptyTextOptions' => ['class' => 'my-4']
            ]); ?>
        </div>
    </div>
</div>