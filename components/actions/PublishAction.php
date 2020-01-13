<?php

namespace app\components\actions;

use Yii;
use yii\base\Action;

/**
 * Action for sortable Yii2 GridView widget.
 *
 * For example:
 *
 * ```php
 * public function actions()
 * {
 *    return [
 *       'publish' => [
 *          'class' => PublishAction::className(),
 *          'modelName' => Model::className(),
 *       ],
 *   ];
 * }
 * ```
 *
 * @author twixoff
 */
class PublishAction extends Action
{
    public $modelName;
    public $attribute = 'is_publish';

    public function run($id)
    {
        $model = new $this->modelName;
        $item = $model->findOne($id);

        $item->{$this->attribute} = (int)!$item->{$this->attribute};
        if($item->update(false)) {
            if($item->hasAttribute('structure_id')) {
                return Yii::$app->getResponse()->redirect(['admin/' . $this->controller->module->id . '/index', 'id' => $item->structure_id]);
            } else {
                return Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getReferrer());
            }
        } else {
            echo $item->id;
        }
    }
}