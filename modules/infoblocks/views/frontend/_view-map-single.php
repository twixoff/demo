<div class="info-block-map">
    <div id="map-<?= $model->id?>" data-coord="<?= $model->map?>" class="block-map"></div>
</div>

<?php $this->registerJsFile("//api-maps.yandex.ru/2.1/?load=package.standard&lang=ru-RU&onload=initMaps", [
    'position' => yii\web\View::POS_END,
    'depends' => 'app\assets\AppAsset'
]); ?>