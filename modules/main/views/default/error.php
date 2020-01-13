<?php

use yii\helpers\Html;

$this->title = $name;
?>

<div class="container py-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
