<?php

namespace app\modules\infoblocks\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\Backend;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\Structure;
use app\components\actions\PublishAction;
use twixoff\sortablegrid\SortableGridAction;
use app\modules\infoblocks\models\InfoBlocks;
use app\modules\infoblocks\models\InfoBlockCard;
use app\modules\infoblocks\models\InfoBlockGallery;


/**
 * BackendController implements the CRUD actions for InfoBlocks model.
 */
class BackendController extends Backend
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'card-delete' => ['post'],
                    'photo-delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            // crud actions
                            'view', 'create', 'update', 'delete',
                            // gallery info cards actions
                            'card-create', 'card-update', 'card-delete', 'card-sort',
                            // gallery info block actions
                            'photo-upload', 'photo-delete', 'gallery-sort',
                            // special actions
                            'sort', 'publish', 'lock'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::class,
                'modelName' => InfoBlocks::class
            ],
            'gallery-sort' => [
                'class' => SortableGridAction::class,
                'modelName' => InfoBlockGallery::class
            ],
            'card-sort' => [
                'class' => SortableGridAction::class,
                'modelName' => InfoBlockCard::class
            ],
            'publish' => [
                'class' => PublishAction::class,
                'modelName' => InfoBlocks::class
            ],
        ];
    }    

    /**
     * Lists all InfoBlocks models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $showAll = Yii::$app->request->get('showAll', false);
        $dataProvider = new ActiveDataProvider([
            'query' => InfoBlocks::find()
                        ->where(['structure_id' => $id])
                        ->orderBy(['sort' => SORT_ASC]),
            'pagination' => $showAll ? false : [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new InfoBlocks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoBlocks();
        $model->structure_id = Yii::$app->request->get('structure_id');
        $model->type = Yii::$app->request->get('type');
        $model->is_publish = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->type == 'gallery') {
                return $this->redirect(['update', 'id' => $model->id]);
            }

            $part = Structure::findOne($model->structure_id);
            if($part->type_id !== 2) {
                return $this->redirect($part->getAdminUrl());
            }
            return $this->redirect(['index', 'id' => $model->structure_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing InfoBlocks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->type == 'cards') {
            $dataProviderCards = new ActiveDataProvider([
                'query' => InfoBlockCard::find()->where(['block_id' => $id])->orderBy('sort')
            ]);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $part = Structure::findOne($model->structure_id);
            if($part->type_id !== 2) {
                return $this->redirect($part->getAdminUrl());
            }
            return $this->redirect(['index', 'id' => $model->structure_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataProviderCards' => isset($dataProviderCards) ? $dataProviderCards : null
            ]);
        }
    }

    /**
     * Deletes an existing InfoBlocks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        $part = Structure::findOne($model->structure_id);
        if($part->type_id !== 2) {
            return $this->redirect($part->getAdminUrl());
        }
        return $this->redirect(['index', 'id' => $model->structure_id]);
    }

    /**
     * Finds the InfoBlocks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoBlocks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoBlocks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    // upload image for gallery info block 
    public function actionPhotoUpload() {
        
        $model = new InfoBlockGallery();
 
        if ($model->load(Yii::$app->request->post())) {
            foreach(\yii\web\UploadedFile::getInstances($model, 'image') as $k => $image) {
                \Yii::$app->session->setFlash('multipleIndex', $k);
                $modelImages = new InfoBlockGallery();
                $modelImages->block_id = $model->block_id;
                $modelImages->save();
            }
            
            return $this->redirect(Yii::$app->getRequest()->getReferrer());
        } else {
            print_r($model->getErrors());
            exit();
            return $this->redirect(Yii::$app->getRequest()->getReferrer());
//            return $this->refresh();
            // or redirect to refferer
        }        
    }

    
    
    // upload image for gallery info block 
    public function actionPhotoDelete($id) {
        $model = InfoBlockGallery::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->actionUpdate($model->block_id);
    }


    /*------------- Info block Cards ---------------------------------*/
    public function actionCardCreate()
    {
        $model = new InfoBlockCard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->block_id]);
        }
    }


    public function actionCardUpdate($id)
    {
        $model = InfoBlockCard::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->block_id]);
        }

        return $this->renderAjax('types/_card-view', [
            'model' => $model
        ]);
    }
    
    
    public function actionCardDelete($id) {
        $model = InfoBlockCard::findOne($id);
        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->delete();

        return $this->redirect(['update', 'id' => $model->block_id]);
    }
}
