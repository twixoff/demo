<?php
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование типа';
$this->title = 'Типы - Редактирование типа';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>