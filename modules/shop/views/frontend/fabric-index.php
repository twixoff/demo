<?php

use app\components\Page;
use yii\widgets\ListView;

$this->title = Page::getTitle();

?>

<div class="container page-header d-flex flex-wrap align-items-center">
    <div class="root-title"><?= Page::getName() ?></div>
</div>
<div class="container my-5">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'row'],
        'layout' => "{items}\n{pager}",
        'itemView' => '_view-fabric',
        'itemOptions' => ['tag' => false],
        'emptyText' => 'Фабрики еще не были добавлены.',
        'emptyTextOptions' => ['class' => 'my-4']
    ]); ?>
</div>
