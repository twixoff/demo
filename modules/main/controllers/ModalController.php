<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\models\ContactForm;
use app\modules\main\models\CallbackForm;
use app\modules\config\models\Config;
use yii\base\DynamicModel;

class ModalController extends Controller
{
    
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'testing' => ['post'],
//                ],
//            ],
//        ];
//    }
    

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    public function actionTesting() {
        $model = new DynamicModel(['name', 'email', 'maket', 'type']);
        $model->addRule(['name', 'email', 'maket', 'type'], 'required');
        $model->addRule(['name', 'maket'], 'string');
        $model->addRule('email', 'email');
//        $model->addRule('type', 'integer');

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $message = "";
            if($model->name) $message.= "Имя: " . $model->name . "<br>";
            if($model->email) $message.= "E-mail: " . $model->email . "<br>";
            if($model->maket) $message.= "Конструкция: " . $model->maket . "<br>";
            if($model->type) $message.= "Модели: " . implode(", ", $model->type);
            $emails = Config::get('site.email');
            Yii::$app->mailer->compose()
                ->setTo(explode(',', $emails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject('Заявка на тестирование ['.\Yii::$app->getRequest()->getHostInfo().']')
                ->setHtmlBody($message)
                ->send();
            Yii::$app->session->setFlash('success', true);
        }
        
        return $this->renderAjax('testing', ['model' => $model]);
//        return $this->renderPartial('testing', ['model' => $model]);
    }


    public function actionContact()
    {
        if(Yii::$app->request->isAjax) {
            $email = Config::get('site.email');
            $model = new ContactForm(['scenario' => 'contact']);
            if ($model->load(Yii::$app->request->post()) && $model->contactSend($email)) {
                Yii::$app->session->setFlash('contactFormSubmitted');
            }
            return $this->renderAjax('_contact-form', ['model' => $model]);
            
//            if (!Yii::$app->request->isPjax) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }                
        }
    }
    
    
    public function actionCallback()
    {
        if(Yii::$app->request->isAjax) {
            $model = new CallbackForm();
            if ($model->load(Yii::$app->request->post()) && $model->send()) {
                Yii::$app->session->setFlash('callbackFormSubmitted');
                $model = new CallbackForm();
            }
            return $this->renderAjax('_callback-form', ['model' => $model]);
        }
    }
    
    public function actionSubscribe()
    {
        if(Yii::$app->request->isAjax) {
            $model = new ContactForm(['scenario' => 'subscribe']);
            if ($model->load(Yii::$app->request->post()) && $model->subscribeSend($email)) {
                Yii::$app->session->setFlash('subscribeFormSubmitted');
            }
            return $this->renderAjax('_subscribe-form', ['model' => $model]);
        }
    }    
    
    public function actionAskQuestion()
    {
        if(Yii::$app->request->isAjax) {
            $email = Config::get('site.email');
            $model = new ContactForm(['scenario' => 'question']);
            if ($model->load(Yii::$app->request->post()) && $model->questionSend($email)) {
                Yii::$app->session->setFlash('questionFormSubmitted');
            }
            return $this->renderAjax('_ask-question-form', ['model' => $model]);
        }
    }    
}
