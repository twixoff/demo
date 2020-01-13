<?php

namespace app\modules\contact\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            [['name'], 'string'],
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Ваш e-mail',
            'body' => 'Ваш вопрос...',
        ];
    }

    public function send($emails)
    {
        if ($this->validate()) {
            $message = "";
            if($this->name) $message.= $this->getAttributeLabel('name') . ": " . $this->name . "<br>";
            if($this->email) $message.= $this->getAttributeLabel('email') . ": " . $this->email . "<br>";
            if($this->phone) $message.= $this->getAttributeLabel('phone') . ": " . $this->phone . "<br>";
            if($this->body) $message.= $this->getAttributeLabel('body') . ": " . $this->body . "<br>";
            Yii::$app->mailer->compose()
                ->setTo(explode(',', $emails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject('Новое сообщение ['.\Yii::$app->getRequest()->getHostInfo().']')
                ->setHtmlBody($message)
                ->send();
            return true;
        } else {
            return false;
        }
    }

 
}
