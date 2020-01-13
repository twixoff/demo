<?php

namespace app\modules\shop\controllers;

use Yii;
use app\components\Backend;
use yii\web\NotFoundHttpException;
use app\modules\shop\models\Serie;
use app\modules\shop\models\SerieImages;
use app\modules\shop\models\SerieSearch;
use app\components\actions\PublishAction;
use twixoff\sortablegrid\SortableGridAction;

class SerieController extends Backend
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Serie::class
            ],
            'gallery-sort' => [
                'class' => SortableGridAction::class,
                'modelName' => SerieImages::class
            ],
            'publish' => [
                'class' => PublishAction::class,
                'modelName' => Serie::class
            ]
        ];
    }


    public function actionIndex($id) {
        $searchModel = new SerieSearch();
        $searchModel->structure_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider = new ActiveDataProvider([
//            'query' => Serie::find()->where(['structure_id' => $id])->orderBy(['sort' => SORT_ASC]),
//            'pagination' => ['pageSize' => 10]
//        ]);


//        // infoblocks
//        $infoblocks = new ActiveDataProvider([
//            'query' => InfoBlocks::find()
//                ->where(['structure_id' => $id])
//                ->orderBy(['sort' => SORT_ASC]),
//        ]);

        return $this->render('/backend/serie/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate() {
        $model = new Serie();
        $model->structure_id = Yii::$app->request->get('structure_id');
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id, '#' => 'gallery']);
        } else {
            return $this->render('/backend/serie/create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->structure_id]);
        } else {
            return $this->render('/backend/serie/update', [
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
        if (($model = Serie::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // upload image for gallery info block
    public function actionPhotoUpload() {

        $model = new SerieImages();

        if ($model->load(Yii::$app->request->post())) {
            foreach(\yii\web\UploadedFile::getInstances($model, 'image') as $k => $image) {
                \Yii::$app->session->setFlash('multipleIndex', $k);
                $modelImages = new SerieImages();
                $modelImages->serie_id = $model->serie_id;
                $modelImages->save();
            }
            return $this->redirect(['update', 'id' => $model->serie_id, '#' => 'gallery']);
//            return $this->redirect(Yii::$app->getRequest()->getReferrer());
        } else {
//            \yii\helpers\VarDumper::dump(Yii::$app->request->post(), 100, true);
//            print_r($model->getErrors());
//            exit();
            return $this->redirect(['update', 'id' => $model->serie_id, '#' => 'gallery']);
//            return $this->redirect(Yii::$app->getRequest()->getReferrer());
//            return $this->refresh();
            // or redirect to refferer
        }
    }


    // upload image for gallery info block
    public function actionPhotoDelete($id) {
        $model = SerieImages::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->actionUpdate($model->serie_id);
    }


    // upload image for gallery info block
    public function actionPhotoRotate($id) {
        $model = SerieImages::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->actionUpdate($model->serie_id);
    }

}