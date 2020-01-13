<?php

namespace app\modules\contact\controllers;

use Yii;
use yii\web\Controller;

class ModalController extends Controller
{
    
    public function actionSearch() {
        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\web\YiiAsset' => false,
        ];
        return $this->renderAjax('_modal-search');
    }

}