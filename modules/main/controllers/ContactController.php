<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\config\models\Config;
use app\modules\main\models\CallbackForm;
use yii\web\Response;

class ContactController extends Controller
{
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    public function actionCallback()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $email = Config::get('site.email');
        $model = new CallbackForm();
        if ($model->load(Yii::$app->request->post()) && $model->send($email)) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            Yii::$app->session->setFlash('success', true);
            return ['success' => true, 'view' => $this->renderAjax('@app/modules/contact/views/frontend/_modal-write-us')];
        }

        return ['success' => false];
    }
}
