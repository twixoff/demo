<?php

use app\components\Page;
use yii\widgets\ListView;

$this->title = Page::getTitle();
$current = Page::getCurrent();
$hasLeftMenu = Page::getRoot()->hasChildren() && $current->id != 3;

?>

<div class="header-wrap">
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
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'info-blocks-list'],
                'layout' => '{items}{pager}',
                'itemView' => function ($model, $key, $index, $widget) {
                    $view = $this->context->module->getBlockView($model->type);
                    return $this->render($view, ['model' => $model]);
                },
                'itemOptions' => ['tag' => false],
                'emptyText' => ''
            ]); ?>
        </div>
    </div>
</div>