<?php use app\modules\infoblocks\models\InfoBlockCard; ?>
<div class="info-block-cards">
    <?= !empty($model->content) ? $model->content : '' ?>
    <?php if ($model->cards) : ?>
        <div class="row">
            <?php foreach ($model->cards as $item) : ?>
                <?php if($item->type_id == InfoBlockCard::TYPE_CARD) : ?>
                    <div class="col-sm-4 col-lg-3">
                        <div class="info-block-card">
                            <a href="<?= $item->link ?>">
                                <?php if ($item->image) : ?>
                                    <div class="photo-wrap">
                                        <img src="<?= $item->getPhoto('thumb') ?>" class="img-fluid">
                                    </div>
                                <?php endif; ?>
                                <div class="card-info">
                                    <div class="title"><?= $item->title ?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php elseif($item->type_id == InfoBlockCard::TYPE_CONTACT) : ?>
                    <div class="col-sm-4 col-lg-3">
                        <div class="info-block-card contact">
                            <?php if ($item->image) : ?>
                                <div class="photo-wrap">
                                    <img src="<?= $item->getPhoto('thumb') ?>" class="img-fluid">
                                </div>
                            <?php endif; ?>
                            <div class="card-info">
                                <div class="title"><b><?= $item->title ?></b></div>
                                <table class="table">
                                    <?php if($item->phone) : ?>
                                        <tr>
                                            <td><img src="/static/i/ico-phone.png" /></td>
                                            <td><?= $item->phone ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($item->email) : ?>
                                        <tr>
                                            <td><img src="/static/i/ico-email.png" /></td>
                                            <td><?= $item->email ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>