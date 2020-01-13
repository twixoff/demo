$(document).ready(function() {
    
    var clipboard = new Clipboard('.copy-to-clipboard');

    clipboard.on('success', function(e) {
        $(e.trigger).tooltip({
            placement: 'top',
            trigger: 'manual',
            title: 'Скопировано!'
        }).tooltip('show');
        setTimeout(function() { $(e.trigger).tooltip('hide') }, 1000);
    });

    // sortable gallery
    if($(".gallery-widget .row").length) {
        var gridList = $(".gallery-widget .row");
        var initialIndex = [];
        $('.col-xs-4', gridList).each(function () {
            initialIndex.push($(this).data('key'));
        });
            
        gridList.sortable({
            handle: ".btn-move",
            update: function () {
                var items = {};
                $('.col-xs-4', gridList).each(function (i, el) {
                    var currentKey = $(this).data('key');
                    if (initialIndex[i] != currentKey) {
                        items[currentKey] = initialIndex[i];
                        initialIndex[i] = currentKey;
                    }
                });

                $.ajax({
                    'url': $(".gallery-widget").data('action'),
                    'type': 'post',
                    'data': {'items': JSON.stringify(items)},
                    'success': function () {
//                        widget.trigger('sortableSuccess');
                    },
                    'error': function (request, status, error) {
                        alert(status + ' ' + error);
                    }
                });
            }
        }).disableSelection();
    }


}); //-- $(document).ready


function initMap() {
    if(!$("#ya-map-script").length) {
        $("head").append('<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU&onload=createMap" type="text/javascript" id="ya-map-script"></script>');
    } else {
        createMap();
    }
}

function createMap() {
    var centerMap = $("#map").data("coord");
     mainYaMap = new ymaps.Map ("map", {
            center: centerMap, 
            zoom: 9,
            controls: ['zoomControl','searchControl']
    });
    var searchControl = mainYaMap.controls.get('searchControl');
    searchControl.options.set('noPlacemark', true);

    myPlacemark = new ymaps.Placemark(centerMap, {}, {
        /*iconImageHref: '/img/map-marker.png',*/
        /*iconImageSize: [64, 83],*/
        draggable: true,
        cursor: "move"
    });
    mainYaMap.geoObjects.add(myPlacemark);

    myPlacemark.events.add('dragend', function (event) {
        $("#infoblocks-map").val(event.get('target').geometry.getCoordinates());
    });
    searchControl.events.add('resultshow', function (e) {
        var resultIndex = searchControl.getSelectedIndex();
        var coords = searchControl.getResultsArray()[resultIndex].geometry.getCoordinates();
        myPlacemark.geometry.setCoordinates(coords);
        $("#infoblocks-map").val(coords);
    }, this);
}