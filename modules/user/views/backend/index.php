<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    
    <?php if (\Yii::$app->user->can('userCreate')) : ?>
        <p class="text-right"><?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{summary}{pager}',
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
             'email',
//             [
//                 'header' => 'Роль',
//                 'value' => 'roleName',
//             ],
//             'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'app\components\grid\GroupActionColumn',
                'contentOptions' => ['style' => 'width: 100px;'],
                'template' => '<div class="btn-group">{update}{delete}</div>',                
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' => 'btn btn-xs btn-default'
                        ];
                        return Html::a('<span class="fas fa-pen"></span>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        if (\Yii::$app->user->can('userDelete')) {
                            $options = [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                                'class' => 'btn btn-xs btn-default'
                            ];
                            return Html::a('<span class="fas fa-trash"></span>', $url, $options);
                        }
                    }
                ],
            ],
        ],
    ]); ?>

</div>
