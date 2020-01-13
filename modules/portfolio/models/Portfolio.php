<?php

namespace app\modules\portfolio\models;

use app\modules\admin\models\Structure;
use app\components\behaviors\ImageBehavior;
use app\modules\shop\models\Serie;
use twixoff\sortablegrid\SortableGridBehavior;

class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['structure_id', 'title', 'text'], 'required'],
            [['title', 'location'], 'string', 'max' => 255],
            [['text', 'location'], 'string'],
            [['use_series'], 'string'],
            [['structure_id', 'sort'], 'integer'],
            [['is_publish'], 'boolean'],
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
            'id' => 'Id',
            'structure_id' => 'Раздел',
            'title' => 'Заголовок',
            'text' => 'Описание проекта',
            'image' => 'Фото',
            'location' => 'Расположение объекта',
            'use_series' => 'Использованные продукты',
            'sort' => 'Порядок',
            'is_publish' => 'Опубликовать',
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
                'savePath' => '/portfolio',
                'fields' => [
                    'image' => [
//                        'saveOriginal' => true
                        'big' => [
//                            'width' => 415,
                            'width' => 945,
                            'height' => 525,
                        ]
                    ]
                ]
            ]
        ];
    }
    
    public function beforeDelete() {
        parent::beforeDelete();
        if($this->images) {
            foreach($this->images as $image) {
                $image->delete();
            }
        }
        return true;
    }
    
    
    public function getImages() {
        return $this->hasMany(PortfolioImages::class, ['portfolio_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }
    

    public function getUrl() {
        $part = Structure::findOne($this->structure_id);
        return '/' . $part->slug . '/' . $this->id;
    }


    public function getSeries() {
        return Serie::find()->where(['id' => explode(',', $this->use_series)])->all();
    }

}
