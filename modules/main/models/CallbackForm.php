<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;
use app\modules\config\models\Config;

class CallbackForm extends Model
{
    public $name;
    public $phone;
    public $agree;

    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['agree'], 'required', 'requiredValue' => 1, 'message' => 'Необходимо отметить свое согласие.'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'name' => 'Как вас зовут?',
            'phone' => 'Контактный телефон',
            'agree' => 'Согласие'
        ];
    }

    
    public function send()
    {
        if ($this->validate()) {
            $email = Config::get('site.email');
            $message = "Имя: " . $this->name . "<br>Телефон: " . $this->phone;
            Yii::$app->mailer->compose()
                ->setTo(explode(',', $email))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject('Обратный звонок [' . str_replace("http://", "", Yii::$app->request->getHostInfo()) . ']')
                ->setHtmlBody($message)
                ->send();
            return true;
        } else {
            return false;
        }
    }
}
