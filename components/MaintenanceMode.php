<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\modules\config\models\Config;

class MaintenanceMode extends Component
{
    
    public function init() {
        $enabled = Config::get('site.close');
        $uri = Yii::$app->request->url;
        if($enabled && preg_match('/^\/(gii|debug|admin|login|logout)/i', $uri)===0) {
            Yii::$app->catchAll = ['main/default/cap'];
        }
    }
    
}