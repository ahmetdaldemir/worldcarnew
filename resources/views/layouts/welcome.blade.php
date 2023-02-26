<html lang="{{app()->getLocale()}}" class="page-static-index">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P7JFPW5');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta property="og:locale" content="tr_TR">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <link rel="alternate" href="https://worldcarrental.com/en" hreflang="en-gb" />
    <link rel="alternate" href="https://worldcarrental.com/en" hreflang="de" />
    <link rel="alternate" href="https://worldcarrental.com/ru" hreflang="ru" />
    <link rel="alternate" href="https://worldcarrental.com/" hreflang="x-default" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <?php use App\Models\Reservation;
    use Illuminate\Support\Facades\Auth;

    if(isset($data["destination"]))
    {
        $meta_title = $data["destination"]->meta_title;
        $meta_description = $data["destination"]->short_description;
    }else if(isset($data["blog"])){
        $meta_title = $data["blog"]->meta_title;
        $meta_description = $data["blog"]->short_description;
    }else if(isset($data["type"])){
        $meta_title = $data["text"]->meta_title;
        $meta_description = $data["text"]->short_description;
    }else{
        $languageList = $data["static"]["languages"];
        foreach ($languageList as $language) {
            if ($language->url == app()->getLocale()) {
                $meta_title = $language->meta_title;
                $meta_description = $language->meta_description;
            }
        }
    }


    ?>

    <title>{{strip_tags($meta_title)}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{!! strip_tags($meta_description) !!}"/>
    <meta name="copyright" content=""/>
    <meta name="distribution" content="World Rent A Car"/>
    <meta name="googlebot" content="index">
    <meta name="lang" content="tr">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#102a70">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#102a70">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#102a70">
    <meta name="publisher" content="World Car Rent A Car"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('storage/'.$data['static']["favicon"].'') }}">
    <meta name="author" content="Ahmet DALDEMİR">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="all" />
    <meta name="robots" content="max-snippet:-1">


    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="">
    <meta name="twitter:url" content="">
    <meta name="twitter:title" content="{!! strip_tags($meta_title) !!}">
    <meta name="twitter:description" content="{!! strip_tags($meta_description) !!}">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script charset="UTF-8" src="//web.webpushs.com/js/push/758800ac04ae448d007d411dab5fe8cc_1.js" async></script>
    <meta name="google-signin-client_id" content="581571273776-l7db3vblavqlv01m52n0oasb7nkcbp3v.apps.googleusercontent.com">

    <meta name="google-site-verification" content="i8_4XsxhpPsuFAA2b2PLTE9ElZI8C_89vHydc0xR_Ns" />
    <meta name="yandex-verification" content="65a77f2d9a182c1c" />
    <meta name="msvalidate.01" content="2547AB70837C71A64300355D57A2DBC9" />

    <script type="text/javascript" src="{{ asset('public/view/lib/core/popper.min.js') }}"></script>
    <link href="{{ asset('public/view/lib/bootstrapt-4.3.1/css/bootstrap.minfea5.css?v=238') }}" rel="stylesheet"/>
    <script src="{{ asset('public/view/js/aa346e6bde.js')}}" crossorigin="anonymous"></script>
    <link href="{{ asset('public/view/css/flat-icon/flaticon.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/view/js/ks.css') }}">

    <link href="{{ asset('public/view/css/app-1.min4376.css?v=243') }}" rel="stylesheet"/>
    <link href="{{ asset('public/view/css/search.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/view/css/menu.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/view/css/scroll.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/view/css/button.css') }}" rel="stylesheet"/>
    <link rel="canonical" href="{{url()->current()}}"/>
    <link rel="stylesheet" href="{{ asset('public/view/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('public/view/css/app.css') }}">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="{{ asset('public/view/lib/bootstrapt-4.3.1/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('public/view/slider/flexslider.css')}}" type="text/css" media="screen"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script defer src="{{asset('public/view/slider/jquery.flexslider.js')}}"></script>
    <script>
        $(".applyBtn").on('click', function () {
            $("html, body").animate({
                scrollTop: 0
            }, 1000);
        });
    </script>
    <script>
        (function () {
            // store the slider in a local variable
            var $window = $(window),
                flexslider = {vars: {}};

            // tiny helper function to add breakpoints
            function getGridSize() {
                return (window.innerWidth < 600) ? 1 :
                    (window.innerWidth < 900) ? 3 : 3;
            }

            $window.load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 210,
                    itemMargin: 3,
                    minItems: getGridSize(), // use function to pull in initial value
                    maxItems: getGridSize() // use function to pull in initial value
                });
            });
            // check grid size on resize event
            $window.resize(function () {
                var gridSize = getGridSize();
                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;
            });
        }());
    </script>
    <link href="{{asset('public/view/js/jquery.simpleTicker.css') }}" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('public/view/js/jquery.simpleTicker.js') }}"></script>
    <style>
        .div-dot {
            display: none;
        }

        input#from, input#to {
            display: none;
        }
        .popover {background: rgba(107,113,123,.95)!important;}
        .popover-body { color: #FFF!important;}
        .arrow::after { border-top-color: rgba(107,113,123,.95)!important;}


    </style>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5c93d25e101df77a8be3cf8a/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <!--End of Tawk.to Script-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script>
        var app = angular.module("app", []);
        app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
            $scope.addComment = function () {
                var data = $("#addComment").serialize();
                $http({
                    method: 'POST',
                    url: './create_comment',
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    console.log(response);
                });
            }
            $scope.isLogin = function () {
                var data = $("#isLogin").serialize();
                $http({
                    method: 'POST',
                    url: '{{url('auth')}}',
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    console.log(response);
                    if (response.data.success == false) {
                        alert(response.data.message);
                    } else {
                      window.location.href = '/';
                    }
                });
            }
            $scope.isRegister = function () {
                var data = $("#isRegister").serialize();
                $http({
                    method: 'POST',
                    url: './api/v1/login',
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    console.log(response);
                });
            }
            $scope.cancelReservation = function (id) {
                $("#cancelReservationModal").modal("show");
                $("#cancelReservationModal").find('#cancelReservationModalForm input[name=id]').val(id);
                var data = $("#isRegister").serialize();
                $http({
                    method: 'GET',
                    url: '/{{app()->getLocale()}}/profil/reservations/getreservationinfo?id='+id+'',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                   $scope.reservationCancelName = response.data.name;
                   $scope.reservationId = response.data.id;
                });
            }
            $scope.cancelReservationProcess = function () {

                $http({
                    method: 'GET',
                    url: '/{{app()->getLocale()}}/profil/reservations/reservationcancel',
                    data: $("#cancelReservationModalForm").serialize(),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    console.log(response.data);
                });
            }

        });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-222317226-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-222317226-1');
    </script>



    <script>
        let inactivityTime = function () {
            let time;
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
            function logout() {
                window.location.href="/";
                console.log("You are now logged out.")
            }
            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(logout, 200000)
            }
        };
        inactivityTime();
        console.log('Please wait...');
    </script>
    <script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "AutoRental",
	"name": "WorldCarRental",
	"description": "WorldCarRental, otomobil kiralama ve online araç kiralama hizmetinde liderdir. Kiralık araç filomuzdan istediğin aracı seçebilir ve online rent a car ile aracını güvenilir bir şekilde kiralayabilirsin.

",
	"image": "https://worldcarrental.com/storage/setting/IN0IOccdqcgdFps2xUKOvuKJil7Kfx4EbyFiSS6t.png",
	"logo": "https://worldcarrental.com/storage/setting/IN0IOccdqcgdFps2xUKOvuKJil7Kfx4EbyFiSS6t.png",
	"url": "https://worldcarrental.com",
	"telephone": "+90 850 888 88 07",
	"sameAs": ["https://twitter.com/worldcarrental","https://tr.linkedin.com/in/worldcarrental","https://www.facebook.com/worldcarrentals/","https://www.youtube.com/channel/UCgRjflgcjAwdFol1RHaNHhQ","https://www.instagram.com/worldcarrentals/"],
  "priceRange": "0$-200$",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": "Saray Mah. Ataturk Bulvari. Denizolgun Ishanı A Blok No:120 - Antalya Alanya 07410.",
      	"areaServed": "TR",
		"addressLocality": "Antalya",
		"postalCode": "07025 ",
		"addressCountry": "Turkey"
	}
}
</script>
</head>
<body ng-app="app" ng-controller="mainController">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P7JFPW5"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCLDJKX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{{--<a href="#" id="scollbutton" style="display: none;"><span></span></a>--}}
@include('layouts.header.headertop')
@include('layouts.header.headermenu')
@include('layouts.header.headermain')
@yield('content')
@include('layouts.footer.footertop',$data["static"]["tabs"])
@include('layouts.footer.apkbanner')
@include('layouts.footer.copyright')
@include('layouts.footer.script')
</body>
</html>
