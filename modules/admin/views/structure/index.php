<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use twixoff\sortablegrid\SortableGridView;

$this->title = 'Структура сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="structure-index">

    <p class="text-right"><?= Html::a('Добавить элемент', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php Pjax::begin(['id' => 'structure-grid']) ?>
        <?= SortableGridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-striped- table-bordered table-hover'],
            'layout' => '{items}{summary}{pager}',
            'rowOptions' => function ($model, $index, $widget, $grid){
                return in_array($model->type_id, [60, 65]) ? ['class' => 'bg-success']
                    : ( $model->isLock ? ['class' => 'bg-danger'] :
                        (!$model->is_publish ? ['class' => 'bg-warning'] : []) );
            },
            'columns' => [
                [
                    'class' => 'twixoff\sortablegrid\SortableColumn',
                    'header' => '<i class="fa fa-bars"></i>',
                    'content' => function() { return '<i class="fa fa-bars"></i>'; }
                ],
                [
                    'header' => 'Тип',
                    'format' => 'html',
                    'headerOptions' => ['style' => 'width: 15px;'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'value' => function($model) {
                        $types = \Yii::$app->params['structureTypes'][$model->type_id];
                        return "<i class='fas " . ( $types['icon'] ? $types['icon'] : "fa-file" ) . "' title='" . $types['title'] . "'></i> ";
                    }
                ],
                [
                    'header' => 'Элемент',
                    'format' => 'html',
                    'value' => function($model) {
                        $level = $model->getLevel();
                        $margin = $level > 1 ? 10 * ($level-1) : 0;
                        return "<div style='margin-left: ".$margin."px;'> "
                            . $model->name . ' (<span style="color: #999;">/' . $model->slug . '</span>)</div>';
                    }
                ],
                [
                    'class' => 'app\components\grid\GroupActionColumn',
                    'contentOptions' => ['style' => 'width: 120px;'],
                    'template' => '{lock} {publish} {update} {delete}',
                    'buttons' => [
                        'lock' => function ($url, $model, $key) {
                            if($model->type_id !== 1) {
                                $options = [
                                    'title' => 'backend', 'Lock/Unlock',
                                    'class' => 'btn btn-xs btn-default',
                                    'aria-label' => 'backend', 'Lock/Unlock',
                                    'data-pjax' => '0',
                                ];
                                return $model->isLock
                                        ? Html::a('<span class="fa fa-toggle-off text-danger"></span>', $url, $options)
                                        : Html::a('<span class="fa fa-toggle-on text-success"></span>', $url, $options);
                            }
                        }
                    ],                
                ],
            ],
        ]); ?>
    <?php Pjax::end() ?>
</div>