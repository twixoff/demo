<?php

use yii\helpers\Html;
use app\modules\shop\models\Serie;
use app\components\grid\ExtraGridView;
use app\modules\admin\models\Structure;

$serieId = Yii::$app->request->get('id');
$serie = Serie::findOne($serieId);
$part = Structure::findOne($serie->structure_id);

if($part->parent) {
    $this->params['breadcrumbs'][] = ['label' => $part->parent->name, 'url' => $part->parent->getAdminUrl()];
}
$this->params['breadcrumbs'][] = ['label' => $part->name, 'url' => ['/admin/shop/serie/index/'.$part->id]];
$this->params['breadcrumbs'][] = ['label' => 'Серия «'.$serie->title.'»'];
$this->title = $part->name . ' - Список';

?>

<div class="form-group clearfix">
    <?= Html::a('Добавить товар', ['create', 'serie_id' => $serieId], ['class' => 'btn btn-success pull-right']) ?>
</div>

<?= ExtraGridView::widget([
    'dataProvider' => $dataProvider,
    'rowOptions' => function ($model, $index, $widget, $grid){
        return !$model->is_publish ? ['class' => 'bg-warning'] : [];
    },
    'enableSort' => true,
    'columns' => [
        [
            'class' => 'twixoff\sortablegrid\SortableColumn',
            'header' => '<i class="fa fa-bars"></i>',
            'content' => function() { return '<i class="fa fa-bars"></i>'; }
        ],
        'title:html',
        'price',
        [
            'class' => 'app\components\grid\GroupActionColumn',
            'contentOptions' => ['style' => 'width: 100px; text-align: right;'],
            'template' => '{publish} {update} {delete}',
        ],
    ],
]); ?>