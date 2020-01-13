<?php

use app\components\Page;
use yii\widgets\ListView;

$this->title = Page::getTitle();
Page::setDescription(Page::getDescription());
$current = Page::getCurrent();
$hasLeftMenu = Page::getRoot()->hasChildren();

// TODO:: add seo to title & descr

?>

<?php
$class = "";
$style = "";
$image_header = $current->image_header
    ? $current->getPhoto('big', 'image_header')
    : (!empty($current->parent) && $current->parent->image_header ? $current->parent->getPhoto('big', 'image_header') :
        (!empty($current->parent->parent) && $current->parent->parent->image_header ? $current->parent->parent->getPhoto('big', 'image_header') : false)
    );
if($image_header) {
    $class = " with-image";
    $style = "style=\"background-image: url('". $image_header ."');\"";
} ?>
<div class="header-wrap catalog-header<?= $class ?>" <?= $style ?>>
    <div class="container">
        <h1 class="page-header"><?= Page::getName() ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php if($hasLeftMenu) : ?>
            <div class="col-md-3">
                <?= $this->render('//layouts/_leftmenu') ?>
            </div>
        <?php endif; ?>
        <div class="<?= $hasLeftMenu ? 'col-md-9' : 'col-12' ?>">
            <?php if($total > 0) : ?>
                <?php $productCounts = count($products) ?>
                <div class="product-summary">Всего <span><?= $total ?></span> <?= Yii::t('app', '{n, plural, one{товар} few{товара} many{товаров} other{товара}}', ['n' => $total]) ?></div>
                <?php foreach($products as $part) : ?>
                    <?php if(!empty($part['products'])) : ?>
                        <table class="table-product">
                            <thead>
                                <tr class="d-none d-sm-table-row">
                                    <th><?= $part['part']->name ?></th>
                                    <th class="text-center">Ед. изм.</th>
                                    <th class="text-center">Кол-во</th>
                                    <th class="text-center">Цена</th>
                                    <th></th>
                                </tr>
                                <tr class="d-sm-none">
                                    <th colspan="6"><?= $part['part']->name ?></th>
                                </tr>
                            </thead>
                            <?php foreach($part['products'] as $item) : ?>
                                <?= $this->render('_item-row', ['item' => $item]) ?>
                            <?php endforeach; ?>
                        </table>
                    <?php else : ?>
                        <h2 class="category-header"><?= $part['part']->name ?></h2>
                        <?php foreach($part as $part2) : ?>
                            <?php if(!empty($part2['products'])) : ?>
                                <table class="table-product">
                                    <thead>
                                    <tr class="d-none d-sm-table-row">
                                        <th><?= $part2['part']->name ?></th>
                                        <th class="text-center">Ед. изм.</th>
                                        <th class="text-center">Кол-во</th>
                                        <th class="text-center">Цена</th>
                                        <th></th>
                                    </tr>
                                    <tr class="d-sm-none">
                                        <th colspan="6"><?= $part['part']->name ?></th>
                                    </tr>
                                    </thead>
                                    <?php foreach($part2['products'] as $item2) : ?>
                                        <?= $this->render('_item-row', ['item' => $item2]) ?>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <?= ListView::widget([
                'dataProvider' => $infoblocks,
                'options' => ['class' => 'content'],
                'layout' => '{items}{pager}',
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/modules/infoblocks/views/frontend/_view-'.$model->type, ['model' => $model]);
                },
                'itemOptions' => ['tag' => false],
                'emptyText' => ''
            ]); ?>
        </div>
    </div>
</div>

<?= $this->render('//layouts/_gallery-bottom') ?>

<?= $this->render('_modal-added-to-cart') ?>