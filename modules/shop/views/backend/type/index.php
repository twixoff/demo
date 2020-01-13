<?php

use yii\helpers\Html;
use app\components\grid\ExtraGridView;

$this->params['breadcrumbs'][] = ['label' => 'Типы'];
$this->title = 'Типы - Список';

?>

<div class="form-group clearfix">
    <?= Html::a('Добавить тип', ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
        'title',
        [
            'class' => 'app\components\grid\GroupActionColumn',
            'contentOptions' => ['style' => 'width: 100px; text-align: right;'],
            'template' => '{publish} {update} {delete}',
        ],
    ],
]); ?>