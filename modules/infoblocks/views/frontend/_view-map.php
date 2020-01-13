<?php $mapId = "map-".$model->id ?>
<div class="info-block-map">
    <ul class="map-placemarks">
        <?php if(is_array($model->content)) : ?>
            <?php foreach($model->content as $m) : ?>
                <li data-coord="<?= $m['coords'] ?>" data-target-map="<?= $mapId ?>"><?= $m['title'] ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <div id="map-<?= $model->id?>" data-coord="<?= $model->map?>" class="block-map"></div>
    <div id="<?= $mapId ?>" class="map-wrap"></div>
</div>
<?php $this->registerJsFile('//api-maps.yandex.ru/2.1/?lang=ru_RU&onload=yamapsinit', ['position' => \yii\web\View::POS_END]) ?>

<?php $yamapsinitJs = "
var maps = {};
function yamapsinit() {
    if($('.map-wrap').length) {
        $('.map-wrap').each(function(indx, el) {
            var mapId = $(el).attr('id');
            maps[mapId]= new ymaps.Map(mapId, {
                center: [43.244402,76.919544],
                zoom: 16,
                controls: ['zoomControl']
            });
            maps[mapId].behaviors.disable('scrollZoom');
        });
    }
}";
$this->registerJs($yamapsinitJs, \yii\web\View::POS_END);

$setPlacemarkJs = "
$('.info-block-map .map-placemarks li').click(function() {
    var coords = $(this).data('coord').split(',');
    var mapId = $(this).data('target-map');
    $(this).addClass('active').siblings().removeClass('active');
    placemark = new ymaps.Placemark([coords[0],coords[1]], {}, {
        //preset: 'islands#darkBlueCircleDotIcon'
        preset: 'islands#darkBlueDotIcon',
    });
    maps[mapId].geoObjects.add(placemark);
    maps[mapId].panTo( [parseFloat(coords[0]),parseFloat(coords[1])], {flying: true, duration: 500} );    
});";
$this->registerJs($setPlacemarkJs, \yii\web\View::POS_READY);
$this->registerJs("ymaps.ready(function () { $('.info-block-map .map-placemarks li').first().trigger('click'); });", \yii\web\View::POS_READY);
?>