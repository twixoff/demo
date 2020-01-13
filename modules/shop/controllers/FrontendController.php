<?php

namespace app\modules\shop\controllers;

use app\modules\config\models\Config;
use app\modules\shop\models\Product;
use Yii;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\Type;
use app\modules\shop\models\Serie;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Fabric;
use app\modules\shop\models\Category;
use app\modules\admin\models\Structure;

class FrontendController extends Controller
{

    public function actionIndex($parentId = null)
    {
        $parts = Structure::find()->where(['parent_id' => $parentId, 'is_publish' => 1])->orderBy(['sort' => SORT_ASC])->all();
        $partKeys = array_keys(ArrayHelper::map($parts, 'id', 'title'));
        $dataProvider = new ActiveDataProvider([
            'query' => Serie::find()->where(['structure_id' => $partKeys, 'is_publish' => 1])->orderBy('sort'),
            'pagination' => ['pageSize' => 9]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionList($parentId = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Type::find()->joinWith('series')
                ->where([
                    'shop_series.structure_id' => $parentId,
                    'shop_series.is_publish' => 1
                ])
                ->groupBy('shop_types.id')
                ->orderBy('shop_types.sort'),
            'pagination' => ['pageSize' => 3]
        ]);

        return $this->render('index-list', [
            'category_id' => $parentId,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionView($id = null)
    {
//        $orderPart = Structure::find()->where(['type_id' => 61])->one();
//        if($orderPart === null) {
//            throw new \yii\base\UserException('Страница оформления заказа не найдена.', 400);
//        }

        $model = Serie::findOne(['id' => $id, 'is_publish' => 1]);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }


    public function actionFabricIndex($parentId = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Fabric::find()->where(['is_publish' => 1])->orderBy('sort'),
            'pagination' => false
        ]);

        return $this->render('fabric-index', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionFabricView($id = null)
    {
        $model = Fabric::findOne(['id' => $id, 'is_publish' => 1]);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $sectionId = Yii::$app->getRequest()->get('section_id');
        if($sectionId) {
            $dataProvider = new ActiveDataProvider([
                'query' => Type::find()->joinWith('series')
                    ->where([
                        'shop_series.fabric_id' => $model->id,
                        'shop_series.structure_id' => $sectionId,
                        'shop_series.is_publish' => 1
                    ])
                    ->groupBy('shop_types.id')
                    ->orderBy('shop_types.sort'),
                'pagination' => ['pageSize' => 3]
            ]);
            $category = Structure::findOne($sectionId);
            return $this->render('fabric-category', [
                'model' => $model,
                'category' => $category,
                'dataProvider' => $dataProvider
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Serie::find()->where(['fabric_id' => $model->id, 'is_publish' => 1])
                ->orderBy(['structure_id' => SORT_ASC, 'sort' => SORT_ASC]),
            'pagination' => ['pageSize' => 9]
        ]);

        return $this->render('fabric-view', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionCategory($id)
    {
        $model = Category::findOne(['id' => $id, 'is_publish' => 1]);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $sectionId = Yii::$app->getRequest()->get('section_id');
        if($sectionId) {
//            $dataProvider = new ActiveDataProvider([
//                'query' => Type::find()->distinct('title')->joinWith('series')
//                    ->where([
//                        'shop_series.category_id' => $model->id,
//                        'shop_series.structure_id' => $sectionId,
//                        'shop_series.is_publish' => 1
//                    ])->orderBy('sort'),
//                //            'pagination' => ['pageSize' => 3]
//                'pagination' => false
//            ]);
            $dataProvider = new ActiveDataProvider([
                'query' => Type::find()->joinWith('series')
                    ->where([
                        'shop_series.category_id' => $model->id,
                        'shop_series.structure_id' => $sectionId,
                        'shop_series.is_publish' => 1
                    ])
                    ->groupBy('shop_types.id')
                    ->orderBy('shop_types.sort'),
                'pagination' => ['pageSize' => 3]
            ]);

            return $this->render('category-type', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Serie::find()->where(['category_id' => $model->id, 'is_publish' => 1])->orderBy('sort'),
            'pagination' => ['pageSize' => 9]
        ]);

        return $this->render('category-view', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionQuickOrder($id) {
        $model = new DynamicModel(['name', 'email', 'phone', 'product_id', 'count', 'message']);
        $model->addRule(['name', 'email', 'phone', 'product_id', 'count'], 'required');
        $model->addRule(['name', 'phone', 'message'], 'string');
        $model->addRule(['product_id', 'count'], 'integer');
        $model->addRule(['email'], 'email');
        $model->product_id = $id;

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $message = "";

            // find product
            $product  = Product::findOne($id);
            $message.= "<b>Продукт:</b> " . $product->title . " (".$model->count." шт.)<br>";

            if($model->name) $message.= "<b>Имя:</b> " . $model->name . "<br>";
            if($model->email) $message.= "<b>E-mail:</b> " . $model->email . "<br>";
            if($model->phone) $message.= "<b>Телефон:</b> " . $model->phone . "<br>";
            if($model->message) $message.= "<b>Сообщение:</b> " . nl2br($model->message);

            $emails = Config::get('site.email');
            Yii::$app->mailer->compose()
                ->setTo(explode(',', $emails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setReplyTo($model->email)
                ->setSubject('Заказ с сайта ['.\Yii::$app->getRequest()->getHostName().']')
                ->setHtmlBody($message)
                ->send();
            Yii::$app->session->setFlash('success', true);
        }

        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\web\YiiAsset' => false,
        ];
        return $this->renderAjax('_modal-quick-order', ['model' => $model]);
    }


}