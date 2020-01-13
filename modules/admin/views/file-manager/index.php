<?php
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;
?>

<?= ElFinder::widget([
    'language'         => 'ru',
    'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
//    'filter'           => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    'containerOptions' => ['style' => 'height: 600px;'],
    'callbackFunction' => new JsExpression('function(file, id){}') // id - id виджета
]); ?>