<?php

use app\modules\admin\models\Structure;
$part = Structure::findOne(Yii::$app->request->get('structure_id'));

if($part->parent) {
    $this->params['breadcrumbs'][] = ['label' => $part->parent->name, 'url' => $part->parent->getAdminUrl()];
}
$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['index', 'id' => $part->id]];
$this->params['breadcrumbs'][] = 'Добавление';
$this->title = $part->name . ' - Добавление';

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>