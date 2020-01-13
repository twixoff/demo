<?php

namespace app\modules\infoblocks;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\infoblocks\controllers';
    public $blockTypes = [
        'text' => 'Текстовый блок',
//        'video' => 'Блок с видео'
//        'gallery' => 'Галерея',
//        'map' => 'Карта',
//        'cards' => 'Карточки (услуги/контакты)',
//        'useful' => 'Полезные документы',
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function getTypes()
    {
        return $this->blockTypes;
    }
    
    public function getBlockView($type)
    {
        return '_view-'.$type;
    }
    
    public function getTypeName($type)
    {
        return $this->blockTypes[$type];
    }
}
