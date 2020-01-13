<?php

namespace app\components;

use Yii;
use yii\base\BaseObject;
use yii\helpers\VarDumper;
use yii\web\UrlRuleInterface;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\Structure;

class SlugUrlRule extends BaseObject implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        $slug = trim($route, '/');
//        $slugArray = explode('/', trim($route, '/'));
//        $part = Structure::getBySlug($slugArray[0]);
        $part = Structure::getBySlug($slug);
//        $part = Page::getCurrent();
        
//        echo $route;
           
        // news module rules
        if ($route === 'news/frontend/index') {         // news pagination
            $part = Structure::findOne($params['parentId']);
            if($params['page'] > 1) {
                return $part->slug .'?page='. $params['page'];
            }
            return $part->slug;
        } elseif ($route === 'news/frontend/view') {    // news single view
            return $part->slug .'/'. $params['id'];
        } elseif($part && $part->type_id == 50) {
            $child = Structure::getTree($part->id);
            if(isset($child[0])) return $child[0]->slug;
        }
        
        // lessons module rules
        if ($route === 'lessons/frontend/send-order') {
            return 'lessons/send-order';
        }
            
        return false;  // this rule does not apply
//        if ($route === 'pages/view') {
//            if (isset($params['id'])) {
//                $part = Structure::findOne(['id' => $params['id']]);
//                return $part->slug;
//            } elseif (isset($params['manufacturer'])) {
//                return $params['manufacturer'];
//            }
//        }
//        
//        if ($route === 'car/index') {
//            if (isset($params['manufacturer'], $params['model'])) {
//                return $params['manufacturer'] . '/' . $params['model'];
//            } elseif (isset($params['manufacturer'])) {
//                return $params['manufacturer'];
//            }
//        }
    }
    

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        // home page
        if($pathInfo === '') {
            $part = Structure::findOne(1);
            Page::setRoot($part);
            Page::setCurrent($part);

            return $this->getRouteByPart($part);
        }


        // find int in the end
        if (preg_match('/^(.*)\/([\d]+)$/i', $pathInfo, $matches)) {
            $id = $matches[2];
            if(($part = Structure::getBySlug($matches[1])) !== null)
            {
                if($part->isLock)
                {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
                //            TODO:: set parts
                $root = $part->parent ? $part->parent : $part;
                Page::setRoot($root);
                Page::setCurrent($part);

                return $this->getRouteByPart($part, $id);
            }
        }

        $part = Structure::getBySlug($pathInfo);
        if($part)
        {
            if($part->isLock)
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

//            VarDumper::dump($part, 100, true);exit();
            if(!is_null($part->parent_id)) {
                // find the root part by the level up
                $root = $part->parent;
//                $parentPart3 = !empty($parentPart2->parent) ? $parentPart2->parent : null;
                // TODO:: get 2/3/4 levels root
            } else {
                $root = $part;
            }

            Page::setRoot($root);
            Page::setCurrent($part);

            return $this->getRouteByPart($part);
        }
        
        if (preg_match('%^([\w\-]+)(/([\w\-]+))?$%', $pathInfo, $matches)) {
            
//            TODO:: if(int)
//            print_r($matches);exit();
           
            if(is_numeric(end($matches))) {
                $slug = $matches[count($matches) - 3];
                $id = end($matches);
            } else {
                $slug = end($matches);
                $id = null;
            }
                    
            $part = Structure::getBySlug($slug);
            if($part) {
                Yii::$app->page->current = $part;
                if($part->parent_id != 1) {
                    Yii::$app->page->root = Structure::findOne(['id' => $part->parent_id]);
                    Yii::$app->page->current = $part;
                } else {
                    Yii::$app->page->root = $part;
                    Yii::$app->page->current = $part;
                }

                return $this->getRouteByPart($part, $id);
            } else {
                return false;
            }
            
            
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $params['manufacturer'] and/or $params['model']
            // and return ['car/index', $params]
        }
        return false;  // this rule does not apply
    }
    
    
    public function getRouteByPart($part, $id = null) {
        $partRoute = Yii::$app->params['structureTypes'][$part->type_id]['route'];
        switch($part->type_id) {
            // TODO:: route брать из параметров +заментья index на view, если нужно?
            case 1:
//                $route = [$partRoute, ['parentId' => $part->id]];
                $route = ['/main/default/index', ['parentId' => $part->id]];
                break;
            case 2: 
                $route = [$partRoute, ['parentId' => $part->id]];
                break;
            case 4: 
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            case 6:
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            case 7: 
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            case 8:
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            case 9:
                $route = [$partRoute, ['parentId' => $part->id]];
                break;
            case 20: 
            case 30: 
            case 40: 
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            // shop module
            case 60: 
                $route = is_null($id)
                    ? [$partRoute, ['parentId' => $part->id]]
                    : [str_replace('/index', '/view', $partRoute), ['id' => $id]];
                break;
            case 61:
                $route = is_null($id)
                    ? [str_replace('/serie', '/list', $partRoute), ['parentId' => $part->id]]
                    : [str_replace('/serie', '/view', $partRoute), ['id' => $id]];
                break;
            case 62:
            case 63:
                $route = [$partRoute, ['parentId' => $part->id]];
                break;
            case 65:
                $route = is_null($id)
                    ? [str_replace('/fabric', '/fabric-index', $partRoute), ['parentId' => $part->id]]
                    : [str_replace('/fabric', '/fabric-view', $partRoute), ['id' => $id]];
                break;

            case 100: 
                $route = [$partRoute, ['parentId' => $part->id]];
                break;

            case 500:
                $route = $partRoute;
                break;
            default:
                $route = false;
                break;
        }
        return $route;
    }
}