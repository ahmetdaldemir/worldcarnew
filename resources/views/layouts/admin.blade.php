<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'World Rent A Car Yönetim Paneli') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/styles/css/themes/lite-blue.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/styles/vendor/perfect-scrollbar.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('select/bootstrap-select.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('public/assets/styles/vendor/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/styles/vendor/ladda-themeless.min.css') }}">
    <script src="{{ asset('public/assets/js/vendor/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <link href="{{ asset('public/admincss/select2.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vendor/tagging.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/tagging.script.js') }}"></script>
    <script src="{{ asset('public/assets/js/es5/script.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/es5/sidebar.large.script.min.js') }}"></script>
    <!-- Select -->
    <script src="{{ asset('public/assets/datetimepicker/daterangepicker.min.js') }}"></script>
    <link href="{{ asset('public/assets/datetimepicker/daterangepicker.min.css') }}" rel="stylesheet"/>
    <!-- Select -->

    <!-- Select -->
    <script src="{{ asset('public/assets/timepicker/timepicker.js') }}"></script>
    <link href="{{ asset('public/assets/timepicker/timepicker.css') }}" rel="stylesheet"/>
    <!-- Select -->
    <script src="{{ asset('public/assets/js/vendor/spin.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vendor/ladda.js') }}"></script>

     <script src="{{ asset('public/assets/js/vendor/toastr.min.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="https://cdn.tiny.cloud/1/gnnd0qquogzvieo2r58vgxz7t1kh2h6gjfurdb29c584xfx0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 400,
            images_upload_url: '/admin.admin.tinymiceupload',
            automatic_uploads: false,
            images_file_types: 'jpg,svg,webp',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste imagetools wordcount'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

        });
    </script>
    <script>
        $(function () {
            $('#datepicker,#datepicker2,#birthday,#passport_date,#driving_licance_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
        });
        $(function () {
            $('#datepicker1,#drivinglicance').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });

            $('#operation_up_datepicker,#operation_drop_datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
        });
        $(function () {
            var nowDate = new Date();
            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

            $('#up_datepicker,#drop_datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                "daysOfWeek": [
                    "Pt",
                    "Sl",
                    "Çr",
                    "Pr",
                    "Cm",
                    "Ct",
                    "Pz"
                ],
                "monthNames": [
                    "Ocak",
                    "Şubat",
                    "Mart",
                    "Nisan",
                    "Mayıs",
                    "Haziran",
                    "Temmuz",
                    "Ağustos",
                    "Eylül",
                    "Ekim",
                    "Kasım",
                    "Aralık"
                ],
            });
        });



        $(function () {

            $('#datepicker_created_at').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    format: 'DD/MM/YYYY'
                },
                "startDate": {{\Carbon\Carbon::now()->format('d/m/Y')}},
                "endDate": {{\Carbon\Carbon::now()->subDays(7)->format('d/m/Y')}}
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });

        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-sanitize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js" class=""></script>
    <script> var app = angular.module("app", ['ngSanitize']);
        app.filter('unsafe', function ($sce) {
            return $sce.trustAsHtml;
        });
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
                time = setTimeout(logout, 2000000)
            }
        };
        inactivityTime();
        console.log('Please wait...');
    </script>
</head>
<?php
use App\User;
use App\Models\Currency;
use Carbon\Carbon;

$carbon = new Carbon;
$user = new User;
$currency = new Currency;
$currencys = $currency::where('left_icon', "!=", 'TRY')->get();
?>
<body class="text-left" ng-app="app" ng-controller="mainController">
<div class="app-admin-wrap layout-sidebar-large">
    @include('layouts.header.finansheader')
    <div class="main-header">
        <div class="logo" style="width:280px">
            <img style="width: 200px;float: left" src="https://worldcarrental.com/storage/setting/IN0IOccdqcgdFps2xUKOvuKJil7Kfx4EbyFiSS6t.png">
            <div class="menu-toggle" style="float: right;width: 68px">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>


        <style>
            .hisse2014Bar .bar {
                display: inline-block;
                float: left;
                left: -30px;
                position: relative;
                margin: 0 auto;
            }

            .hisse2014Bar .bar .item {
                width: 119px;
                height: 45px;
                display: inline-block;
                float: left;
                padding: 9px 5px 8px;
                border: 1px solid #ececec;
                border-right: none;
                margin: 0;
            }

            .hisse2014Bar .bar .item.up a {
                color: #00a52d;
            }

            .hisse2014Bar .bar .item a {
                display: inline-block;
                float: left;
            }

            .hisse2014Bar .bar .item .col1 {
                width: 45px;
                display: block;
                float: left;
                font: bold 12px/13px Arial;
                text-align: left;
            }

            .hisse2014Bar .bar .item .col1 .name {
                width: 100%;
                display: inline-block;
                color: #000;
            }

            .hisse2014Bar .bar .item .col1 .value1 {
                width: 100%;
                display: inline-block;
            }

            .hisse2014Bar .bar .item .col2 {
                width: 21px;
                display: block;
                float: left;
            }

            .hisse2014Bar .bar .item.up .col2 .arrow {
                background-position: -50px 0;
            }

            .hisse2014Bar .bar .item .col2 .arrow {
                width: 17px;
                height: 22px;
                display: block;
                float: left;
                margin: 2px;
                background-position: -10000px -10000px;
            }

            .hisse2014Bar .bar .item .col3 {
                width: 52px;
                display: block;
                float: left;
                font: bold 14px/13px Arial;
                text-align: right;
            }

            .hisse2014Bar .bar .item .col3 .value2 {
                width: 100%;
                display: inline-block;
                float: left;
            }

            .spansub {
                font-size: 9px;
                color: #000;
            }
        </style>
        @role('Admin')
        <div class="header-part-left" style="    width: 45%;float: left; display: flex;">
            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <span
                        class="badge badge-danger">{{ $user->where('is_active',1)->where('id','!=',Auth::id())->count() }}</span>
                    <i class="i-Male text-muted header-icon"></i>
                </div>
                <!-- Notification dropdown -->
                <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
                     aria-labelledby="dropdownNotification">
                    <?php foreach($user->where('is_active', 1)->where('id', '!=', Auth::id())->get() as $item){ ?>
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Male text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span><?=$item->name?></span>
                            </p>
                            <p class="text-small text-muted m-0"><a
                                    href="{{route('admin.admin.user.memberlogout',['id'=>$item->id])}}">Çıkış Yap</a>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>



            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" >
                    <a title="Yeni Rezervasyonlar" href="{{route('admin.admin.reservation.newreservation')}}">
                        <span class="badge badge-success">{{\App\Models\Reservation::whereNull('deleted_at')->where('status','new')->count()}}</span>
                        <i class="i-Calendar-4 text-muted header-icon"></i>
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">{{\App\Models\Reservation::where('status','closed')->where('created_at',date('Y-m-d'))->count()}}</span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>
                <a href="{{route('admin.admin.reservation.deletereservation')}}" class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
                     aria-labelledby="dropdownNotification">
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="text-small text-muted m-0">Silinen Rezervasyonlar</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">{{\App\Models\Reservation::where('status','waiting')->where('created_at',date('Y-m-d'))->count()}}</span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>
                <a href="{{route('admin.admin.reservation.noncomfirmreservation')}}" class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
                     aria-labelledby="dropdownNotification">
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="text-small text-muted m-0">Beklemede Olan Rezervasyonlar</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">3</span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>
                <a href="{{route('admin.admin.reservation.cancelreservation')}}" class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification">
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="text-small text-muted m-0">İptal Edilen Rezervasyonlar</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        @endrole
        <div class="header-part-right">

            <div style="margin: auto">
                <input class="form-control" id="theCustomerTop" onkeyup="getCustomer()"  data-customer_id="" name="customer" placeholder="PNR Veya Müşteri Adı" type="text">
                <input id="theCustomerHiddenTop" value="@{{customer_id}}" name="id_customer" type="hidden">
                <ul id="theCustomerUlTop" style="display: none;overflow:auto;height: 300px;z-index: 99999999;">

                </ul>
            </div>


            <!-- User avatar dropdown -->
            <div class="dropdown">
                <div class="user col align-self-end">
                    <img src="{{ asset('/public/assets/images/faces/16.jpg') }}" id="userDropdown" alt=""  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Merhaba, {{Auth::user()->name}}
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> {{Auth::user()->name}} - {{Auth::user()->id}}
                        </div>
                        <a class="dropdown-item">Profil Ayarları</a>
                        <a class="dropdown-item" href="{{ route('admin.logout',['id'=>Auth::user()->id]) }}">Çıkış
                            Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none">
            <ul class="navigation-left">
                <li class="nav-item">
                    <a class="nav-item-hold" href="{{route('admin.home')}}">
                        <i class="nav-icon i-Home-2"></i>
                        <span class="nav-text">Anasayfa</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @role('Admin|Rezervasyon')
                <li class="nav-item" data-item="reservation">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Receipt"></i>
                        <span class="nav-text">Rezervasyon</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
                @role('Admin')
                <li class="nav-item" data-item="cars">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Car-2"></i>
                        <span class="nav-text">Araç</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
                @role('Admin|Editor')
                <li class="nav-item" data-item="editor">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">Editör</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
                @role('Admin')
                <li class="nav-item" data-item="definition">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">CRM</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="accounting">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Bar-Code"></i>
                        <span class="nav-text">Muhasebe</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
                @role('Admin')
                <li class="nav-item" data-item="tour">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Gear-2"></i>
                        <span class="nav-text">Tour</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
                @role('Admin')
                <li class="nav-item" data-item="users">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Male"></i>
                        <span class="nav-text">Kullanıcılar</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                @endrole
            </ul>
        </div>

        <div class="sidebar-left-secondary rtl-ps-none">
            <ul class="childNav" data-parent="reservation">
                <li class="nav-item">

                    <a href="{{route('admin.admin.reservation.create')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Yeni Rezervayon yap</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.reservation',['status'=> 0])}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Tüm Rezervasyonlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.operation.index')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Operasyon</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.transfer')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Transfer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.stopsell')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">StopSell</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.reservation.survey_answers')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Anket Cevapları</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.reservation.access')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Arama</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="cars">
                <li class="nav-item">
                    <a href="{{route('admin.admin.categories')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kategoriler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.cars')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Araçlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.plates')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Plakalar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.care')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Bakım İşlemleri</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.admin.brand')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Marka</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.plates.report')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Plaka Raporu</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="definition">
                <li class="nav-item">
                    <a href="{{route('admin.admin.settings.mailtest')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Mail Test</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.admin.camping')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kampanyalar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.customer')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Müşteriler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.ekstra')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Ekstralar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.locations')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Lokasyon</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Şubeler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.supplier')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Bayiler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.emailtemplate')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Eposta Şablonları</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Sms Yönetimi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Bildirim Yöntitmi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.settings')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Genel Ayarlar</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.admin.currency')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Para Birimi Ayarları</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">KAP API</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">SMS API</span>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{route('admin.admin.survey')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Anket</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kiralama Raporu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Hasar Raporu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Ceza Raporu</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="editor">

                <li class="nav-item">
                    <a href="{{route('admin.admin.destinations')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Bölgeler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.blogs')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Bloglar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.text_category')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Yazı Kategorileri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.texts')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Yazılar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.comment')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Yorumlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.language')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Dil Ayarları</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.page')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Sayfalar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.mobil_slider')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Mobil Slider</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="accounting">
                <li class="nav-item">
                    <a href="{{route('admin.admin.accounting')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Gelir/Gider İşlemleri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kar - Zarar Durumu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Müşteri Tahsilat Takibi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kasa Durumu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.accountingcategory')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.accountingcategory')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Tur Hareketleri</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="tour">
                <li class="nav-item">
                    <a href="{{route('admin.admin.tour.create')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Tur Ekle</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.tour')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Tur Listesi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.tour.reservations')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Tur Rezervasyonları</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="users">

                <li class="nav-item">
                    <a href="{{route('admin.admin.user')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Kullanıcılar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.role')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">Roller</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.admin.permission')}}">
                        <i class="nav-icon i-Arrow-Right-2"></i>
                        <span class="item-name">İzinler</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="sidebar-overlay"></div>
    </div>
    <div style="padding: 30px;    padding-top: 30px;">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @yield('content')
            </div>
            <div class="flex-grow-1"></div>
            <div class="app-footer" style="width: 100%">
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <a class="btn btn-primary text-white btn-rounded" href="#" target="_blank">World Car Rentacar</a>
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="m-0">&copy; 2020 Pisagor Yazılım</p>
                            <p class="m-0">All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
</style>
<script>
    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('#manual').on('click', function () {
            $(this).tooltip('toggle');
        });
    });
</script>
<script>
    $("#mySelect2").trigger("change");
    $("#location5").trigger("change");
    $("#drop_location").trigger("change");

    $('#mySelect2').select2({
        dropdownParent: $(this).parent(),
        placeholder: {
            id: '-1', // the value of the option
            text: 'Select an option'
        }
    });
    $('#location5,#drop_location,#plate').select2({
        dropdownParent: $(document.body),
    });
    $('select').on('select2:open', function(e){
        $('.custom-dropdown').parent().css('z-index', 99999);
    });
</script>
<script>
    $('select.form-control').select2();
    $('#location,#drop_location').select2();
</script>
<script>
    $(function () {
        $('.timepicker').timepicker({
            showInputs: true
        })
    });
</script>
<style>
    .title {
        border-bottom: 1px solid #ccc;
        margin-bottom: 30px;
    }

    #theCustomerUl {
        margin: 0;
        padding: 0;
        position: absolute;
        overflow: hidden;
        width: 20%;
        z-index: 9999;
    }

    #theCustomerUl li {
        background: #013473;
        list-style: none;
        padding: 5px;
        color: #fff;
        cursor: pointer;
    }

    #theCustomerUl li:hover {
        background: #0d5fc6;
        list-style: none;
        padding: 5px;
        color: #fff;
        cursor: pointer;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        height: 33px;
        border-radius: 0;
    }
</style>
<style>
    #theCustomerUlTop {
        margin: 0;
        padding: 0;
        position: absolute;
        overflow: hidden;
        width: 20%;
        z-index: 9999;
    }

    #theCustomerUlTop li {
        background: #013473;
        list-style: none;
        padding: 5px;
        color: #fff;
        cursor: pointer;
    }

    #theCustomerUlTop li:hover {
        background: #0d5fc6;
        list-style: none;
        padding: 5px;
        color: #fff;
        cursor: pointer;
    }
</style>
<script>
    function getCustomer()
    {
         var val = $("#theCustomerTop").val();
         var items ="";
        $("#theCustomerUlTop").show();
              $("#theCustomerUlTop").css('display', 'block');
              var searchText_len = val.trim().length;
              // Check search text length
              if (searchText_len > 0) {
                  var data = [];
                  $.ajaxSetup({
                      headers:
                          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                  });
                  $.ajax({
                      method: "POST", // method bu sefer post
                      url: "/generalsearch", // urlmiz
                      data: {searchText: val},
                      headers: {
                          "Content-Type": "application/x-www-form-urlencoded"
                      },
                      beforeSend: function(){
                          $("ul#theCustomerUlTop").html();
                      },
                  }).then(function (response) {
                      console.log(response);
                      $.each(response,function(index,item)
                      {
                           items +="<li value='"+item.id +"'><a style='color:#fff' href='/admin/admin/reservation/customerreservation/"+item.id+"'>"+item.firstname +" "+item.email +" "+item.phone +"</a></li>";
                      });
                      $("ul#theCustomerUlTop").html(items);
                  });
              } else {
                  var searchResult = {};
              }
    }

    $("body").click(function () {
        $("ul#theCustomerUlTop").hide();
        $("input#theCustomerTop").html('');
    })
</script>
<script>

    // app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {
    //
    //
    //     $scope.getCustomersTop = function () {
    //         $("#theCustomerUlTop").show();
    //         $("#theCustomerUlTop").css('display', 'block');
    //         var searchText_len = $scope.getCustomerTop.trim().length;
    //         // Check search text length
    //         if (searchText_len > 0) {
    //             $scope.data = [];
    //             $http({
    //                 method: "POST", // method bu sefer post
    //                 url: "/generalsearch", // urlmiz
    //                 data: $httpParamSerializerJQLike({
    //                     searchText: $scope.getCustomerTop,
    //                 }),
    //                 headers: {
    //                     "Content-Type": "application/x-www-form-urlencoded"
    //                 }
    //             }).then(function (response) {
    //                 console.log(response);
    //                 $scope.customerResultTop = response.data;
    //             });
    //         } else {
    //             $scope.searchResult = {};
    //         }
    //     }
    //
    //     $scope.addCustomerInputTop = function (id, firstname, lastname, item) {
    //         $("#theSearchTop").attr("data-customer_id", id);
    //         $("#theSearchTop").val(firstname + " " + lastname);
    //         $("#theSearchHiddenTop").val(id);
    //         $("ul#theSearchUlTop").css('display', 'none');
    //         $scope.searchResult = "";
    //
    //         $scope.customer_id = item.id;
    //         $scope.customer_country = item.nationality;
    //         $scope.customer_fullname = item.firstname + " " + item.lastname;
    //         $scope.email = item.email;
    //         $scope.phone = item.phone;
    //         $scope.birthday = item.birthday;
    //         $scope.gender = item.gender;
    //         $scope.point = item.point;
    //         $scope.remaining_points = item.remaining_points;
    //         $scope.cancel_reservation = item.cancel_reservation;
    //         $scope.waiting_reservation = item.waiting_reservation;
    //         $scope.comfirm_reservation = item.comfirm_reservation;
    //         $http({
    //             method: "GET", // method bu sefer post
    //             url: "/get_customer_blacklist?id=" + id + "",
    //             headers: {
    //                 "Content-Type": "application/x-www-form-urlencoded"
    //             }
    //         }).then(function (response) {
    //             $scope.blacklist = response.data;
    //         });
    //         if (item.notes != null) {
    //             $("#customerNoteModalTop").modal("show");
    //             $scope.customernotelist = item.notes;
    //         }
    //
    //     }
    //
    // }]);



    $(".js-dropdown").find('.city').click(function(){
        $(".js-dropdown-list").find('ul').show();
        $(".js-dropdown-list").show();
    });
    $(".js-dropdown").on("click",".js-dropdown-item",function(){
        var name = $(this).text();
        $(".city span").text(name);
        $(".js-dropdown-list").hide();
    });
</script>


</body>

</html>
