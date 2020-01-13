<?php
use yii\helpers\Url;
use yii\helpers\Html;
use twixoff\sortablegrid\SortableGridView;

$this->title = 'Слайдер';
$this->params['breadcrumbs'][] = $this->title;
$category = Yii::$app->request->get('category', 'main');
?>
<div class="gallery-index">

    <?php if($category != 'new') : ?>
        <p class="text-right">
            <?= Html::a('Добавить слайд', ['create', 'category' => $category], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items} {summary} {pager}',
        'rowOptions' => function ($model, $index, $widget, $grid){
            return !$model->is_publish ? ['class' => 'not-published'] : [];
        },        
        'columns' => [
            [
                'class' => 'twixoff\sortablegrid\SortableColumn',
                'header' => '<i class="fa fa-bars"></i>',
                'content' => function() { return '<i class="fa fa-bars"></i>'; }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'contentOptions' => ['width' => 150],
                'value' => function($model) {
                    return $model->getPhoto() ? Html::img($model->getPhoto('big'), ['class' => 'img-responsive']) : null; 
                },
            ],
            'title',
            'link',
            [
                'class' => 'app\components\grid\GroupActionColumn',
                'template' =>
                    $category == 'new'
                        ? '{update}'
                        : '{publish} {update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        return ['update', 'id' => $model->id, 'category' => $model->category];
                    }

                    return Url::to([$action, 'id' => $key]);
                }
            ]
        ]
    ]); ?>

</div>
