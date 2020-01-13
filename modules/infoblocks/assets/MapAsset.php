<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\infoblocks\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MapAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/infoblocks/assets/';
    public $js = [
        'infoblocks.map.js',
    ];
    public $depends = [
        'app\modules\admin\AdminAsset',
    ];
}
