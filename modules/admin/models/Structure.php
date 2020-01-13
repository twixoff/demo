<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use twixoff\sortablegrid\SortableGridBehavior;

class Structure extends \yii\db\ActiveRecord
{
    public $children;
    public $level;
    
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort'
            ]
        ];
    }    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%structure}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'slug'], 'required'],
            [['name'], 'trim'],
            [['name'], 'string', 'max' => 255],
            [['parent_id', 'type_id', 'sort', 'isLock', 'is_publish'], 'integer'],
            ['sort', 'integer'],
            [['dCreate'], 'safe'],
            [['description', 'slug'], 'trim'],
            [['title', 'description', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'parent_id' => 'Родительский раздел',
            'name' => 'Имя',
            'title' => 'Заголовок страницы',
            'description' => 'Описание страницы',
            'slug' => 'slug (uri адрес страницы)',
            'type_id' => 'Тип страницы',
            'sort' => 'Сортировка',
            'isLock' => 'Заблокировать',
            'is_publish' => 'Опубликовать',
            'dCreate' => 'Дата добавления',
        ];
    }


    
    /*
     * get structure types list
     */
    public static function getTypes($exclude_id = []) {
        if(is_array(\Yii::$app->params['structureTypes'])) {
            foreach(\Yii::$app->params['structureTypes'] as $k=>$v) {
                if(!in_array($k, $exclude_id)) {
                    $types[$k] = $v['title'];
                }
            }
        } else {
             $types = [];
         }
        
        return $types;
    }
    
    
    /*
     * Find part by slug.
     * Use in customUrlManager
     */
    public static function getBySlug($slug) {
        $part = self::find()->where(['slug' => $slug])->cache(YII_DEBUG ? -1 : Yii::$app->params['cacheTime']['short'])->one();
        
        return $part;
    }
    

    public function getAdminUrl() {
        $partConfig = Yii::$app->params['structureTypes'][$this->type_id];
        $route = str_replace('frontend/', '', $partConfig['route']);

        if(isset($partConfig['hasBackend']) && $partConfig['hasBackend'] === false) {
            $url = Url::to(['/admin/default/no-editable/'.$this->id]);
        } elseif(in_array($this->type_id,[61, 65])) {
            $route = str_replace('frontend/', '', $partConfig['route']).'/index';
            $url = Url::to(['/admin'.$route.'/'.$this->id]);
        } else {
            $url = Url::to(['/admin'.$route.'/'.$this->id]);
        }
        
        return $url;
    }
    
    
    public function hasChildren() {
        return self::find()->where(['parent_id' => $this->id])->count('id');
    }
    
    
    public static function getTreeFloat($parent_id = null, $children = true, $prefix = "")
    {
            $rootTree = self::find()
                ->where(['parent_id' => $parent_id])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all();
            
            $tree = [];
            foreach($rootTree as $v) {
                if($prefix) $v->name = $prefix . " " . $v->name;
                $tree[$v->id] = $v;
                if($children && $v->hasChildren()) {
                    $tree = ArrayHelper::merge($tree, self::getTreeFloat($v->id, $children, $prefix . $prefix));
                }
            }

            return $tree;
    }
    
    
    public static function getTree($parent_id = null, $children = true)
    {
            $tree = self::find()
                    ->where(['parent_id' => $parent_id])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all();
            
            if($children) {
                foreach($tree as $v) {
                    if($v->hasChildren()) {
                        $v->children = self::getTree($v->id, $children);
                    }
                }
            }

            return $tree;
    }
    
    
    public static function getMenu($parent_id = null, $children = false)
    {
            $tree = self::find()
                    ->where(['parent_id' => $parent_id, 'is_publish' => 1])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all();
            
            if($children) {
                foreach($tree as $v) {
                    if($v->hasChildren()) {
                        $v->children = self::getMenu($v->id, $children);
//                        $tree = ArrayHelper::merge($tree, self::getMenu($v->id, $children));
                    }
                }
            }

            return $tree;
    }    


    public function getParent() {
        return self::hasOne(self::class, ['id' => 'parent_id'])->cache(YII_DEBUG ? -1 : Yii::$app->params['cacheTime']['short']);
    }


    /*
     * TODO:: refactor
     */
    public function getLevel() {
        if($this->parent_id == null) {
            return 1;
        }
        if($this->parent && $this->parent->parent_id == null) {
            return 2;
        }
        if($this->parent->parent && $this->parent->parent->parent_id == null) {
            return 3;
        }
//        if($this->parent_id != 0 && $this->parent_id != 1) {
        return 4; // TODO:: get real level
    }
    
//    public function getLink() {
//        $route = Yii::$app->params['structureTypes'][$this->type_id]['route'];
////        $route = str_replace('frontend/', '', $route);
//
//        // text pages
////        if($this->type_id == 3) {
////            $id = Pages::findOne(['structure_id' => $this->id])->id;
////            $url = Url::to([$route, ['id' => $id]]);
////        } else {
////            $url = Url::to([$route, ['id' => $id]]);
////        }
//        
//        $url = Url::to([$route, 'id' => $this->id]);
//        
//        return $url;
//    }    


//    public function getName() {
//        return $this->name_en;
//    }

    
    public function getRoute() {
        return ['/'.$this->slug];
    }    


    public function getUrl() {
        return Url::to(['/'.$this->slug]);
    }    
    
    
}
