<?php

namespace app\modules\shop\models;

use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class SerieImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_serie_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serie_id'], 'required'],
            [['serie_id', 'sort'], 'integer'],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'maxSize' => 1024*1024*1024*5, 'maxFiles' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'serie_id' => 'Серия',
            'image' => 'Фото',
            'sort' => 'Порядок',
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
                'savePath' => '/serie-images',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'big' => [
                            'width' => 1140,
                            'height' => 550,
                        ],
                        'thumb' => [
                            'width' => 200,
                            'height' => 200,
//                            'mode' => 'inset'
                        ],
                    ]
                ]
            ]
        ];
    }
}
