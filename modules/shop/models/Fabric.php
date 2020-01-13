<?php

namespace app\modules\shop\models;

use app\modules\admin\models\Structure;
use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class Fabric extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_fabrics}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'structure_id'], 'required'],
            [['text', 'description'], 'string'],
            [['catalog'], 'string'],
            [['structure_id', 'sort', 'is_publish'], 'integer'],
            [['is_publish'], 'default', 'value' => 1],
            [['logo', 'cover'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
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
            'structure_id' => 'Раздел',
            'title' => 'Наименование',
            'logo' => 'Логотип',
            'logo_menu' => 'Логотип (для меню)',
            'cover' => 'Изображение (обложка)',
            'text' => 'Вводный текст',
            'description' => 'Описание',
            'catalog' => 'Каталог (файл)',
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
                    'logo' => [
                        'big' => [
                            'width' => 370,
                            'height' => null,
//                            'mode' => 'inset'
                        ]
                    ],
                    'logo_menu' => [
//                        'saveOriginal' => true
                        'big' => [    // для меню
                            'width' => 210,
                            'height' => 50,
                            'mode' => 'inset'
                        ],
                    ],
                    'cover' => [
//                        'saveOriginal' => true
                        'big' => [
                            'width' => 770,
                            'height' => 410,
                        ]
                    ]
                ]
            ]
        ];
    }


    public function getUrl() {
        $part = Structure::findOne($this->structure_id);
        return '/' . $part->slug . '/' . $this->id;
    }

}