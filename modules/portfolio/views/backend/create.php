<?php

use app\modules\admin\models\Structure;

$part = Structure::findOne(Yii::$app->request->get('structure_id'));

$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['index', 'id' => $part->id]];
$this->params['breadcrumbs'][] = 'Добавление';
$this->title = $part->name . ' - Добавление';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>