<?php

namespace app\components\helpers;
use yii\helpers\BaseStringHelper;

class YoutubeHelper extends BaseStringHelper
{
    public static function getId($url) {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        } else {
            return false;
        }
    }
}