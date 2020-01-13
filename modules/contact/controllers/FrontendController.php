<?php

namespace app\modules\contact\controllers;

use app\modules\shop\models\Order;
use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use app\modules\config\models\Config;
use app\modules\contact\models\ContactForm;

class FrontendController extends Controller
{
    
    public function actionIndex($parentId)
    {
        $model = new ContactForm();
        $emails = Config::get('site.email');
        if ($model->load(Yii::$app->request->post()) && $model->send($emails)) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    
//    public function actionCallback() {
//        $model = new DynamicModel(['name', 'phone']);
//        $model->addRule(['phone'], 'required');
//        $model->addRule(['name', 'phone'], 'string');
//
//        if($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $message = "";
//            if($model->name) $message.= "<b>Имя:</b> " . $model->name . "<br>";
//            if($model->phone) $message.= "<b>Телефон:</b> " . $model->phone . "<br>";
//            $emails = Config::get('site.email');
//            Yii::$app->mailer->compose()
//                ->setTo(explode(',', $emails))
//                ->setFrom(Yii::$app->params['fromEmail'])
//                ->setSubject('Заказ звонка ['.\Yii::$app->getRequest()->getHostInfo().']')
//                ->setHtmlBody($message)
//                ->send();
//            Yii::$app->session->setFlash('success', true);
//        }
//
//        Yii::$app->assetManager->bundles = [
//            'yii\bootstrap\BootstrapPluginAsset' => false,
//            'yii\bootstrap\BootstrapAsset' => false,
//            'yii\web\JqueryAsset' => false,
//            'yii\web\YiiAsset' => false,
//        ];
//        return $this->renderAjax('_modal-callback', ['model' => $model]);
//    }

    
    public function actionWriteUs() {
        $model = new DynamicModel(['name', 'phone', 'email', 'message', 'agree', 'reCaptcha']);
        $model->addRule(['phone', 'email'], 'required');
        $model->addRule(['agree'], 'required', [
            'requiredValue' => 1,
            'message' => 'Необходимо отметить свое согласие.'
        ]);
        $model->addRule(['name', 'phone', 'message'], 'string');
        $model->addRule(['email'], 'email');
        $model->addRule(['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::class);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $message = "";
            if($model->name) $message.= "<b>Имя:</b> " . $model->name . "<br>";
            if($model->phone) $message.= "<b>Телефон:</b> " . $model->phone . "<br>";
            if($model->email) $message.= "<b>E-mail:</b> " . $model->email . "<br>";
            if($model->message) $message.= "<b>Сообщение:</b> " . $model->message;
            $emails = Config::get('site.email');
            Yii::$app->mailer->compose()
                ->setTo(explode(',', $emails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject('Сообщение с сайта ['.\Yii::$app->getRequest()->getHostInfo().']')
                ->setHtmlBody($message)
                ->send();
            Yii::$app->session->setFlash('success', true);
        }
        
        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\web\YiiAsset' => false,
        ];
        return $this->renderAjax('_modal-write-us', ['model' => $model]);
    }


    public function actionTakeOrder() {
        $model = new Order(['scenario' => 'take-order']);
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                $model->newOrderClient();
                $model->newOrderAdmin();
                \Yii::$app->cart->removeAll();

                Yii::$app->session->setFlash('order', $model->id);
                Yii::$app->session->setFlash('success', true);
            }
            Yii::$app->session->setFlash('success', true);
        }

        Yii::$app->assetManager->bundles = [
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\JqueryAsset' => false,
            'yii\web\YiiAsset' => false,
        ];
        return $this->renderAjax('_modal-take-order', ['model' => $model]);
    }

}