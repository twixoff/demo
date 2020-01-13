<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Backend;
use yii\filters\AccessControl;
use app\modules\admin\models\Structure;

class DefaultController extends Backend
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'no-editable', 'set-value', 'flush-cache'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->renderContent("<p>Добро пожаловать в систему управления веб-сайтом.</p><p>Выберите необходимый раздел для начала работы.</p>");
    }
    
    public function actionNoEditable($id = null)
    {
        $part = Structure::findOne($id);
        
        return $this->renderContent("<div class='alert alert-info'>"
                . "<span class='fa-stack'>
                      <i class='fa fa-circle fa-stack-2x'></i>
                      <i class='fa fa-info fa-stack-1x fa-inverse'></i>
                </span> Страница «<b>".$part->name."</b>» не предназначена для редактирования.</div>");
    }
    
    
    public function actionSetValue() {
        $key = Yii::$app->request->post('id');
        $value = Yii::$app->request->post('value');
        Yii::$app->session->set($key, $value);
    }


    public function actionFlushCache()
    {
        Yii::$app->cache->flush();
        return $this->redirect(Yii::$app->getRequest()->getReferrer());
    }


}
