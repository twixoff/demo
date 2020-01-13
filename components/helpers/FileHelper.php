<?php

namespace app\components\helpers;
use yii\helpers\BaseFileHelper;

class FileHelper extends BaseFileHelper
{
    public static function checkPath($path) {
        if(!file_exists($path)) {
            FileHelper::createDirectory($path);
        }
    }
}