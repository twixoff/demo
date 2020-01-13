function initMap() {
    if(!$("#ya-map-script").length) {
        $("head").append('<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU&onload=initMaps" type="text/javascript" id="ya-map-script"></script>');
    } else {
        initMaps();
    }
}

function initMaps() {
    $('.map-area').each(function(indx, el){
        createMap($(el).attr('id'));
    });
}

function createMap(id) {
    if($('#'+id+' ymaps').length) return true;
    var centerMap = $('#'+id).data("coords");
    var mainYaMap = new ymaps.Map (id, {
        center: centerMap, 
        zoom: 12,
        controls: ['zoomControl','searchControl']
    });
    var searchControl = mainYaMap.controls.get('searchControl');
    searchControl.options.set('noPlacemark', true);

    var myPlacemark = new ymaps.Placemark(centerMap, {}, {
        /*iconImageHref: '/img/map-marker.png',*/
        /*iconImageSize: [64, 83],*/
        draggable: true,
        cursor: "move"
    });
    mainYaMap.geoObjects.add(myPlacemark);
    myPlacemark.events.add('dragend', function (event) {
        $("#infoblocks-content-"+$('#'+id).data('field-id')+"-coords").val(event.get('target').geometry.getCoordinates());
    });
    searchControl.events.add('resultshow', function (e) {
        var resultIndex = searchControl.getSelectedIndex();
        var coords = searchControl.getResultsArray()[resultIndex].geometry.getCoordinates();
        myPlacemark.geometry.setCoordinates(coords);
        $("#infoblocks-content-"+$('#'+id).data('field-id')+"-coords").val(coords);
    }, this);
}

$(document).ready(function(){
    
    $('.add-map').click(function(e){
        e.preventDefault();
        var countMap = $('.map-area').length ? $('.map-area').length+1 : 1;
        var mapId = 'map-'+countMap;
        var mapTemplate = "<div class='map-item-wrap' id='map-item-wrap-"+countMap+"' style='display: none;'>";
            mapTemplate += "<div class='form-group'>";
                mapTemplate += "<label class='control-label' for='infoblocks-content-"+countMap+"-title'>Заголовок карты</label>";
                mapTemplate += "<input type='text' id='infoblocks-content-"+countMap+"-title' class='form-control' name='InfoBlocks[content]["+countMap+"][title]'>";
                mapTemplate += "<input type='hidden' id='infoblocks-content-"+countMap+"-coords' name='InfoBlocks[content]["+countMap+"][coords]'>";
            mapTemplate += "</div>";
            mapTemplate += "<div class='form-group'>";
                mapTemplate += "<div id='"+mapId+"' class='map-area' data-coords='[43.243347461380935,76.93661499023267]' data-field-id='"+countMap+"'></div>";
            mapTemplate += "</div>";
            mapTemplate += "<a href='#' class='btn btn-info remove-map pull-right' style='position: relative;top: -49px;'><i class='fa fa-minus'></i> Удалить карту</a>";
        mapTemplate += "</div>";

        $(mapTemplate).insertBefore($(this).parent('.form-group'));
        $('#map-item-wrap-'+countMap).fadeIn();
        initMap();
    });

    $(document).on('click', '.remove-map', function(e){
        e.preventDefault();
        $(this).parent('.map-item-wrap').fadeOut(400, function() {
            $(this).remove();
        });
    });
    
});//-- $(document).ready