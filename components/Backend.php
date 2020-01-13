<?php

namespace app\components;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class Backend extends Controller {
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'photo-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            // crud actions
                            'view', 'create', 'update', 'delete',
                            // upload action
                            'photo-upload', 'photo-delete', 'photo-rotate', 'gallery-sort',
                            // special actions
                            'sort', 'publish', 'lock'
                            ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->module->setLayoutPath('@app/modules/admin/views/layouts');
        $this->module->layout = 'main';        
//        $this->setViewPath('@app/modules/admin/views');
        return true;
    }
    

}