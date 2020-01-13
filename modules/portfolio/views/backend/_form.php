<?php
use yii\bootstrap\Tabs;
?>

<?= Tabs::widget([
    'options' => [
        'class' => 'content-tabs'
    ],
    'items' => [[
        'options' => ['id' => 'common'],
        'label' => 'Описание',
        'content' => $this->render('_form-common', ['model' => $model]),
        'active' => true
    ], [
        'options' => ['id' => 'gallery'],
        'label' => 'Галерея',
        'content' => $this->render('_form-gallery', ['model' => $model]),
    ]]
]) ?>


<?php $this->registerJs("var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href=\"#' + url.split('#')[1] + '\"]').tab('show');
} "); ?>

<style>
    .tab-pane {
        padding: 10px 0 0 0;
    }
</style>