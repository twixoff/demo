<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\Type;
use yii\web\NotFoundHttpException;
use twixoff\sortablegrid\SortableGridAction;


class TypeController extends Backend
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Type::class
            ],
        ];
    }


    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Type::find()->orderBy(['sort' => SORT_ASC]),
            'pagination' => ['pageSize' => 10]
        ]);


        return $this->render('/backend/type/index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate() {
        $model = new Type();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/backend/type/create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('/backend/type/update', [
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
        if (($model = Type::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
