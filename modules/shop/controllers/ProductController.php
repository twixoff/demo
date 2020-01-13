<?php

namespace app\modules\shop\controllers;

use Yii;
use yii\web\Response;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Product;
use app\components\actions\PublishAction;
use app\modules\shop\models\ProductImages;
use twixoff\sortablegrid\SortableGridAction;
use app\modules\shop\models\ProductAttribute;

class ProductController extends Backend
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Product::class
            ],
            'publish' => [
                'class' => PublishAction::class,
                'modelName' => Product::class
            ]
        ];
    }


    public function actionIndex($id) {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['serie_id' => $id])->orderBy(['sort' => SORT_ASC]),
            'pagination' => false
        ]);

        return $this->render('/backend/product/index', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionCreate() {
        $model = new Product();
        $model->serie_id = Yii::$app->request->get('serie_id');
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->serie_id]);
        } else {
            return $this->render('/backend/product/create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->serie_id]);
        } else {
            return $this->render('/backend/product/update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'id' => $model->serie_id]);
    }


    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
