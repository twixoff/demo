<?php
use app\components\Page;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;
?>

<div class="container page-header d-flex flex-wrap align-items-center">
    <div class="root-title"><?= Page::getName() ?></div>
</div>
<div class="container">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'ias-container'],
        'itemOptions' => ['tag' => false],
        'layout' => "{items}\n<div class='d-none'>{pager}</div> ",
        'itemView' => '_view-list',
        'viewParams' => ['category_id' => $category_id],
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