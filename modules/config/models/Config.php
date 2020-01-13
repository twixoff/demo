<?php

namespace app\modules\config\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $id
 * @property string $param
 * @property string $label
 * @property string $value
 * @property string $type
 * @property string $default
 * @property integer $sort
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'label', 'type'], 'required'],
            [['value'], 'required', 'when' => function($model) {
                return !in_array($model->type, ['text', 'fulltext', 'code-css','code-js']);
            }, 'whenClient' => "function (attribute, value) {
                return $('#config-type').val() != 'text' && $('#config-type').val() != 'fulltext'
                    && $('#config-type').val() != 'code-css' && $('#config-type').val() != 'code-js';
            }"],
            [['value', 'type', 'default'], 'string'],
            [['sort', 'isHide'], 'integer'],
            [['param'], 'string', 'max' => 128],
            [['label'], 'string', 'max' => 255],
            [['param'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'param' => 'Ключ переменной',
            'label' => 'Переменная',
            'value' => 'Значение',
            'type' => 'Тип',
            'default' => 'Значение по-умолчанию',
            'isHide' => 'Скрыть',
            'sort' => 'Сортировка',
        ];
    }
    
    
    public static function get($key) {
        return Config::findOne(['param' => $key])->value;
    }
}
