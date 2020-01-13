<?php

namespace app\modules\infoblocks\models;

use Yii;
use yii\helpers\Json;
use twixoff\sortablegrid\SortableGridBehavior;

class InfoBlocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%info_blocks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['structure_id', 'title', 'type'], 'required'],
            [['structure_id', 'sort'], 'integer'],
            [['content', 'type'], 'string'],
            [['is_publish'], 'boolean'],
//            [['is_publish'], 'default', 'value' => 1, 'skipOnEmpty' => false],
            [['dCreate'], 'safe'],
            [['title', 'video', 'map'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'structure_id' => 'id раздела',
            'type' => 'Тип блока',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'video' => 'Ссылка на видео',
            'map' => 'Точка на карте',
            'sort' => 'Порядок сортировки',
            'is_publish' => 'Опубликовать',
            'dCreate' => 'Дата создания',
        ];
    }


    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::class,
                'sortableAttribute' => 'sort'
            ],
        ];
    }


    public function beforeValidate() {
        parent::beforeValidate();
        if(in_array($this->type, ['map'])) {
            $this->content = Json::encode($this->content);
        }
        return true;
    }


    public function afterFind() {
        parent::afterFind();
        if(in_array($this->type, ['map'])) {
            $this->content = Json::decode($this->content);
        }
        return true;
    }


//    public function afterSave($insert, $changedAttributes) {
//        parent::afterSave($insert, $changedAttributes);
//        $this->saveCards();
//    }


    public function afterDelete() {
        parent::afterDelete();
        $this->deleteCards();
    }


    public function getGallery() {
        return $this->hasMany(InfoBlockGallery::class, ['block_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    public function getCards() {
        return $this->hasMany(InfoBlockCard::class, ['block_id' => 'id'])->orderBy('sort');
    }


//    // save cards
//    public function saveCards() {
//        if($this->type == 'cards') {
//            $cards = $this->cards;
//            foreach(Yii::$app->request->post('InfoBlockCard', []) as $k => $data) {
//                Yii::$app->session->setFlash('tabularIndex', $k);
//                if(isset($cards[$k])) {
//                    $cards[$k]->setAttributes($data);
//                    $cards[$k]->save();
//                } else {
//                    $card = new InfoBlockCard();
//                    $card->block_id = $this->id;
//                    $card->setAttributes($data);
//                    $card->save();
//                }
//            }
//        }
//
//        return true;
//    }


    // delete cards
    public function deleteCards() {
        if($this->type == 'cards' && $this->cards) {
            foreach($this->cards as $card) {
                $card->delete();
            }
        }
        return true;
    }


}
