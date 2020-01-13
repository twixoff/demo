<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\shop\models\Type;
use app\modules\shop\models\Fabric;
use app\modules\shop\models\Category;
use app\components\grid\ExtraGridView;
use app\modules\admin\models\Structure;

$part = Structure::findOne(Yii::$app->request->get('id'));
if($part->parent) {
    $this->params['breadcrumbs'][] = ['label' => $part->parent->name, 'url' => $part->parent->getAdminUrl()];
}
$this->params['breadcrumbs'][] = $part->name;

$this->title = $part->name . ' - Список';

?>

<div class="form-group clearfix">
    <?= Html::a('<i class="fas fa-plus"></i> Добавить серию', ['create', 'structure_id' => Yii::$app->request->get('id')], ['class' => 'btn btn-success pull-right']) ?>
</div>

<?= ExtraGridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
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
            'attribute' => 'category_id',
            'value' => function($model) {
                $category = $model->category;
                return $category ? $category->title : null;
            },
            'filter' => ArrayHelper::map(Category::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title')
        ],
        [
            'attribute' => 'type_id',
            'value' => function($model) {
                $type = $model->type;
                return $type ? $type->title : null;
            },
            'filter' => ArrayHelper::map(Type::find()->orderBy(['sort' => SORT_ASC])->all(), 'id', 'title')
        ],
        [
            'attribute' => 'fabric_id',
            'value' => function($model) {
                $fabric = $model->fabric;
                return $fabric ? $fabric->title : null;
            },
            'filter' => ArrayHelper::map(Fabric::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title')
        ],
        [
            'attribute' => 'countProducts',
            'label' => 'Кол-во товаров',
            'value' => function($model) {
                return $model->countProducts
                    . '<br><br><a href="/admin/shop/product/index/'.$model->id.'" class="btn btn-xs btn-default">смотреть список</a>';
            },
            'contentOptions' => ['class' => 'text-center'],
            'format' => 'raw'
        ],
//            'price',
        [
            'class' => 'app\components\grid\GroupActionColumn',
            'contentOptions' => ['style' => 'width: 100px; text-align: right;'],
            'template' => '{publish} {update} {delete}',
    //            'urlCreator' => function($action, $model, $key, $index) {
    //                $params = is_array($key) ? $key : ['id' => (string) $key];
    //                $params[0] = 'backend/task-' . $action;
    //
    //                return Url::toRoute($params);
    //            },
        ],
    ],
]); ?>