<?php
$this->title = 'Добавить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Структура сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="structure-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
