<?php

namespace app\components;

use Yii;
use yii\base\Component;
//use yii\helpers\Url;
//use app\modules\config\models\Config;
use app\modules\admin\models\Structure;

class Page extends Component
{
    
    public static $root;
    
    public static $current;
    public $currentId;
    public static $currentTitle;
    public static $description;
    
    
    public function init() {
        
//        $this->root = [];
        $this->getBreadcrumbs();
//        $enabled = Config::get('site.close');
//        $uri =  Yii::$app->request->url;
//        if($enabled && preg_match('/^\/(admin|login|logout)/i', $uri)===0) {
//            Yii::$app->catchAll = ['main/default/cap'];
//        }
    }
    
    
    public static function isMain() {
        return Yii::$app->defaultRoute === Yii::$app->requestedRoute;
    }
    
//    public function getCurrent() {
//        return $this->current;
//    }
    
    public function getParentTitle() {
        return $this->root->title;
    }

//    public function getTitle() {
////        return $this->current->title;
//        return $this->current->name;
//    }


    
    
    /*
     * set $root
     */
    public static function setRoot($part) {
        self::$root = $part;
    }
    
    
    /*
    * set $current
    */
    public static function setCurrent($part) {
        self::$current = $part;
    }
    
    
    /*
    * get root part
    */
    public static function getRoot() {
        // TODO:: move in SlugUrlRule component
        if(self::isMain())
            return Structure::find()->where(['id' => 1])
                ->cache(YII_DEBUG ? -1 : Yii::$app->params['cacheTime']['long'])->one();
        
        return self::$root;
    }
    
    
    /*
    * get current part
    */
    public static function getCurrent() {
        return self::$current;
    }
    
    
    /*
    * get current name (!not title)
    */
    public static function getName() {
       return self::$currentTitle
            ? self::$currentTitle
            : (self::$current ? self::$current->name : null);
    }
    
    
    /*
    * get current title
    */
    public static function getTitle() {
        if(self::isMain()) {
            return Structure::findOne(1)->title;
        } else {
           return self::$currentTitle
                ? self::$currentTitle
                : (self::$current ? self::$current->title : null);
        }
    }
    
    
    /*
    * set current title
    */
    public static function setTitle($title) {
        return self::$currentTitle = $title;
    }
    
    
    /*
    * get current title
    */
    public static function getDescription() {
        if(!empty(self::$description))
        {
            return self::$description;
        }
        elseif(self::isMain())
        {
            return Structure::findOne(1)->description;
        }
        else
        {        
            return self::$current ? self::$current->description : null;
        }
    }    
    
    /*
    * set description
    */
    public static function setDescription($value) {
        self::$description = $value;
        return true;
    }


    /*
    * get breadcrumbs
    */
    public static function getBreadcrumbs($partActive = false) {
        $root = self::getRoot();
        $current = self::getCurrent();
        if(!$root && !$current) {
            return Yii::$app->params['breadcrumbs'];
        }

        if($root->id !== $current->id && $root->id != 1) {
            Yii::$app->params['breadcrumbs'][] = [
                'label' => $root->name,
                'url' => $root->getRoute(),
            ];
        }
        if($root->id !== $current->id && $root->id != $current->parent->id && $current->id != $current->parent->id) {
            Yii::$app->params['breadcrumbs'][] = [
                'label' => $current->parent->name,
                'url' => $current->parent->getRoute(),
            ];
        }
        Yii::$app->params['breadcrumbs'][] = [
            'label' => $current->name,
            'url' => $partActive ? $current->getRoute() : null
        ];
        return Yii::$app->params['breadcrumbs'];
    }    
}