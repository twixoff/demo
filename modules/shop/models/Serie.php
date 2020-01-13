<?php

namespace app\modules\shop\models;

use app\modules\admin\models\Structure;
use app\components\behaviors\ImageBehavior;
use twixoff\sortablegrid\SortableGridBehavior;

class Serie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_series}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'structure_id'], 'required'],
            [['description', 'info', 'file'], 'string'],
            [['structure_id', 'category_id', 'type_id', 'fabric_id', 'sort', 'is_publish'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'structure_id' => 'Раздел',
            'title' => 'Наименование серии',
            'category_id' => 'Категория',
            'type_id' => 'Тип',
            'fabric_id' => 'Фабрика',
            'image' => 'Изображение',
            'description' => 'Описание',
            'file' => 'Инструкция для скачивания (файл)',
            'info' => 'Дополнительная информация',
            'is_publish' => 'Опубликовать',
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
                'savePath' => '/serie',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'big' => [
                            'width' => 270,
                            'height' => 270,
                        ]
                    ]
                ]
            ]
        ];
    }


    /*
     * Get products
     */
    public function getProducts() {
        return $this->hasMany(Product::class, ['serie_id' => 'id'])->orderBy('sort');
    }


    /*
     * Get products
     */
    public function getActiveProducts() {
        return $this->hasMany(Product::class, ['serie_id' => 'id'])->andWhere(['is_publish' => 1])->orderBy('sort');
    }

    /*
     * Get count products in serie
     */
    public function getCountProducts() {
        return $this->hasMany(Product::class, ['serie_id' => 'id'])->count();
    }


    /*
    * Get category
    */
    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


    /*
    * Get type
    */
    public function getType() {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }


    /*
     * Get fabric
     */
    public function getFabric() {
        return $this->hasOne(Fabric::class, ['id' => 'fabric_id']);
    }


    public function beforeDelete() {
        parent::beforeDelete();
        if(($products = $this->products) !== null) {
            foreach($products as $p) {
                $p->delete();
            }
        }
        if($this->images) {
            foreach($this->images as $image) {
                $image->delete();
            }
        }
        return true;
    }


    public function getImages() {
        return $this->hasMany(SerieImages::class, ['serie_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }


    public function getUrl() {
        $part = Structure::findOne($this->structure_id);
        return '/' . $part->slug . '/' . $this->id;
    }


    public function getSection() {
        return $this->hasOne(Structure::class, ['id' => 'structure_id']);
    }

}