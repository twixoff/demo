<?php use app\components\Page; ?>
<div class="col-sm-6 col-md-3 col-lg-4 px-2 py-4 d-flex align-items-center justify-content-center">
    <a href="<?= Page::getCurrent()->getUrl().'/'.$model->id ?>">
        <?php if($model->logo) : ?>
            <img src="<?= $model->getPhoto('big', 'logo') ?>">
        <?php else : ?>
            <span><?= $model->title ?></span>
        <?php endif; ?>
    </a>
</div>