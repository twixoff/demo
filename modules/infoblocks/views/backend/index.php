<?php

use yii\helpers\Url;
use twixoff\sortablegrid\SortableGridView;
use app\modules\admin\models\Structure;

$part = Structure::findOne(Yii::$app->request->get('id'));
$this->params['breadcrumbs'][] = $part->name;
$this->title = $part->name . ' - Список';
?>
<div class="info-blocks-index">

    <div class="form-group text-right">
        <div class="btn-group dropright">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Добавить блок <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach($this->context->module->getTypes() as $type=>$name) : ?>
                    <li><a href="<?= Url::to(['create', 'structure_id' => Yii::$app->request->get('id'), 'type' => $type]) ?>"><?= $name ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
    <?php $showAll = Yii::$app->request->get('showAll', false);
    $showAllLink = $showAll
            ? '<a href="' . Url::to(['index', 'id' => $part->id]) . '" class="pull-right">Показывать постранично</a>'
            : '<a href="' . Url::to(['index', 'id' => $part->id, 'showAll' => true]) . '" class="pull-right">Показать все</a>' ?>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $index, $widget, $grid){
            return !$model->is_publish ? ['class' => 'not-published'] : [];
        },
        'layout' => '{items} '. $showAllLink .'<div class="clearfix"></div> {summary}{pager}',
        'columns' => [
            [
                'class' => 'twixoff\sortablegrid\SortableColumn',
                'header' => '<i class="fa fa-bars"></i>',
                'content' => function() { return '<i class="fa fa-bars"></i>'; }
            ],
            'title',
            [
                'attribute' => 'type',
                'value' => function($model, $key, $index) {
                    return $this->context->module->getTypeName($model->type);
                }
            ],

            [
                'class' => 'app\components\grid\GroupActionColumn',
                'template' => '{publish} {update} {delete}',
            ],
        ],
    ]); ?>

</div>