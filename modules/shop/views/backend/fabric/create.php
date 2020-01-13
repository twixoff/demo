<?php
$this->params['breadcrumbs'][] = ['label' => 'Фабрики', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление фабрики';
$this->title = 'Фабрики - Добавление фабрики';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>