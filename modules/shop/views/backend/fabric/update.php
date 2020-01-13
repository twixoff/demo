<?php
$this->params['breadcrumbs'][] = ['label' => 'Фабрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование фабрики';
$this->title = 'Фабрики - Редактирование фабрики';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>