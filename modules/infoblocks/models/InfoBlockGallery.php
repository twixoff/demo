<?php

namespace app\modules\infoblocks\models;

use twixoff\sortablegrid\SortableGridBehavior;
use app\components\behaviors\ImageBehavior;

class InfoBlockGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%info_block_gallery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_id'], 'required'],
//            [['block_id', 'title'], 'required'],
            [['block_id', 'sort'], 'integer'],
            [['is_publish'], 'boolean'],
            [['title', 'descr'], 'string', 'max' => 255],
            [['dCreate'], 'safe'],
            
            ['image', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024*1024*1024*5, 'maxFiles' => 10],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'block_id' => 'id раздела',
            'title' => 'Заголовок',
            'descr' => 'Описание',
            'image' => 'Фото',
            'sort' => 'Порядок сортировки',
            'is_publish' => 'Опубликовать',
            'dCreate' => 'Дата создания',
        ];
    }


    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort'
            ],
            'image' => [
                'class' => ImageBehavior::class,
                'savePath' => '/infogallery',
//                'saveOriginal' => true,
                'fields' => [
                    'image' => [
                        'big' => [
                            'width' => 800,
                            'height' => 800,
                            'mode' => 'inset'
                        ],
                        'thumb' => [
                            'width' => 272,
                            'height' => 175,
                        ]
                    ]
                ]
            ]            
        ];
    }
}
