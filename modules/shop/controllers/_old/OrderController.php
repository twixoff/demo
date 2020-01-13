<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Order;
use app\modules\shop\models\ProductImages;

class OrderController extends Backend
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
                            // gallery actions
                            'photo-upload', 'photo-update', 'photo-delete', 'gallery-sort',
                            // special actions
                            'sort', 'publish'
                            ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    

    // orders CRUD
    public function actionIndex()
    {
//        $searchModel = new OrdersSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->orderBy(['d_create' => SORT_DESC])
        ]);

        return $this->render('/backend/order/index', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findOrder($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findOrder($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}