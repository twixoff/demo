<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => 'Union Light - Admin panel',
    'brandUrl' => ['/admin'],
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-light',
    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid'
    ]
]);

//    $items = [['label' => 'Сбросить кэш', 'url' => '/admin/default/flush-cache']];
$items = [];
if(Yii::$app->user->isGuest) {
    array_push($items, ['label' => 'Войти', 'url' => ['/login']]);
} else {
    array_push($items, [
        'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
        'url' => ['/logout'],
        'linkOptions' => ['data-method' => 'post']
    ]);
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
//    'options' => ['class' =>'nav-pills- float-right-'],
//    'encodeLabels' => false,
    'items' => $items,
]);
NavBar::end(); ?>