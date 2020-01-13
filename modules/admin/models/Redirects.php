<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "redirects".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property integer $is_publish
 * @property string $dCreate
 */
class Redirects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%redirects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'required'],
            [['is_publish'], 'integer'],
            [['dCreate'], 'safe'],
            [['from', 'to'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'from' => 'Адрес исходный',
            'to' => 'Адрес конечный',
            'is_publish' => 'Опубликовать?',
            'dCreate' => 'Дата создания',
        ];
    }
}
