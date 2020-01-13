<?php
use app\components\grid\ExtraGridView;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
        
    <?php #echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ExtraGridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Клиент',
                'value' => function($model) {
                    $value = "";
                    $value .= $model->company ? $model->company.'<br>' : '';
                    $value .= $model->name ? $model->name.'<br>' : '';
                    $value .= $model->phone ? $model->phone.'<br>' : '';
                    $value .= $model->phone_local ? $model->phone_local.'<br>' : '';
                    $value .= $model->email ? $model->email.'<br>' : '';
                    $value .= $model->comment ? 'Комментарий:<br><span style="color: #aaa;">'.nl2br($model->comment).'</span><br/>' : '';
                    $value .= $model->attachment ? '<a href="/uploads/order-files/'.$model->attachment.'" target="_blank">Файл заявки</a>' : '';

                    return $value;
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Состав заказа',
                'value' => function($model) {
                    $items = "";
                    if(count($model->items)) {
                        foreach($model->items as $item) {
                            $items .= $item['title'];
                            $items .= ' - '. number_format($item['price'], 0, '', ' ').'р.';
                            $items .= ' ('.$item['dimension'].' x '.$item['count'].')<br>';
    //                        $items .= $item['price'] * $item['count'];
                        }
                        $items .= '<br> Итого: ' . number_format($model->total_sum, 0, '', ' ').'р.';
                    }
                    return $items;
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'd_create',
                'contentOptions' => ['style' => 'width: 100px;']

            ],
            [
                'class' => 'app\components\grid\GroupActionColumn',
                'contentOptions' => ['style' => 'width: 30px; text-align: center;'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>
