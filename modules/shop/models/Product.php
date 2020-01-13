<?php

namespace app\modules\shop\models;

use Yii;
use yz\shoppingcart\CartPositionInterface;
use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

//class Product extends \yii\db\ActiveRecord implements CartPositionInterface
class Product extends \yii\db\ActiveRecord
{
//    use \yz\shoppingcart\CartPositionTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie_id', 'title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['serie_id', 'price', 'sort', 'is_publish'], 'integer'],
            [['dCreate'], 'safe'],
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024*1024*1024*5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serie_id' => 'Серия',
            'title' => 'Заголовок',
            'content' => 'Описание',
            'price' => 'Цена',
            'image' => 'Изображение',
            'sort' => 'Порядок',
            'is_publish' => 'Опубликовать',
            'dCreate' => 'Дата создания',
        ];
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::class,
                'sortableAttribute' => 'sort'
            ],
            'image' => [
                'class' => ImageBehavior::class,
                'savePath' => '/product',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'big' => [
                            'width' => 330,
                            'height' => null,
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getSerie() {
        return self::hasOne(Serie::class, ['id' => 'serie_id']);
    }


//    public function getPrice()
//    {
//        $price = $this->price;
//        $percent = 0;
//        $level1 = $this->category;
//        $level2 = $level1->parent;
//        $level3 = $level2->parent;
//
//        if($level3 && $level3->percentage !== 0)
//        {
//            $percent += $level3->percentage;
//        }
//        if($level2 && $level2->percentage !== 0)
//        {
//            $percent += $level2->percentage;
//        }
//        if($level1 && $level1->percentage !== 0)
//        {
//            $percent += $level1->percentage;
//        }
//        if($percent !== 0) {
//            return $this->price + $this->price * $percent / 100;
//        }
//
////        return $percent;
//        return $price;
//    }
//
//
//    public function getId()
//    {
//        return $this->id;
//    }
    
}