$('#accordionExample .card:first button').attr("aria-expanded", "true");
$('#accordionExample .card:first .collapse').addClass("show");

// $(document).ready(function () {
//     setInterval(function () {
//         document.getElementById('listing-countdown--success').style.display = 'none';
//     }, 5000);
//     $(".CloseModalListing").click(function () {
//         $("#listing-countdown--success").css("display", "none");
//     })
//     $.simpleTicker($("#demo"), {
//         'effectType': 'roll'
//     });
// });





$(document).ready(function () {
    $('.preloader').delay(100).fadeOut(100);
});


$(function () {

    var saniye = 600;
    var sayacYeri = $(".timer-warning-time");
    $.sayimiBaslat = function () {
        if (saniye > 1) {
            saniye--;
            sayacYeri.text(saniye);
        } else {
            $("div.sayac").text("Merhabalar, ben Ali Demirci.");
        }
    }

    sayacYeri.text(saniye);
    setInterval("$.sayimiBaslat()", 1000);
});


//Buton adı değiştirme
$(document).ready(function () {
    $("body").on(".carlisttooglebutton","click",function () {
        alert("dsad");
        $(this).toggleClass("active");
        var ids = $(this).attr("id");
        if ($(this).hasClass("active")) {
            $("#main_" + ids).removeClass("shadow-sm");
            $("#main_" + ids).addClass("shadow-lg");
            $("#category > .car-item").not("#main_" + ids).removeClass("shadow-lg");
            $("#category > .car-item").not("#main_" + ids).addClass("shadow-sm");

            $(document).find(".panel-collapse").not("#main_" + ids).removeClass("show");
            $(document).find(".panel-collapse").not("#car_list" + ids).removeClass("show");
            $(document).find(".panel-collapse").not("#main_" + ids).text("İptal Et");
            $(document).find(".carlisttooglebutton").not("#car_list" + ids).text("Araç Seç");
            $(document).find(".carlisttooglebutton").not("#car_list" + ids).removeClass("active");
           // $(this).text("İptal Et");
        } else {
            $("#car_list" + ids).text("İptal Et");
        }
    });
});

$(document).ready(function () {
    $("#country").change(function () {
        var countryID = $("ul.country-list").find("li.active").attr("data-phone-code");
        $("input#phone_country").val("+" + countryID);
    });
});

$(document).ready(function () {
    $('#delivery-debit-card').click(function () {
        if ($(this).is(':checked')) {
            $("div#delivery-debit-card-box").addClass("delivery-debit-card-boxCss");
            $("div.creditCardForm").removeClass("creditCardFormShow");
            $("div.creditCardForm").addClass("creditCardForm");

            $("div#online-credit-card-box").removeClass("online-credit-card-boxCss");
            $("div#debit-box").removeClass("debit-boxCss");
            $("div#cash-box").removeClass("debitCash-boxCss");

        }
    });

    $('#online-credit-card').click(function () {
        if ($(this).is(':checked')) {
            $("div#online-credit-card-box").addClass("online-credit-card-boxCss");
            $("div.creditCardForm").addClass("creditCardFormShow");
            $("div.creditCardFormShow").addClass("creditCardForm");


            $("div#debit-box").removeClass("debit-boxCss");
            $("div#delivery-debit-card-box").removeClass("delivery-debit-card-boxCss");
            $("div#cash-box").removeClass("debitCash-boxCss");

        }
    });

    $('#debit-card').click(function () {
        if ($(this).is(':checked')) {
            $("div#debit-box").addClass("debit-boxCss");
            $("div.creditCardForm").removeClass("creditCardFormShow");
            $("div.creditCardFormShow").addClass("creditCardForm");

            $("div#online-credit-card-box").removeClass("online-credit-card-boxCss");
            $("div#delivery-debit-card-box").removeClass("delivery-debit-card-boxCss");
            $("div#cash-box").removeClass("debitCash-boxCss");
        }
    });

    $('#debit-cash').click(function () {
        if ($(this).is(':checked')) {
            $("div#cash-box").addClass("debitCash-boxCss");
            $("div.creditCardForm").removeClass("creditCardFormShow");
            $("div.creditCardFormShow").addClass("creditCardForm");

            $("div#online-credit-card-box").removeClass("online-credit-card-boxCss");
            $("div#delivery-debit-card-box").removeClass("delivery-debit-card-boxCss");
        }
    });

});



$(document).ready(function () {



    $('ul#menu_parent0 > li').on('click', function () {
            var opt = $(this);
            var val = opt.text();
            var  id = opt.attr("data-id");
            $(".kc-value-down").html(val);
            $("#pick-down-text").text(val);
            $("#pick-up-location").val(id);
            $("#pick-down-location").val(id);
            // $("input#pick-up").datepicker("show");

        });





    $('ul#menu_parent1 > li').on('click', function () {
        var opt = $(this);
        var val = opt.text();
        var  id = opt.attr("data-id");
        $("#pick-down-text").html(val + ' <span class="fas fa-caret-down"></span>');
        $("#pick-down-location").val(id);
        $("input#pick-down").datepicker("show");
        $('#menu_parent1').removeClass("ulMenuDisplayNone");
        $('#menu1').removeClass("ulMenuDisplayNone");

    });
})

$(document).ready(function () {
     $("html").on("mouseenter",".ui-state-default", function() {
        $(this).attr('title', 'Alış Tarihi Seçin');
    });
})



$(document).ready(function () {
$('#accordionExample .card:first button').attr("aria-expanded", "true");$('#accordionExample .card:first .collapse').addClass("show");
});



