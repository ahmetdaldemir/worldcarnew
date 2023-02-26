function openNavR() {
    document.getElementById("mySidenavR").style.width = "250px";
}

function closeNavR() {
    document.getElementById("mySidenavR").style.width = "0";
}


//select tagı seçim yapıldıgında selected ekleme çıkarma
//$(document).on("change", "input[type='checkbox']", function () {
//    $("input[value='" + this.value + "']").prop("checked", true);
//});
//üye ol üye girişi ve şifremi unuttum popuplarının açılışı
$("#signUpBtn, #signInBtn").click(function () {
    $('#signUpPanel').modal('hide');
    $('#forgotPasswordPanel').modal('hide');
    $('#loginPanel').modal('show');
});
$("#loginBtn").click(function () {
    $('#loginPanel').modal('hide');
    $('#signUpPanel').modal('show');
});
$("#passwordBtn").click(function () {
    $('#loginPanel').modal('hide');
    $('#forgotPasswordPanel').modal('show');
});

// topbar sabitlemek için 
$(window).bind('scroll', function () {
    if ($(window).scrollTop() > 0) {
        $(".top-bar").addClass("sticky");
        $(".top-bar").fadeIn("fast");
    } else {
        $(".top-bar").removeClass("sticky");
    }
});