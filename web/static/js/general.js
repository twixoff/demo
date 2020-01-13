$(document).ready(function() {

    // home page
    $('.section-numbered.num-1').addClass('num-loaded');

    // floating navbar
    $(document).on('scroll', function() {
        stickMenu(); checkToTop();

        // animate numbers
        var vT = $(document).scrollTop() + $(window).height() - 150;
        $('.number-animation').each(function(indx, el) {
            var box = $(el);
            if(vT >= box.offset().top) {
                var num = box.data('num');
                box.removeClass('number-animation').animateNumber({ number: num }, 2000);
            }
        });
    });
    stickMenu(); checkToTop();

    function stickMenu() {
        var top = $(window).scrollTop();
        if(top > 100) {
            $('.header').addClass('slim');
            // $('body').css({'padding-top': 10});
        } else {
            $('.header').removeClass('slim');
            // $('body').css({'padding-top': 158});
        }
    }
    function checkToTop() {
        var top = $(window).scrollTop();
        if(top > 200) {
            $('.btn-to-top').fadeIn();
        } else {
            $('.btn-to-top').fadeOut();
        }
    }
    $('.btn-to-top').click(function(e) {
        e.preventDefault();
        $.scrollTo(0, {duration: 500});
    });

    $('.has-navbar-sub').hover(function() {
            $('.overlay').stop().fadeIn(100); // addClass('show');
        },
        function() {
            $('.overlay').stop().fadeOut(100); // removeClass('show');
    });

    // mobile menu
    $('.navbar-nav-mobile span.nav-link').click(function() {
        var id = $(this).data('id');
        $('.navbar-nav-mobile').css({'left': '-100%'});
        $('.navbar-nav-mobile .menu-level-2[data-id="'+id+'"]').css({'order': 2});
    });
    $('.navbar-nav-mobile .back-link').click(function() {
        $('.navbar-nav-mobile').css({'left': 0});
        $('.navbar-nav-mobile .menu-level-2').css({'order': 3});
    });

    // show/hide search bar
    $('.navbar-search button').click(function(e) {
        if(!$('.navbar-search').hasClass('focus')) {
            e.preventDefault();
            $('.navbar-search').addClass('focus');
        }
    });
    $(document).on('click', function(e) {
        if(!$(e.target).closest('.navbar-search').length && $('.navbar-search').hasClass('focus')) {
            $('.navbar-extra ul').removeClass('d-none');
            $('.navbar-search').removeClass('focus');
        };
    });

    var leftArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="20px" viewBox="0 0 12 20"><path d="M11.100,0.174 C11.375,0.446 11.375,0.889 11.100,1.162 L2.319,9.855 L11.100,18.565 C11.375,18.837 11.375,19.280 11.100,19.553 C10.825,19.826 10.378,19.826 10.103,19.553 L0.841,10.366 C0.703,10.230 0.635,10.059 0.635,9.872 C0.635,9.701 0.703,9.514 0.841,9.377 L10.103,0.191 C10.378,-0.099 10.825,-0.099 11.100,0.174 Z"/></svg>';
    var rightArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11px" height="20px" viewBox="0 0 12 20"><path d="M0.423,0.174 C0.148,0.446 0.148,0.889 0.423,1.162 L9.204,9.855 L0.423,18.565 C0.148,18.837 0.148,19.280 0.423,19.553 C0.698,19.826 1.145,19.826 1.419,19.553 L10.682,10.366 C10.820,10.230 10.888,10.059 10.888,9.872 C10.888,9.701 10.820,9.514 10.682,9.377 L1.419,0.191 C1.145,-0.099 0.698,-0.099 0.423,0.174 Z"/></svg>';
    // home page
    // fabric carousel
    $('.slider-fabric .owl-carousel').on('initialized.owl.carousel', function (event) {
        updateCounter(event.item.index+1, event.item.count);
    });
    $('.slider-fabric .owl-carousel').owlCarousel({
        items: 1,
        dots: false,
        nav: true,
        navText: [leftArrowSvg, rightArrowSvg],
        loop: false,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    $('.slider-fabric .owl-carousel').on('changed.owl.carousel', function (event) {
        updateCounter(event.item.index+1, event.item.count);
    });
    function updateCounter(current, total) {
        if(current.toString().length == 1) {
            current = '0'+current.toString();
        };
        if(total.toString().length == 1) {
            total = '0'+total.toString();
        };
        $('.slider-fabric .slider-counter').html("<b>"+current+"</b> <span>/</span> "+total);
    }
    // second carousel
    $('.slider-category .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        navText: [leftArrowSvg, rightArrowSvg],
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    // projects carousel
    $('.slider-projects .owl-carousel').on('initialized.owl.carousel', function (event) {
        // $('.slider-projects .header .title').text($('.slider-projects .owl-item.active img').attr('title'));
        var title = $('.slider-projects .owl-carousel .owl-item').eq(event.item.index).find('img').attr('title');
        $('.slider-projects .section-header .title').text(title);
    });
    $('.slider-projects .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        navText: [leftArrowSvg, rightArrowSvg],
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
    $('.slider-projects .owl-carousel').on('changed.owl.carousel', function (event) {
        var title = $('.slider-projects .owl-carousel .owl-item').eq(event.item.index).find('img').attr('title');
        $('.slider-projects .section-header .title').text(title);
    });

    // portfolio gallery
    $('.portfolio-gallery .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        navText: [leftArrowSvg, rightArrowSvg],
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });


    new WOW().init();

    // section num fadeIn
    $('.slider-category').on('animationend webkitAnimationEnd', function() {
        $('.section-numbered.num-2').addClass('num-loaded');
    });
    $('.section-new-items .new-item-left').on('animationend webkitAnimationEnd', function() {
        $('.section-numbered.num-3').addClass('num-loaded');
    });
    $('.section-numbered.num-4').on('animationend webkitAnimationEnd', function() {
        $('.section-numbered.num-4').addClass('num-loaded');
    });
    $('.section-numbered.num-5').on('animationend webkitAnimationEnd', function() {
        $('.section-numbered.num-5').addClass('num-loaded');
    });


    // product quick order
    $("[data-modal-url]").on('click', function(e) {
        e.preventDefault();
        var modalUrl = $(this).data('modal-url');
        // var modalTitle = $(this).data('modal-title');
        $.get(modalUrl, function(data) {
            // $('#modal-free .modal-title').html(modalTitle);
            $('#modal-free .modal-content').html(data);
            $('#modal-free').modal('show');
        });
    });



    // // ajax-form loader
    // $(document).on('beforeSubmit', '.ajax-form', function (event, messages, errorAttributes) {
    //     var form = $(this);
    //     var submitBtn = form.find('[type=submit]');
    //     submitBtn.addClass('disabled').attr('disabled', 'disabled');
    // });


    // // callback form submit
    // // $(document).on('beforeSubmit', '#form-callback', function(e) {
    // $('#form-callback').on('beforeSubmit', function(e) {
    //     console.log('asd');
    //
    //     var form = $(this);
    //     var submitBtn = form.find('[type=submit]');
    //     // submitBtn.addClass('disabled').attr('disabled', 'disabled');
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         type: 'post',
    //         dataType: 'json',
    //         data: form.serialize(),
    //         success: function(data) {
    //             if(data.success) {
    //                 form[0].reset();
    //                 $('#modal-free .modal-content').html(data.view);
    //                 $('#modal-free').modal('show');
    //             }
    //         },
    //         error: function() {
    //             alert('Проищошла ошибка.\nПожалуйста, попробуйте повторить.');
    //         },
    //         complete: function() {
    //             submitBtn.removeClass('disabled').removeAttr('disabled');
    //         }
    //     });
    //     e.preventDefault();
    // }).on('submit', function(e) {
    //     e.preventDefault();
    // });


    // yii2 + bs4 fix
    $('form').on('beforeValidate', function (event) {
        // $(event.target).removeClass('was-validated');
    }).on('afterValidate', function (event, messages, errorAttributes) {
        // $(event.target).addClass('was-validated');
        // console.log(event, messages, errorAttributes);
        if(Object.keys(messages).length) {
            $.each(messages, function(id, text) {
                var input = $('#'+id);
                console.log(input, id, text);
                input.removeClass('is-invalid s-valid');
                if(text.length) {
                    input.addClass('is-invalid');
                } else {
                    input.addClass('is-valid');
                }
            })
        }
    }).on('beforeSubmit', function (event) {
    }).on('ajaxComplete', function (event) {
    });

}); //-- $(document).ready


function initMaps() {
    $(".block-map").each(function(indx, el) {
        createSingleMap($(el).attr('id'));
    });
}


function createSingleMap(id) {
    placePoint = $("#"+id).data("coord").split(',');
    var centerMap = [placePoint[0],placePoint[1]];
    mainYaMap = new ymaps.Map (id, {
        center: centerMap, 
        zoom: 11,
        controls: ['zoomControl', 'typeSelector',  'fullscreenControl'] 
    });
    mainYaMap.behaviors.disable("scrollZoom");
    
    placemark = window.placemark = new ymaps.Placemark(centerMap, {}, {
        preset: 'islands#blueDotIcon'
    });
    mainYaMap.geoObjects.add(placemark);
}


function initMap() {
    var windowWidth = $(window).width();
    // var mapCenter = windowWidth > 768 ? {lat: 43.238099, lng: 76.967116} : {lat: 43.243099, lng: 76.957116};
    var mapCenter = {lat: 43.235864, lng: 76.957333};
    var map = new google.maps.Map(document.getElementById('contact-map'), {
        center: mapCenter,
        scrollwheel: false,
        // disableDefaultUI: false,
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        zoom:  windowWidth > 768 ? 15 : 14,
        styles: [
            {"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "on"}]},
            {"featureType": "all", "elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]},
            {"featureType": "all", "elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]},
            {"featureType": "all", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
            {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#000000"}, {"lightness": 20}]},
            {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]},
            {"featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{"color": "#838383"}]},
            {"featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{"color": "#c4c4c4"}]},
            {"featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [{"color": "#aaaaaa"}]},
            {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 20}]},
            {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 21}, {"visibility": "on"}]},
            {"featureType": "poi.business", "elementType": "geometry", "stylers": [{"visibility": "on"}]},
            {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#6e6e6e"}, {"lightness": "0"}]},
            {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"visibility": "off"}]},
            {"featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]},
            {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 18}]},
            {"featureType": "road.arterial", "elementType": "geometry.fill", "stylers": [{"color": "#575757"}]},
            {"featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]},
            {"featureType": "road.arterial", "elementType": "labels.text.stroke", "stylers": [{"color": "#2c2c2c"}]},
            {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 16}]},
            {"featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{"color": "#999999"}]},
            {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 19}]},
            {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 17}]}
        ]
    });

    var marker = new google.maps.Marker({
        map: map,
        icon: {
            url: '/static/i/marker.svg',
            // size: windowWidth > 768
            //     ? new google.maps.Size(70, 90)
            //     : new google.maps.Size(30, 40),
            // anchor: windowWidth > 768
            //     ? new google.maps.Point(30, 50)
            //     : new google.maps.Point(30, 50),
            scaledSize: windowWidth > 768
                ? new google.maps.Size(65,89)
                : new google.maps.Size(50,50)
        },
        position: mapCenter
        // position: {lat: 43.236099, lng: 76.957116}
        //        title: 'Hello World!'
    });
}