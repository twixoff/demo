<?php use app\components\helpers\YoutubeHelper; ?>

<div class="info-block-video">
    <table border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td>
                    <?php if($model->video) : ?>
                        <iframe frameborder="0" height="305" scrolling="no" src="//www.youtube.com/embed/<?= YoutubeHelper::getId($model->video) ?>" width="500"></iframe>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($model->title) : ?>
                        <h2><?= $model->title ?></h2>
                    <?php endif; ?>
                    <?php if($model->content) : ?>
                        <?= $model->content ?>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>