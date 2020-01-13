<?php

namespace app\modules\admin\models;

use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sliders}}';
    }
    
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::class,
                'sortableAttribute' => 'sort',
            ],
            'image' => [
                'class' => ImageBehavior::class,
                'savePath' => '/sliders',
                'fields' => [
                    'image' => function() {
                        if($this->category == 'fabric') {
                            return [
                                'saveOriginal' => false,
                                'thumb' => [
                                    'width' => 100, 'height' => 115,
                                ],
                                'big' => [
                                    'width' => 615, 'height' => 700
                                ],
                            ];
                        }
                        if($this->category == 'category') {
                            return [
                                'saveOriginal' => false,
                                'thumb' => [
                                    'width' => 200, 'height' => 70,
                                ],
                                'big' => [
                                    'width' => 1140, 'height' => 355
                                ],
                            ];
                        }
                        if($this->category == 'project') {
                            return [
                                'saveOriginal' => false,
                                'thumb' => [
                                    'width' => 200, 'height' => 100,
                                ],
                                'big' => [
                                    'width' => 1140, 'height' => 610
                                ],
                            ];
                        }

                        // default sizes
                        return ['saveOriginal' => false,
                            'big' => [
                                'width' => 900,
                                'height' => null,
                            ],
                            'thumb' => [
                                'width' => 150,
                                'height' => 150,
                            ]
                        ];
                    },
//                    'image' => [
//                        'saveOriginal' => false,
//                        'big' => [
//                            'width' => 865,
//                            'height' => 595,
////                            'mode' => 'inset'
//                        ],
//                    ]
                    'image_logo' => [
                        'saveOriginal' => false,
                        'thumb' => [
                            'width' => 370, 'height' => null, 'mode' => 'inset'
                        ],
                        'big' => [
                            'width' => 370, 'height' => null, 'mode' => 'inset'
                        ],
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort', 'is_publish'], 'integer'],
            [['title', 'descr', 'link'], 'string', 'max' => 255],
            [['image', 'image_logo'], 'image', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024*1024*1024*10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'descr' => 'Краткое описание фабрики',
            'link' => 'Ссылка',
            'image' => 'Фото',
            'image_logo' => 'Лого фабрики',
            'sort' => 'Порядок',
            'is_publish' => 'Опубликовать',
        ];
    }
  
}