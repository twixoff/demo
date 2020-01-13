<?php

use yii\helpers\Html;

\app\assets\FontAwesomeAsset::register($this);
\app\modules\user\LoginAsset::register($this);
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
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body class="login-page">
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
