<?php

use app\modules\admin\models\Structure;
$part = Structure::findOne($model->structure_id);

if($part->parent) {
    $this->params['breadcrumbs'][] = ['label' => $part->parent->name, 'url' => $part->parent->getAdminUrl()];
}
$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['index', 'id' => $part->id]];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование «' . $model->title . '»'];
$this->title = $part->name . ' - Редактирование';

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>