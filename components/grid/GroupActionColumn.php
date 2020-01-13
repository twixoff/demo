<?php

namespace app\components\grid;

use Yii;
use yii\helpers\Html;
use yii\grid\ActionColumn;

class GroupActionColumn extends ActionColumn {
    
    public $buttons;
    public $contentOptions = ['style' => 'width: 100px; text-align: right;'];
    public $template = '{publish} {view} {update} {delete}';
    public $buttonOptions = ['class' => 'btn btn-xs btn-default'];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        // add hide/visible button
        if (!isset($this->buttons['publish'])) {
            $this->buttons['publish'] = function ($url, $model, $key) {
                $options = array_merge($this->buttonOptions, [
                    'title' => Yii::t('yii', 'Publish/Unpublish'),
                    'aria-label' => Yii::t('yii', 'Publish/Unpublish'),
                    'data-pjax' => '1',
                ]);
                return $model->hasAttribute('is_publish')
                        ? ($model->is_publish
                            ? Html::a('<span class="fas fa-eye-slash"></span>', $url, $options)
                            : Html::a('<span class="fas fa-eye"></span>', $url, $options) )
                        : '';
            };
        }
        
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge($this->buttonOptions, [
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ]);
                return Html::a('<span class="fas fa-pen"></span>', $url, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge($this->buttonOptions, [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
                return Html::a('<span class="fas fa-trash"></span>', $url, $options);
            };
        }        

        $this->template = '<div class="btn-group">' . $this->template . '</div>';
        
        parent::init();
    }

}