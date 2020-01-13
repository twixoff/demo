<?php
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление типа';
$this->title = 'Типы - Добавление типа';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>