<?php 
use app\modules\admin\models\Structure;
use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;
?>

<?php
$catalog = Structure::findOne(21);
$products = new ActiveDataProvider([
    'query' => Product::find()->where(['is_publish' => 1, 'structure_id' => $catalog->id])
        ->orderBy(['sort' => SORT_ASC]),
    'pagination' => [
        'pageSize' => 8,
        'route' => '/shop/index',
        'params' => ['parentId' => $catalog->id]
    ],
]);
?>

<div class="container">
    <div class="box-heading">
        <h3><?= $catalog->title ?></h3>
    </div>

    <?= ListView::widget([
        'dataProvider' => $products,
        'options' => ['class' => 'product-list row'],
        'layout' => '{items}{pager}',
        'itemView' => '@app/modules/shop/views/frontend/_item',         
        'itemOptions' => ['tag' => false],
        'emptyText' => '',
        'pager' => [
            'class' => ScrollPager::className(),
            'container' => '.product-list',
            'item' => '.col-lg-3.col-md-3.col-sm-3.col-xs-12',
            'triggerText' => 'Показать ещё',
            'triggerTemplate' => '<div class="text-center"><button type="button" class="btn btn-primary btn-squared load-more">{text}</button></div>',
            'enabledExtensions' => [
                ScrollPager::EXTENSION_TRIGGER, 
                ScrollPager::EXTENSION_SPINNER, 
                ScrollPager::EXTENSION_PAGING, 
            ]
        ]
    ]); ?>
</div>