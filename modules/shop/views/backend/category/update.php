<?php
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование категории';
$this->title = 'Категории - Редактирование категории';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>