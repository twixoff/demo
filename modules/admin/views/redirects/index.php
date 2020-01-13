<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Таблица редиректов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirects-index">

    <p class="text-right">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{summary}{pager}',
        'tableOptions' => ['class' => 'table table-bordered'],        
        'rowOptions' => function ($model, $index, $widget, $grid){
            return !$model->is_publish ? ['class' => 'bg-warning'] : [];
        },        
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-center', 'width' => '100px'],
                'contentOptions' => ['class' => 'text-center'],
            ],

            'from',
            'to',

            [
                'class' => 'app\components\grid\GroupActionColumn',
                'template' => '{publish} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
