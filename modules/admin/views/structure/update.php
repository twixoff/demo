<?php
$this->title = 'Обновление ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Структура сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="structure-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
