<?php

use app\modules\shop\models\Serie;
use app\modules\admin\models\Structure;

$serie = Serie::findOne($model->serie_id);
$part = Structure::findOne($serie->structure_id);
if($part->parent) {
    $this->params['breadcrumbs'][] = ['label' => $part->parent->name, 'url' => $part->parent->getAdminUrl()];
}
$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['/admin/shop/serie/index/'.$part->id]];
$this->params['breadcrumbs'][] = ['label' => 'Серия «'.$serie->title.'»', 'url' => ['/admin/shop/product/index/'.$serie->id]];
$this->params['breadcrumbs'][] = 'Редактирование товара';
$this->title = $part->name . ' - Редактирование товара';

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>