<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

\app\assets\FontAwesomeAsset::register($this);
\app\modules\admin\AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=1030">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    
    <?= $this->render('_header'); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 left-side">
                <?= $this->render('_menu-structure'); ?>
                <?= $this->render('_menu-action'); ?>
            </div>
            <div class="col-md-10">
                <div class="content">
                    <nav aria-label="breadcrumb">
                        <?php echo Breadcrumbs::widget([
                            'encodeLabels' => false,
                            'homeLink' => false,
                            'itemTemplate' =>"<li class='breadcrumb-item'>{link}</li>\n",
                            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </nav>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>