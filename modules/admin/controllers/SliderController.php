<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Slider;
use yii\web\NotFoundHttpException;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use app\components\actions\PublishAction;
use twixoff\sortablegrid\SortableGridAction;

class SliderController extends Backend
{
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Slider::class,
            ],
            'publish' => [
                'class' => PublishAction::class,
                'modelName' => Slider::class
            ],            
        ];
    }    


    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Slider::find()->where(['category' => Yii::$app->request->get('category', 'main')])
                    ->orderBy('sort')
            ]),
        ]);
    }


    public function actionCreate()
    {
        $model = new Slider();
        $model->category = Yii::$app->request->get('category', 'main');
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $model->category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $model->category]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'category' => $model->category]);
    }


    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
