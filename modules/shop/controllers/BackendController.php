<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use app\components\actions\PublishAction;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\shop\models\Types;
use app\modules\shop\models\Products;

/**
 * BackendController implements the CRUD actions for Lessons model.
 */
class BackendController extends Backend
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'type-delete' => ['post'],
//                    'category-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            // products actions
                            'products', 'product-create', 'product-update', 'product-delete', 'product-publish', 'product-lock',
                            // orders actions
                            'orders', 'order-update', 'order-delete',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }    

    public function actions()
    {
        return [
//            'sort' => [
//                'class' => SortableGridAction::className(),
//                'modelName' => Lessons::className()
//            ],            
//            'type-publish' => [
//                'class' => PublishAction::className(),
//                'modelName' => Types::className()
//            ],
//            'product-publish' => [
//                'class' => PublishAction::className(),
//                'modelName' => Products::className()
//            ],
//            'product-lock' => [
//                'class' => PublishAction::className(),
//                'modelName' => Products::className(),
//                'attribute' => 'isLock'
//            ],
        ];
    }

    public function actionIndex($id) {
        return $this->redirect(['/admin/shop/serie/index/' . $id]);
    }


}
