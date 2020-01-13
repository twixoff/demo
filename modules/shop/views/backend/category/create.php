<?php
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление категории';
$this->title = 'Категории - Добавление категории';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>