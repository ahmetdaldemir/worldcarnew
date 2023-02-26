$(function () {
    $('#pick-up').datepicker({
        numberOfMonths:1,
        minDate: '0',
        monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
        dayNamesMin: ["Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct"],
        beforeShow: function (input, inst) {
            $("#ui-datepicker-div").removeClass('pick-down');
            $("#ui-datepicker-div").addClass('ui-widget-content');
        },
        onSelect: function (dateString, txtDate) {
            var result = dateString.split('-');
            $("#calendar123").find(".day").html(result[2]);
            var loIsDate = new Date(dateString);

            var gun = loIsDate.getDay();
            var ay = loIsDate.getMonth();
            var gunler = ['PZ', 'PZT', 'SL', 'ÇRŞ', 'PRŞ', 'CM', 'CMT'];
            var aylar = ['OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKM', 'KAS', 'ARA'];

            $("#calendar123").find(".dayName").html(gunler[gun]);
            $("#calendar123").find(".dayMounth").html(aylar[ay]);

            var newDate = loIsDate.setDate(loIsDate.getDate() + 7);

            var date = new Date(newDate);
            $("#calendar124").find(".day").html(date.getUTCDate());
            $("#calendar124").find("#pick-down").val(moment(newDate).format("YYYY-MM-DD"));

            var gun = date.getDay();
            var ay = date.getMonth();
            $("#calendar124").find(".dayName").html(gunler[gun + 7]);
            $("#calendar124").find(".dayMounth").html(aylar[ay]);
            $("input#pick-up-time").datetimepicker("show");
        }

    });
    $("#pick-up").datepicker("option", "dateFormat", "yy-mm-dd", "hide").datepicker('setDate', new Date());
    $("#calendar123").click(function (e) {
        e.preventDefault();
        $("input#pick-up").datepicker("show");
    });
});

$(function () {
    $('#pick-down').datepicker({
        numberOfMonths:1,
        minDate: '0',
        monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
        dayNamesMin: ["Pa", "Pt", "Sl", "Ça", "Pe", "Cu", "Ct"],
        beforeShow: function (input, inst) {
            $("#ui-datepicker-div").addClass('pick-down');
            $("#ui-datepicker-div").css('left', '925px !important');
            $("#ui-datepicker-div").removeClass('ui-widget-content');
            $("#ui-datepicker-div").addClass('ui-widget-content1');
        },
        afterShow: function (input, inst) {
            $("#ui-datepicker-div").css('left', '925px !important');
        },
        onSelect: function (dateString, txtDate) {
            var result = dateString.split('-');
            $("#calendar124").find(".day").html(result[2]);

            var loIsDate = new Date(dateString);
            var gun = loIsDate.getDay();

            var ay = loIsDate.getMonth();
            var gunler = ['PZ', 'PZT', 'SL', 'ÇRŞ', 'PRŞ', 'CM', 'CMT'];
            var aylar = ['OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKM', 'KAS', 'ARA'];

            $("#calendar124").find(".dayName").html(gunler[gun]);
            $("#calendar124").find(".dayMounth").html(aylar[ay]);

            $("input#pick-down-time").datetimepicker("show");

        }
    });
    $("#pick-down").datepicker("option", "dateFormat", "yy-mm-dd", "hide").datepicker('setDate', new Date().getDate());
    $("#calendar124").click(function (e) {
        e.preventDefault();
        $("input#pick-down").datepicker("show");
    });
});


$(document).ready(function () {

    var loIsDate = new Date();
    var gun = loIsDate.getDay();
    var ay = loIsDate.getMonth();
    var gunler = ['PZ', 'PZT', 'SL', 'ÇRŞ', 'PRŞ', 'CM', 'CMT'];
    var aylar = ['OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKM', 'KAS', 'ARA'];

    $("#calendar123").find(".dayName").html(gunler[gun]);
    $("#calendar123").find(".dayMounth").html(aylar[ay]);



    $("#calendar123").find(".day").html(loIsDate.getDate());


    loIsDate.setDate(loIsDate.getDate() + 7);

    var dd = loIsDate.getDate();
    var mm = loIsDate.getMonth() ;
    var y = loIsDate.getFullYear();


    $("#calendar124").find(".day").html(dd);
    $("#calendar124").find(".dayName").html(gunler[dd]);
    $("#calendar124").find(".dayMounth").html(aylar[mm]);

});


$(function () {
    $('#pick-up-time,#pick-down-time').datetimepicker({
        datepicker: false,
        format: 'H:i',
        scrollInput : false,

    });
});

// $(function () {
//     $(".hour").click(function (e) {
//         e.preventDefault();
//         $(".hour-select").show();
//     });
//     $(".hour-items").on("click",".hour-item",function (e) {
//         var dateVal = $(this).html();
//         $("#pick-up-date").val(dateVal);
//         $(".hour").html(dateVal);
//     });
//
//
// });


$(function () {
    $(".xdsoft_time_variant").on("click",".xdsoft_time",function () {
        $("#pick-down-time").val($(this).html());
    })
})






