<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Structure;
use app\modules\portfolio\models\Portfolio;

class FrontendController extends Controller
{
    
    public function actionIndex($parentId = null)
    {
        $items = [];
        $childrens = Structure::find()
            ->where(['parent_id' => $parentId, 'type_id' => 20, 'is_publish' => 1, 'isLock' => 0])->orderBy('sort')->all();
        if($childrens !== null) {
            foreach($childrens as $part) {
                $items[$part->id]['part'] = $part;
                $items[$part->id]['items'] = Portfolio::find()
                    ->where(['structure_id' => $part->id, 'is_publish' => 1])
                    ->orderBy(['sort' => SORT_ASC])->all();
            }
        } else {
            // TODO:: add part
            $items[$parentId]['items'] = Portfolio::find()
                ->where(['structure_id' => $parentId, 'is_publish' => 1])
                ->orderBy(['sort' => SORT_ASC])->all();
        }
//        $dataProvider = new ActiveDataProvider([
//            'query' => Portfolio::find()
//                ->where(['structure_id' => $parentId, 'is_publish' => 1])
//                ->orderBy(['id' => SORT_DESC]),
//            'pagination' => [
//                'pageSize' => 1,
//            ]
//        ]);
                
        return $this->render('index', [
            'items' => $items
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}