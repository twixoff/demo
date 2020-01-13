<?php

namespace app\modules\infoblocks\models;

use Yii;
use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class InfoBlockCard extends \yii\db\ActiveRecord
{

    const TYPE_CARD = 1;
    const TYPE_CONTACT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%info_block_cards}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_id', 'title', 'type_id'], 'required'],
            [['block_id', 'type_id', 'sort'], 'integer'],
            [['title', 'phone', 'email', 'link', 'image'], 'string', 'max' => 255],
            
//            ['image', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024*1024*1024*5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'block_id' => 'Блок',
            'title' => 'Заголовок',
            'link' => 'Ссылка',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'image' => 'Фото',
            'type_id' => 'Тип',
            'sort' => 'Порядок сортировки',            
        ];
    }
    
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::class,
                'sortableAttribute' => 'sort'
            ],
            'image' => [
                'class' => ImageBehavior::class,
                'savePath' => '/infocards',
//                'saveOriginal' => true,
                'fields' => [
                    'image' => [
                        'thumb' => [
                            'width' => 255,
                            'height' => function() {
                                return $this->type_id == self::TYPE_CONTACT ? 255 : 200;
                            },
                        ]
                    ]
                ]
            ]            
        ];
    }

}
