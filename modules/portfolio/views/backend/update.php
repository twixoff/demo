<?php

use app\modules\admin\models\Structure;

$part = Structure::findOne($model->structure_id);

$this->title = $part->name . '- Редактирование ';
$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['index', 'id' => $part->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title];
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>