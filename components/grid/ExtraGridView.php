<?php

namespace app\components\grid;

use twixoff\sortablegrid\SortableGridView;

class ExtraGridView extends SortableGridView {

    public $enableSort = false;
    public $layout = '{items}<div class="clearfix"><div class="pull-left">{pager}</div><div class="pull-right">{summary}</div></div>';
    public $tableOptions = ['class' => 'table table-bordered table-hover'];
    public $pager = [
        'firstPageLabel' => '&laquo;&laquo;',
        'lastPageLabel' => '&raquo;&raquo;'
    ];

    public $formatter = [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '-'
    ];

    protected function registerWidget()
    {
        if($this->enableSort) {
            return parent::registerWidget();
        }
    }

    public static function pageTotal($dataProvider, $fieldName) {
        $total = 0;
        if (!empty($dataProvider->getModels())) {
            foreach ($dataProvider->getModels() as $key => $val) {
                $total += $val->{$fieldName};
            }
        }
        return $total;
    }
}