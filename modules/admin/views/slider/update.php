<?php
$this->title = 'Обновить фото: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>