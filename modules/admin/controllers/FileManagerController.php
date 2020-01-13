<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Redirects;
use yii\data\ActiveDataProvider;
use app\components\Backend;
use yii\web\NotFoundHttpException;
use app\components\actions\PublishAction;

/**
 * RedirectsController implements the CRUD actions for Redirects model.
 */
class FileManagerController extends Backend
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
