/*======================================================
* Template Name: Plesir - Car & Travel Mobile Template
* Version: 1.0
* Author: HidraTheme
* Developed By: HidraTheme
* Author URL: https://themeforest.net/user/hidratheme
======================================================*/

(function ($) {

    "use strict";

    /* PRELOADER */
    $(window).on('load', function () {
        $(".preloading").fadeOut("slow");
    });

    /* SIDE NAVIGATION */
    $('#dismiss, .overlay').on('click', function () {
        $('#sidebarleft').removeClass('active');
        $('#sidebarright').removeClass('active');
        $('.overlay').removeClass('active');
        $('body').removeClass('noscroll');
    });

    $('#sidebarleftbutton,#sidebarrightbutton').on('click', function () {
        $('.overlay').addClass('active');
        $('body').addClass('noscroll');
    });

    $('#sidebarleftbutton').on('click', function () {
        $('#sidebarleft').addClass('active');
    });

    $('#sidebarrightbutton').on('click', function () {
        $('#sidebarright').addClass('active');
    });


    /* HOMEPAGE - CAROUSEL SLIDER */
    $('.img-hero').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: false
    });


    /* DEFAULT CAROUSEL */
    $('.default-carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: false,
        arrows: false,
        variableWidth: true
    });


    /* DATE PICKER */
    $('.date-start-class').datepicker({
        uiLibrary: 'bootstrap'
    });
    $('.date-end-class').datepicker({
        uiLibrary: 'bootstrap'
    });

    /* GALLERY - FILTERING FUCTION */
    $(".filter-button").on("click", function () {
        var value = $(this).data('filter');

        if (value == "gallery-show-all") {
            $('.gallery-img-box').removeClass("gallery-hidden");
        } else {
            $('.gallery-img-box:not([data-category-image*="' + value + '"]').addClass("gallery-hidden");
            $('.gallery-img-box[data-category-image*="' + value + '"]').removeClass("gallery-hidden");
        }
    });

    $('.filter-gallery .filter-button').on("click", function () {
        $('.filter-gallery').find('.filter-button.active').removeClass('active');
        $(this).addClass('active');
    });


    /* MAGNIFICPOPUP GALLERY */
    $(".gallery-list").magnificPopup({
        type: "image",
        removalDelay: 300
    });


    $(".timepicker1").click(function () {
        $("#sx-js-res-pu-time-list").css('display', 'block');
         hours(".ddlist-ul","#sx-js-res-pu-time-list");
    });

    $(".timepicker2").click(function () {
        $("#sx-js-res-pu-time-list2").css('display', 'block');
        hours(".ddlist-ul2","#sx-js-res-pu-time-list2");
    });

    function hours(parameter,parameter2)
    {
        $(parameter2).css('display', 'block');
        var hours = ['00:00', '00:15', '00:30', '00:45', '01:00', '01:15', '01:30', '01:45', '02:00', '02:15', '02:30', '02:45', '03:00', '03:15', '03:30', '03:45',
            '04:00', '04:15', '04:30', '04:45', '05:00', '05:15', '05:30', '05:45', '06:00', '06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30', '07:45',
            '08:00', '08:15', '08:30', '08:45', '09:00', '09:30', '10:00', '10:15', '10:30', '10:45', '11:00', '11:15', '11:30', '11:45', '12:00', '12:15', '12:30',
            '12:45', '13:00', '13:15', '13:30', '13:45', '14:00', '14:15', '14:30', '14:45', '15:00', '15:15', '15:30', '15:45', '16:00', '16:15', '16:30', '16:45',
            '17:00', '17:15', '17:30', '17:45', '18:00', '18:15', '18:30', '18:45', '19:00', '19:15', '19:30', '19:45', '20:00', '20:15', '20:30', '20:45', '21:00',
            '21:15', '21:30', '21:45', '22:00', '22:15', '22:30', '22:45', '23:00', '23:15', '23:30', '23:45', '24:00'];
        $.each(hours, function (index, value) {
            $(parameter).append("<li  class='dlist-selected' data-time='" + value + "'>" + value + "</li>");
        });
    }


    $("#sx-js-res-pu-time-list").on("click","li",function () {
        var time = $(this).attr('data-time');
        $(".timepicker1").val(time);
        $("#sx-js-res-pu-time-list").css('display', 'none');
    })

    $("#sx-js-res-pu-time-list2").on("click","li",function () {
        var time = $(this).attr('data-time');
        $(".timepicker2").val(time);
        $("#sx-js-res-pu-time-list2").css('display', 'none');
    })
})(jQuery);


