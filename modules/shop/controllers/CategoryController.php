<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Category;
use twixoff\sortablegrid\SortableGridAction;

class CategoryController extends Backend
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Category::class
            ],
        ];
    }


    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->orderBy(['sort' => SORT_ASC]),
            'pagination' => ['pageSize' => 10]
        ]);


        return $this->render('/backend/category/index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate() {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/backend/category/create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/backend/category/update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
