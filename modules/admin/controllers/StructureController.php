<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Structure;
use yii\data\ArrayDataProvider;
use app\components\Backend;
use yii\web\NotFoundHttpException;
use twixoff\sortablegrid\SortableGridAction;

/**
 * StructureController implements the CRUD actions for Structure model.
 */
class StructureController extends Backend
{
    
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Structure::className()
            ],
        ];
    }    

    /**
     * Lists all Structure models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => Structure::find(),
//        ]);
        $dataProvider = new ArrayDataProvider([
            'allModels' => Structure::getTreeFloat(null, true, "")
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Structure model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Structure model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Structure();
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $page = new Pages();
//            $page->structure_id = $model->id;
//            $page->title = $model->name;
//            $page->save();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Structure model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//        print_r(Yii::$app->request->post());exit();
            // TODO:: update page title
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Structure model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//        if (!\Yii::$app->user->can('userCreate')) {
//            throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perfom this action.'));
//        }

        $model = $this->findModel($id);
        if($model->type_id != 1) {
            $model->delete();
        }
        
        return $this->redirect(['index']);
    }

    public function actionPublish($id) {

        $model = $this->findModel($id);
        $model->is_publish = (int)!$model->is_publish;
        if($model->update(false)) {
            return $this->redirect(['index']);
        } else {
            echo $model->id;
        }
    }

    public function actionLock($id) {

        $model = $this->findModel($id);
        $model->isLock = (int)!$model->isLock;
        if($model->update(false)) {
            return $this->redirect(['index']);
        } else {
            echo $model->id;
        }
    }
    
    /**
     * Finds the Structure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Structure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Structure::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
