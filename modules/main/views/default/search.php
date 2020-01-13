<?php

use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$this->title = 'Поиск';
Yii::$app->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <form action="/search" class="page-search d-flex align-items-center justify-content-between my-4 my-md-5">
        <div class="text-nowrap">Вы искали:</div>
        <input type="text" name="q" value="<?= $q ?>" class="w-100 mx-3">
        <button type="submit"><img src="/static/i/search.svg"></button>
    </form>
</div>

<div class="container">
    <?php if($dataProvider) : ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row ias-container mb-5'],
            'itemOptions' => ['tag' => false],
            'layout' => "{items}\n<div class='d-none'>{pager}</div>",
            'itemView' => '_view-search',
            'emptyText' => 'Ничего не найдено.',
            'emptyTextOptions' => ['class' => 'my-4'],
            'pager' => [
                'class' => ScrollPager::class,
                'container' => '.ias-container',
                'item' => '.col-6.col-md-4',
//                'triggerText' => 'Показать ещё',
//                'triggerTemplate' => '<div class="show-more-wrap"><button type="button" class="btn-show-more"><span>{text}</span></button></div>',
                'spinnerSrc' => '/static/i/spinner.svg',
                'spinnerTemplate' => '<div class="text-center w-100 my-3"><img src="{src}" class="ias-spinner"></div>',
                'enabledExtensions' => [
//                    ScrollPager::EXTENSION_TRIGGER,
                    ScrollPager::EXTENSION_SPINNER,
//                    ScrollPager::EXTENSION_NONE_LEFT,
                    ScrollPager::EXTENSION_PAGING,
//                    ScrollPager::EXTENSION_HISTORY
                ]
            ]
        ]); ?>
    <?php endif; ?>
</div>