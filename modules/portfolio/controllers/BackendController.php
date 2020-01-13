<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Portfolio;
use yii\data\ActiveDataProvider;
use app\components\Backend;
use yii\web\NotFoundHttpException;
use twixoff\sortablegrid\SortableGridAction;
use app\components\actions\PublishAction;
use app\modules\portfolio\models\PortfolioImages;

/**
 * BackendController implements the CRUD actions for reviews model.
 */
class BackendController extends Backend
{
    
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => Portfolio::class
            ],
            'gallery-sort' => [
                'class' => SortableGridAction::class,
                'modelName' => PortfolioImages::class
            ],
            'publish' => [
                'class' => PublishAction::class,
                'modelName' => Portfolio::class
            ],
        ];
    }      


    public function actionIndex($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Portfolio::find()->where(['structure_id' => $id])->orderBy(['sort' => SORT_ASC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Portfolio();
        $model->structure_id = Yii::$app->request->get('structure_id');
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id, '#' => 'gallery']);
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
            return $this->redirect(['index', 'id' => $model->structure_id]);
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

        return $this->redirect(['index', 'id' => $model ->structure_id]);
    }


    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // upload image for gallery info block 
    public function actionPhotoUpload() {

        $model = new PortfolioImages();

        if ($model->load(Yii::$app->request->post())) {
            foreach(\yii\web\UploadedFile::getInstances($model, 'image') as $k => $image) {
                \Yii::$app->session->setFlash('multipleIndex', $k);
                $modelImages = new PortfolioImages();
                $modelImages->portfolio_id = $model->portfolio_id;
                $modelImages->save();
            }
            return $this->redirect(['update', 'id' => $model->portfolio_id, '#' => 'gallery']);
//            return $this->redirect(Yii::$app->getRequest()->getReferrer());
        } else {
//            \yii\helpers\VarDumper::dump(Yii::$app->request->post(), 100, true);
//            print_r($model->getErrors());
//            exit();
            return $this->redirect(['update', 'id' => $model->portfolio_id, '#' => 'gallery']);
//            return $this->redirect(Yii::$app->getRequest()->getReferrer());
//            return $this->refresh();
            // or redirect to refferer
        }
    }


    // upload image for gallery info block 
    public function actionPhotoDelete($id) {
        $model = PortfolioImages::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->actionUpdate($model->portfolio_id);
    }


    // upload image for gallery info block 
    public function actionPhotoRotate($id) {
        $model = PortfolioImages::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->actionUpdate($model->portfolio_id);
    }

}