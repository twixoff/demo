<?php

use yii\helpers\Html;
use app\components\grid\ExtraGridView;

$this->params['breadcrumbs'][] = ['label' => 'Фабрики'];
$this->title = 'Фабрики - Список';

?>

<div class="form-group clearfix">
    <?= Html::a('Добавить фабрику', ['create', 'structure_id' => Yii::$app->request->get('id')], ['class' => 'btn btn-success pull-right']) ?>
</div>

<?= ExtraGridView::widget([
    'dataProvider' => $dataProvider,
    'enableSort' => true,
    'columns' => [
        [
            'class' => 'twixoff\sortablegrid\SortableColumn',
            'header' => '<i class="fa fa-bars"></i>',
            'content' => function() { return '<i class="fa fa-bars"></i>'; }
        ],
        [
            'attribute' => 'logo',
            'format' => 'html',
            'contentOptions' => ['width' => 100],
            'value' => function($model) {
                return $model->logo ? Html::img($model->getPhoto('big', 'logo'), ['class' => 'img-responsive']) : null;
            },
        ],
        [
            'attribute' => 'logo',
            'format' => 'html',
            'contentOptions' => ['width' => 100],
            'value' => function($model) {
                return $model->logo_menu ? Html::img($model->getPhoto('big', 'logo_menu'), ['class' => 'img-responsive']) : null;
            },
        ],
        'title',
        [
            'class' => 'app\components\grid\GroupActionColumn',
            'contentOptions' => ['style' => 'width: 100px; text-align: right;'],
            'template' => '{publish} {update} {delete}',
        ],
    ],
]); ?>