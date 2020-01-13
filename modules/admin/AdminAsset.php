<?php

namespace app\modules\admin;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';

    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/clipboard.min.js',
        'js/general.js',
    ];
    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
