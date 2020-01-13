<?php

namespace app\modules\main\controllers;

use app\modules\shop\models\Category;
use app\modules\shop\models\Serie;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\modules\news\models\News;
use app\modules\admin\models\Slider;
use app\modules\shop\models\Product;
use app\modules\admin\models\Structure;
use app\modules\infoblocks\models\InfoBlocks;

class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 300,
                'enabled' => !YII_DEBUG
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }  


    public function actionCap()
    {
        $this->module->setLayoutPath('@app/views/layouts');
        $this->module->layout = 'cap';         
        return $this->renderContent('cap');
    }
    
    
    public function actionIndex()
    {

        return $this->render('index', [
            'fabricSlider' => Slider::find()->where(['category' => 'fabric', 'is_publish' => 1])->orderBy('sort')->all(),
            'categorySlider' => Category::find()->where(['is_publish' => 1])->orderBy('sort')->all(),
            'newItems' => Slider::find()->where(['category' => 'new', 'is_publish' => 1])->orderBy('sort')->limit(2)->all(),
            'projectSlider' => Slider::find()->where(['category' => 'project', 'is_publish' => 1])->orderBy('sort')->all(),
            'infoBlocks' => InfoBlocks::find()->where(['structure_id' => 1, 'is_publish' => 1])->orderBy('sort')->all(),
        ]);
    }


    public function actionSearch()
    {
        $q = \Yii::$app->request->get('q');

        if(!empty($q)) {
            $dataProvider = new ActiveDataProvider([
                'query' => Serie::find()->where(['LIKE', 'title', $q])->andWhere(['is_publish' => 1]),
                'pagination' => ['pageSize' => 4]

            ]);
        } else {
            $dataProvider = null;
        }

        return $this->render('search', [
            'q' => $q,
            'dataProvider' => $dataProvider
        ]);
    }

}
