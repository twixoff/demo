<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/static/';
    public $baseUrl = '@web/static/';
    public $css = [
        'bootstrap/css/bootstrap.min.css',
        'js/owl.carousel/assets/owl.carousel.min.css',
        'css/animate.css',
        'css/style.css',
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'js/owl.carousel/owl.carousel.min.js',
        'js/jquery.scrollTo.min.js',
        'js/jquery.animateNumber.min.js',
        'js/wow.min.js',
        'js/general.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}