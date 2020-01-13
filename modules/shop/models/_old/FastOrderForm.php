<?php

namespace app\modules\shop\models;

use Yii;
use yii\base\Model;
use app\modules\config\models\Config;

/**
 * ContactForm is the model behind the contact form.
 */
class FastOrderForm extends Model
{
    public $fio;
    public $phone;
    public $product_id;
    public $quantity;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['phone', 'phone', 'product_id', 'quantity'], 'required'],
            [['fio', 'phone'], 'string'],
            [['product_id', 'quantity'], 'integer']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'Имя',
            'phone' => 'Телефон',
            'product_id' => 'Товар',
            'quantity' => 'Количество',
        ];
    }

    
    public function createFastOrder()
    {
        if ($this->validate()) {
            
            $toEmails = Config::get('site.email');
            $message = "";
            if($this->fio) $message.= $this->getAttributeLabel('fio') . ": " . $this->fio . "<br>";
            if($this->phone) $message.= $this->getAttributeLabel('phone') . ": " . $this->phone . "<br>";
            
            $item = Product::findOne($this->product_id);
            if($item) {
                $message .= "<p>&nbsp;</p><p><b>Состав заказа:</b></p>";
                $message .= '<b>'. $item->title . '</b> - ' . $this->quantity . ' шт.';
            }
            $message .= "<br><br><span style='color: #cecece;'>Отправлено с ". str_replace("http://", "", \Yii::$app->request->getHostInfo())."</span>";

            // create order
            $price = $item->price_sale ? $item->price_sale : $item->price;
            $order = new Order();
            $order->fio = $this->fio;
            $order->phone = $this->phone;
            $order->total_sum = $this->quantity * $price;
            $order->comment = $item->title . ' - ' . $this->quantity . ' шт';
            $order->save(false);

            Yii::$app->mailer->compose()
                ->setTo(explode(', ', $toEmails))
                ->setFrom(Yii::$app->params['fromEmail'])
                ->setSubject('Новый заказ')
                ->setHtmlBody($message)
                ->send();
            return true;
        } else {
            return false;
        }
    }

    
}