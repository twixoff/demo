<?php
use app\modules\config\models\Config;
$files = Config::find()->where(['category' => 'useful', 'type' => 'file', 'isHide' => 0])->orderBy('sort')->all();
?>
<div class="info-block-useful">
    <?php if ($files) : ?>
        <div class="row">
            <?php foreach ($files as $item) : ?>
                <?php $ext = strtolower(pathinfo($item->value, PATHINFO_EXTENSION));
                    switch ($ext) {
                        case 'pdf': $iconName = 'file-pdf'; break;
                        case 'csv':
                        case 'xls':
                        case 'xlsx': $iconName = 'file-xls'; break;
                        case 'doc':
                        case 'docx': $iconName = 'file-word'; break;
                        case 'zip':
                        case '7z':
                        case 'tar': $iconName = 'file-zip'; break;
                        default: $iconName = 'file-text'; break;
                    }
                ?>
                <div class="col-md-4 col-lg-3">
                    <div class="media mb-3">
                        <img src="/static/i/<?= $iconName ?>.png" class="align-self-center mr-3" />
                        <div class="media-body">
                            <a href="<?= $item->value ?>" download=""><?= $item->label ?></a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>