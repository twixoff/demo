<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Fabric;
use twixoff\sortablegrid\SortableGridAction;

class FabricController extends Backend
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Fabric::class
            ],
        ];
    }


    public function actionIndex($id) {
        $dataProvider = new ActiveDataProvider([
            'query' => Fabric::find()->where(['structure_id' => $id])->orderBy(['sort' => SORT_ASC]),
            'pagination' => ['pageSize' => 10]
        ]);


        return $this->render('/backend/fabric/index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate() {
        $model = new Fabric();
        $model->structure_id = Yii::$app->request->get('structure_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->structure_id]);
        } else {
            return $this->render('/backend/fabric/create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->structure_id]);
        } else {
            return $this->render('/backend/fabric/update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'id' => $model->structure_id]);
    }


    protected function findModel($id)
    {
        if (($model = Fabric::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
