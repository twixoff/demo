<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\config\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">
    <p>
        <?php #= Html::a('Добавить переменную', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{summary}{pager}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'label',
            [
                'attribute' => 'value',
                'value' => function($model) {
                    if($model->type == 'dropdown') {
                        $values = yii\helpers\Json::decode($model->default);
                        return $values[$model->value];
                    } elseif(in_array($model->type, ['fulltext', 'code-css', 'code-js'])) {
                        return '<i class="text-success">- Войдите в режим редактирования для просмотра содержимого -</i>';
                    } else 
                        return $model->value;
                },
                'format' => 'html',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group">{update}</div>',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-default'
                        ];
                        return Html::a('<span class="fas fa-pen"></span>',
                                [$url, 'category' => Yii::$app->getRequest()->get('category')],
                                $options);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
