<?php

use yii\helpers\Html;
use app\components\grid\ExtraGridView;
use app\modules\admin\models\Structure;

$part = Structure::findOne(Yii::$app->request->get('id'));
$this->params['breadcrumbs'][] = $part->name;
$this->title = $part->name . ' - Список';
?>
<div class="faq-index">

    <p class="text-right"><?= Html::a('Добавить', ['create', 'structure_id' => Yii::$app->request->get('id')], ['class' => 'btn btn-success']) ?></p>

    <?= ExtraGridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $index, $widget, $grid){
            return !$model->is_publish ? ['class' => 'not-published'] : [];
        },
        'layout' => '{items}{summary}{pager}',
        'columns' => [
//            [
//                'class' => 'twixoff\sortablegrid\SortableColumn',
//                'header' => '<i class="fa fa-bars"></i>',
//                'content' => function() { return '<i class="fa fa-bars"></i>'; }
//            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'contentOptions' => ['width' => 150],
                'value' => function($model) {
                    return $model->getPhoto() ? Html::img($model->getPhoto('big'), ['class' => 'img-responsive']) : null;
                },
            ],
            'title',
            [
                'class' => 'app\components\grid\GroupActionColumn',
                'template' => '{publish} {update} {delete}',
            ],            
        ],
    ]); ?>

</div>
