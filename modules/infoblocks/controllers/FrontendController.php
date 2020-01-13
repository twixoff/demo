<?php

namespace app\modules\infoblocks\controllers;

use Yii;
use app\modules\infoblocks\models\InfoBlocks;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
//use yii\web\NotFoundHttpException;

class FrontendController extends Controller
{

    public function actionIndex($parentId)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => InfoBlocks::find()->where(['structure_id' => $parentId, 'is_publish' => 1])->orderBy('sort'),
//            'pagination' => ['pageSize' => 20],
            'pagination' => false
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    
    
//    public function actionView($id)
//    {
//        if (Yii::$app->request->isAjax) {
//            return $this->renderPartial('view', [
//                'model' => $this->findModel($id),
//            ]);
//        } else {
//            return $this->render('view', [
//                'model' => $this->findModel($id),
//            ]);
//        }
//    }
//    
//    
//    protected function findModel($id)
//    {
//        if (($model = News::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }    

}
