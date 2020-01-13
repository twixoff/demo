<?php

namespace app\modules\shop\models;

use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class Category extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_categories}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['intro', 'text'], 'string'],
            [['sort', 'is_publish'], 'integer'],
            [['is_publish'], 'default', 'value' => 1],
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
            'title' => 'Наименование',
            'image' => 'Изображение',
            'intro' => 'Вводный текст',
            'text' => 'Описание',
            'is_publish' => 'Опубликовать',
            'sort' => 'Порядок сортировки',
            'd_create' => 'Дата добавления',
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
                'savePath' => '/fabric',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'thumb' => [    // для меню
                            'width' => 200,
                            'height' => 70,
                            'mode' => 'inset'
                        ],
                        'big' => [
                            'width' => 1140,
                            'height' => 355,
//                            'mode' => 'inset'
                        ]
                    ],
                ]
            ]
        ];
    }

}