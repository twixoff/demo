<?php
/*
 * Add in bootstrap section:
 *   'bootstrap' => [
 *      ...
 *      'app\modules\admin\components\Redirect',
 *      ...
 *   ] 
 */

namespace app\modules\admin\components;

use Yii;
use yii\base\Component;
use app\modules\admin\models\Redirects;

class Redirect extends Component
{
    public function init() {
        $uri = Yii::$app->request->url;
        $redirect = Redirects::find()->where(['from' => $uri, 'is_publish' => 1])->one();
        if($redirect) {
            header('Location: ' . $redirect->to, true, 301);
            exit();
//            \yii\helpers\VarDumper::dump($redirect->to);exit();
//            return Yii::$app->getResponse()->redirect('/admin')->send();
//            return Yii::$app->getResponse()->redirect($redirect->to);
//            Yii::$app->getResponse()->redirect($redirect->to)->send();
//            Yii::$app->getResponse()->redirect('/login', 301)->send();
        }
    }
    
}