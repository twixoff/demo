<?php

namespace app\modules\portfolio\models;

use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class PortfolioImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['portfolio_id'], 'required'],
            [['portfolio_id', 'sort'], 'integer'],
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
            'portfolio_id' => 'Проект',
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
                'savePath' => '/portfolio-images',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'big' => [
                            'width' => 1140,
                            'height' => 700,
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
