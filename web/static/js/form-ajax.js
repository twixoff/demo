$(document).ready(function(){

//    $('.form-ajax').submit(function (e) {
//        e.preventDefault();
//        console.log('submit');
//    });

//     $('.form-ajax').on('beforeValidate', function (event) {
// //        console.log('form-ajax beforeValidate');
//         $(event.target).find('button[type=submit]').addClass('disabled').attr('disabled', 'disabled');
//     }).on('afterValidate', function (event) {
// //        console.log('form-ajax afterValidate');
//         $(event.target).find('button[type=submit]').removeClass('disabled').removeAttr('disabled');
//     }).on('beforeSubmit', function (event) {
// //        console.log('form-ajax beforeSubmit');
// //         event.preventDefault();
//         $(event.target).find('button[type=submit]').addClass('disabled').attr('disabled', 'disabled');
//     }).on('ajaxComplete ', function (event) {
// //        console.log('form-ajax ajaxComplete');
//         $(event.target).find('button[type=submit]').removeClass('disabled').removeAttr('disabled');
//     });


    // yii2 + bs4 fix
    $('form').on('afterValidateAttribute', function (event, attribute, message) {
        var input = $(attribute.input);
        input.removeClass('is-invalid is-valid');
        if(message.length) {
            input.addClass('is-invalid');
        } else {
            input.addClass('is-valid');
        }
    });


});//--    $(document).ready(function(){})