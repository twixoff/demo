<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;

class CustomController extends Controller
{

    public function actionIndex($type) {
        return $this->render($type);
    }

}
