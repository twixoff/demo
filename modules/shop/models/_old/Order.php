<?php

namespace app\modules\shop\models;

use app\components\helpers\FileHelper;
use conquer\helpers\Json;
use Yii;
use app\modules\shop\models\Products;
use app\modules\config\models\Config;
use app\modules\notifications\models\Notifications;
use yii\base\Security;
use yii\web\UploadedFile;

class Order extends \yii\db\ActiveRecord
{
    
    public static $STATUS_NEW = 0;
    public static $STATUS_PROCESSED = 1;
    public static $STATUS_SENT = 2;
    public static $STATUS_DELIVERED = 3;
    public static $STATUS_CANCELED = 4;
    public static $STATUS_FINISHED = 5;

    public $file;
    public $agree;
    public $reCaptcha;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'name', 'phone', 'email'], 'required'],
            [['phone_local', 'comment'], 'string'],
            [['file', 'attachment', 'total_sum'], 'safe'],
            [['agree'], 'required', 'requiredValue' => 1, 'message' => 'Необходимо отметить свое согласие.'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::class]
        ];
    }


    public function scenarios()
    {
        return [
            'default' => ['company', 'name', 'phone', 'email', 'phone_local', 'comment', 'file', 'attachment', 'total_sum', 'agree'],
            'take-order' => ['company', 'phone', 'email',  'comment', 'file', 'attachment', 'agree', 'reCaptcha']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'company' => 'Компания',
            'name' => 'ФИО',
            'phone' => 'Контактный телефон',
            'email' => 'E-mail',
            'phone_local' => 'Стационарный телефон (с кодом города)',
            'comment' => 'Комментарий к заказу (ваши вопросы и пожелания)',
            'file' => 'Прикрепить файл',
            'agree' => 'Согласие',
            'total_sum' => 'Сумма заказ',
            'd_create' => 'Дата оформления'
        ];
    }
    
//    public function afterSave($insert, $changedAttributes) {
//        parent::afterSave($insert, $changedAttributes);
//        if(!$insert) {
//            if($changedAttributes['status'] != $this->status) {
//                $this->changeStatusClient();
//            }
//        }
//    }
    

    public function beforeSave($insert)
    {
        $items = [];
        foreach(Yii::$app->cart->getPositions() as $item) {
            $items[] = ['title' => $item->title, 'price' => $item->getPrice(), 'count' => $item->getQuantity(), 'dimension' => $item->dimension];
        }
        $this->items = Json::encode($items);
        if(($file = UploadedFile::getInstance($this, 'file')) !== null) {
            FileHelper::checkPath(Yii::getAlias('@uploads/order-files/'));
            $filename = $file->getBaseName().'-'.time().'.'.$file->getExtension();
            $this->attachment = $filename;
            $file->saveAs(Yii::getAlias('@uploads/order-files/'.$filename));
        }
        
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    
    public function afterFind()
    {
        $this->items = Json::decode($this->items);
        
        parent::afterFind();
    }


    public static function getStatusList() {
        return [
            self::$STATUS_NEW => 'новый',
            self::$STATUS_PROCESSED => 'в обработке',
            self::$STATUS_SENT => 'отправлен',
            self::$STATUS_DELIVERED => 'доставлен',
            self::$STATUS_CANCELED = 'отменен',
            self::$STATUS_FINISHED = 'выполнен'
        ];
    }


    public function afterDelete()
    {
        parent::afterDelete();
        @unlink($this->getFilePath());
        return true;
    }


    public function getStatusName() {
        $statusList = self::getStatusList();
        $status = isset($statusList[$this->status]) ? $statusList[$this->status] : 'не определен';
        
        return $status;
    }
    
    
    public function getFilePath() {
        return Yii::getAlias('@uploads/order-files/'.$this->attachment);

    }

    
    // send letter to client (new order)
    public function newOrderClient() {
//        if($this->payment_type == self::$PAYMENT_CASHLESS) {
//            $notificate = Notifications::find()->where(['key' => 'order.new.client-invoice'])->one();
//            // TODO:: прикрепление счета к письму
//        } else {
//            $notificate = Notifications::find()->where(['key' => 'order.new.client'])->one();
//        }

        $notificate = Notifications::find()->where(['key' => 'order.new.client'])->one();

        if($notificate->is_publish) {
            $subject = $this->replaceText($notificate->subject);
            $message = $this->replaceText($notificate->text);
            
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();
        }
        return true;
    }
     

    public function newOrderAdmin() {
        $notificate = Notifications::find()->where(['key' => 'order.new.admin'])->one();
        if($notificate->is_publish) {
            $toEmails = str_replace(" ", "", Config::get('site.email'));
            $subject = $this->replaceText($notificate->subject);
            $message = $this->replaceText($notificate->text);
            
            $email = Yii::$app->mailer->compose()
                ->setTo(explode(',', $toEmails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject($subject)
                ->setHtmlBody($message);
            if($this->attachment) {
                $email->attach($this->getFilePath());
            }
            $email->send();
        }
        return true;
    }    
     

    public function changeStatusClient() {
        $notificate = Notifications::find()->where(['key' => 'order.status.change'])->one();
        if($notificate->is_publish) {
            $subject = $this->replaceText($notificate->subject);
            $message = $this->replaceText($notificate->text);
            
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();
        }
        return true;
    }    
     
    
    /*
     * Замена тегов в тексте писем
     */
    public function replaceText($text) {
        if(!is_array($this->items)) {
            $this->items = Json::decode($this->items);
        }
        $items = "";
        if(count($this->items)) {
            $items = '<table width="100%" cellspacing="0">';
            $items .= '<tr>'
                .'<td width="70%" valign="middle" align="left"><b>Наименование</b></td>'
                .'<td width="15%" valign="middle" align="center"><b>Стоимость</b></td>'
                .'<td width="15%" valign="middle" align="center"><b>Кол-во</b></td>'
            .'</tr>';
            foreach($this->items as $item) {
                $items .= '<tr>';
                    $items .= '<td>'.$item['title'].'</td>';
                    $items .= '<td align="center">'. number_format($item['price'], 0, '', ' ').' р.</td>';
                    $items .= '<td align="center">'.$item['count'].' ('.$item['dimension'].') </td>';
                $items .= '</tr>';
                //                        $items .= $item['price'] * $item['count'];
            }
            $items .= '<tr>'
                .'<td colspan="3" align="right" style="border-top:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5;">'
                    .'<b>Итого: '.number_format($this->total_sum, 0, '', ' ').' р.</b>'
                .'</td>'
            .'</tr>';
            $items .= '</table>';
        }

        $replaceItemsFrom = [
            '#ZAKAZ#',
            '#COMPANY#', '#FIO#', '#EMAIL#', '#PHONE#',
            '#STATUS#',
            '#ITEMS#', '#COMMENT#'
        ];
        $replaceItemsTo = [
            $this->id,
            $this->company, $this->name, $this->email, $this->phone,
            $this->statusname,
            $items, $this->comment
        ];
        
        return str_replace($replaceItemsFrom, $replaceItemsTo, $text);
    }

}
