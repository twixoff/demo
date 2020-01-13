<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CountersSearch;
use app\components\Backend;
use app\modules\shop\models\Types;
use yii\helpers\FileHelper;

class CountersController extends Backend
{

    public function actionIndex()
    {
        
        $searchModel = new CountersSearch();
        $searchModel->start_date = date('Y-m-d', strtotime('-1 month'));
        $searchModel->end_date = date('Y-m-d');        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // export to file
        if(Yii::$app->request->get('export')) {
            $models = $dataProvider->getModels();
            FileHelper::createDirectory(Yii::getAlias('@uploads/tmp'));
            $out = fopen(Yii::getAlias('@uploads/tmp/newexport.csv'), 'w');
            
            foreach($models as $item) {
                $type = Types::findOne($item->model_id);
                $typeName = $type ? $type->title : '(не определен)';
                $row = [$item->id, $typeName, date('d-m-Y', strtotime($item->date)), $item->count];
                fputcsv($out, $row, ';');
            }
            Yii::$app->response->sendFile(Yii::getAlias('@uploads/tmp/newexport.csv'), 'Counters.csv');
            fclose($out);
            Yii::$app->end();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
