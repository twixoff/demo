<?php

namespace app\components;

use skeeks\yii2\assetsAuto\AssetsAutoCompressComponent;
use yii\base\Event;
use yii\web\View;

class CustomAssetsAutoCompressComponent extends AssetsAutoCompressComponent
{
    
    public $enabled = true;

    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application)
        {
            $app->view->on(View::EVENT_END_PAGE, function(Event $e) use ($app)
            {
                if(strpos(\Yii::$app->request->getUrl(), "/admin/") === 0) {
                    $this->enabled = false;
                }
            });
        }
        return parent::bootstrap($app);
    }

}