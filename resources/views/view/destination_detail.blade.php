<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.welcome')
<link href="{{ asset('public/view/css/list.css') }}" rel="stylesheet"/>
@section('title'){{$data["destination"]->meta_title}} - @endsection
@section('content')
<section class="header-blogdetail" style="background-image: url('/storage/uploads/location-banner.jpg')">
    <div class="container">
        <div class="text-center">
            <h1>{{$data["destination"]->title}}</h1>
        </div>
    </div>
</section>
    <div class="search-form-box1">
        <div class="auto-container">
            <div class="col-12 search-form-inner">
                <!--<h4 class="title s-animate-1 d-block d-xl-none">{{__('home_banner1')}}<span>{{__('home_banner2')}} </span></h4>-->
                <form name="searchFormName" method="get" id="searchForm" class="form-area" onsubmit="return validateForm()" action="{{ route('lists', app()->getLocale()) }}">
                    <div class="row" style="width:100%;margin: 0;">
                        <div class="col-12 col-md-5">
                            <div class="loc" id="pick_up_location_div">
                                <div class="flex d-none d-lg-flex">
                                    <span class="greenLabel greenLabelText tex1"> {{__("Alış / Dönüş Yeri")}} </span>
                                    <span class="greenLabel greenLabelText tex2" style="display:none"> {{__("pick_up_location")}} </span>
                                    <span style="margin: 0 156px 0 0;display: none;" class="greenLabel greenLabelTextNEW">{{__("drop_off_location")}} </span>
                                </div>
                                <div class="input-grupla">
                                    <div class="kc-search kc-single">
                                        <div class="flex-title">
                                            <div class="desc">{{__("pick_up_location")}}</div>
                                        </div>
                                        <div class="kc-search-block kc-dropdown kc-search-point kc-search-start-point">
                                            <input type="hidden" name="pick_up_location" id="pick-up-location" required="required" />
                                            <div class="kc-value" data-placeholder="{{__("pick_up_select")}}">{{__("pick_up_select")}} </div>
                                            <div class="kc-dropdown-items kc-fade-to-scale kc-dropdown-items-city" id="item-city-list">
                                                <div class="kc-mobile-header">
                                                    <div class="kc-title">{{__("pick_up_select")}}</div>
                                                    <div class="kc-close"><i class="fa fa-times"></i></div>
                                                </div>
                                                <ul class="kc-options">
                                                    @foreach($data['center_location'] as $item)
                                                        @if($item->id_parent == 0)
                                                            <li class="kc-group" id="up_{{$item->id}}">
                                                                <div class="kc-heading" id="up_{{$item->id}}"><i class="fas fa-map-marker-alt"></i>{{$item->title}}</div>
                                                                <input type="hidden" class="parentMenuBytn" id="btn-{{$item->id}}">
                                                                <ul class="menu_parent" id="menu_parent0">
                                                                    @foreach($data['center_location'] as $val)
                                                                        @if($val->id_parent == $item->id)
                                                                            <li id="selectOne" data-id="{{$val->id}}" name="selectOne"
                                                                                data-value="{{$val->id}}">
                                                                                <button type="button">
                                                                                    @if($val->type=='hotel')
                                                                                        <i style="margin: 2px 10px 0 0;" class="fas fa-hotel icon-large"></i>
                                                                                    @elseif($val->type == 'airport')
                                                                                        <i style="margin: 2px 10px 0 0;" class="fas fa-plane-departure icon-large"></i>
                                                                                    @elseif($val->type == 'center')
                                                                                        <i style="margin: 2px 10px 0 0;" class="fas fa-map-marker-alt icon-large"></i>
                                                                                    @elseif($val->type == 'address')
                                                                                        <i style="margin: 2px 10px 0 0;" class="fas fa-map-marker-alt icon-large"></i>
                                                                                    @endif
                                                                                    {{$val->title}}
                                                                                </button>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="flex-title kc-d">
                                            <div class="desc">{{__("drop_off_location")}}</div>
                                        </div>
                                        <div class="kc-search-block kc-dropdown kc-search-point kc-search-end-point">
                                            <div class="kc-value kc-value-down" data-placeholder="{{__("drop_off_location_select")}}">{{__("drop_off_location_select")}}</div>
                                            <input type="hidden" id="end_point" name="end_point">
                                            <div class="kc-dropdown-items kc-fade-to-scale">
                                                <div class="kc-mobile-header">
                                                    <div class="kc-title" style="display:none">{{__("drop_off_location")}}</div>
                                                    <div class="kc-close"><i class="fa fa-times"></i></div>
                                                </div>
                                                <ul class="kc-options" id="kc-options-parent"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" ">
                                <input type="checkbox" name="is_active_select" id="is_active_select" class="form-control"
                                       style=" width:15px;height:15px;margin: 10px 0 0 0;float: left;">
                                <label class="returnBox" for="is_active_select">
                                    {{__('Farklı lokasyona arabayı bırakacağım')}}</label>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 loc">
                            <div class="row">
                                <div class="d-none d-lg-block">
                                    <div class="flex">
                                        <span class="greenLabel">{{__('Çıkış Tarihi / Saat')}}</span>
                                        <span class="redLabel">{{__('Dönüş Tarihi / Saat')}}</span>
                                    </div>
                                </div>
                                <div class="col-12 carSearch">
                                <div class="row">
                                    <div class="col-12 col-md-6 fa fa-calendar-alt">
                                        <div class="row">
                                            <div class="desc">{{__('pick_up_date')}}</div>
                                            <div id="cikis_timer" class="picktimer fa fa-sort-down">
                                                <input id="from" class="flatpickr-input" type="hidden" name="cikis_tarihi_submit" value="<?=$data['checkin']?>">
                                                <input type="hidden" id="t1" name="cikis_saati_submit" value="{{date("H")+1}}:00">
                                                <div class="date" onclick="openCalendar()"><?=date('d', strtotime($data['checkin']))?></div>
                                                <div class="date-detail">
                                                    <span class="month uppercase" onclick="openCalendar()"><?php echo \App\Helpers\Search::getMounthName($data['checkin'], 1) ?></span>
                                                    <span class="day" onclick="openCalendar()"><?php echo \App\Helpers\Search::getMounthName($data['checkin'], 3) ?></span>
                                                </div>
                                                <div class="date-detail timer fa fa-clock t1">
                                                    <span class="time"><b>{{date("H")+1}}</b>:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 fa fa-calendar-alt">
                                        <div class="row">
                                            <div class="desc">{{__('drop_off_date')}}</div>
                                            <div id="donus_timer" class="droptimer fa fa-sort-down">
                                                <input id="to" class="flatpickr-input" type="hidden" name="donus_tarihi_submit" value="<?=$data['checkout']?>">
                                                <input type="hidden" id="t2" name="donus_saati_submit" value="{{date("H")+1}}:00">
                                                <div class="date" onclick="openCalendar2()"><?=date('d', strtotime($data['checkout']))?></div>
                                                <div class="date-detail">
                                                <span class="month uppercase" onclick="openCalendar2()"><?php echo \App\Helpers\Search::getMounthName($data['checkout'], 1) ?></span>
                                                    <span class="day" onclick="openCalendar2()"><?php echo \App\Helpers\Search::getMounthName($data['checkout'], 3) ?></span>
                                                </div>
                                                <div class="date-detail timer fa fa-clock t2">
                                                    <span class="time"><b>{{date("H")+1}}</b>:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 loc">
                            <div class="row">
                            <button type="submit" class="btn btn-secondary">{{__('car_search')}} <i class="fas fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row ">
                    <?php  if(!empty($data["destinations"])){ $x =" col-lg-9 col-md-8";  }else{$x="col-lg-12 col-md-12";}?>
                    <div class="content-side <?=$x?> col-sm-12 col-xs-12">
                        <section class="news-section col-12">
                            <div class="news-style-one">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <a href="#"><iframe src="<?=$data["destination"]->coordinate?><"  style="border:0;width: 100%;height: 250px" allowfullscreen="" loading="lazy"></iframe>  </a>
                                    </figure>
                                    <div class="lower-content">
                                        <!--h3><?=$data["destination"]->title?></h3 -->
                                        <div class="text text-content">
                                            {!! $data["destination"]->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php  if(!empty($data["destinations"])){ ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padd-left-40">
                        <aside class="sidebar">
                            <div class="sidebar-widget popular-posts">
                                <div class="widget-box">
                                    <div class="sidebar-title"><h3>Bölgeler Hakkında</h3></div>
                                    <?php foreach ($data["destinations"] as $item){ ?>
                                    <a href="/{{app()->getLocale()}}/{{__('destination_url')}}/{{$item->slug}}/{{$item->id}}">
                                        <article class="post">
                                            @if($item->image == "NULL")
                                                <figure class="post-thumb"> <img src="http://via.placeholder.com/65x50" alt="{{$item->title}}"></figure>
                                            @else
                                                <figure class="post-thumb"><img src="{{asset('storage/'.$item->image.'') }}" alt="{{$item->title}}"> </figure>
                                            @endif
                                            <h4>{{$item->title}}</h4>
                                        </article>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
<script>
    function validateForm() {
        var x = document.forms["searchFormName"]["pick_up_location"].value;
        if (x == "") {
            swal.fire({
                icon: 'error',
                title: 'Hata...',
                text: '{{__("error_location")}}'
                //footer: '<a href="">Why do I have this issue?</a>'
            })
            /*swal({
                title: "HATA!",
                text: "Lütfen Alış Yeri Seçiniz ",
                confirmButtonColor : "#f9af00",
                confirmButtonText : "KAPAT",
                imageUrl: 'public/view/images/357a0293a2f587555ef6434d2f3a3f86-AjaxSpinner.gif'
            });*/
            return false;
        }
    }
</script>
        <script>
            function addEkstra(id, id_ekstra, type, totalRentalprice,currency) {
                let totalPriceReservation = $(".car_"+id +" .reservationNextButton").attr("data-toplam");
                let totalRentalpriceAccounting = 0;
                let idsd = ".car_"+id +" #ekstra_" + id + "_" + id_ekstra;
                let class_e = ".car_"+id +" #extra_" + id + "_" + id_ekstra;
                let modelName = ".car_"+id +" ekstraProduct_" + id + "_" + id_ekstra;
                let idsd_id = $(idsd);
                let value = idsd_id.val();
                let totalprice = 0;
                let deger;
                let maxleght = idsd_id.attr("maxlength");
                let day = idsd_id.data("day");
                let price = idsd_id.data("price");
                let car = $(".car_"+id);
                // $("#button_minus_"+idsd).attr("disabled",false);

                if (type == "plus") {
                    deger = parseInt(value) + 1;
                    if (maxleght >= deger) {
                        $(idsd).val(deger);
                    }
                    if (maxleght == deger) {
                        $("#button_plus_ekstra_" + id + "_" + id_ekstra).attr("disabled", true);
                        $("#button_minus_ekstra_" + id + "_" + id_ekstra).attr("disabled", false);
                    }
                    if (deger > 0) {
                        $("#button_minus_ekstra_" + id + "_" + id_ekstra).attr("disabled", false);
                    }
                    totalprice = deger * price * day;
                    totalRentalpriceAccounting = parseFloat(totalPriceReservation) + parseFloat(1 * price * day);
                }

                if (type == "minus") {
                    deger = value - 1;
                    if (deger >= 0) {
                        $(idsd).val(deger);
                    }
                    if (deger == 0) {
                        $("#button_minus_ekstra_" + id + "_" + id_ekstra).attr("disabled", true);
                        $("#button_plus_ekstra_" + id + "_" + id_ekstra).attr("disabled", false);
                        totalprice = price;
                    } else {
                        totalprice = deger * price * day;
                    }
                    totalRentalpriceAccounting = parseFloat(totalPriceReservation) - parseFloat(1 * price * day);
                }
                if(deger>0){
                    $(class_e).addClass('extraActive');
                }else{
                    $(class_e).removeClass('extraActive');
                }
                $(".car_"+id +" #totalprice_div_" + id + "_" + id_ekstra).html(totalprice +" "+ currency);
                $(".car_"+id +" button.reservationNextButton").attr("data-toplam", totalRentalpriceAccounting);
                $(".car_"+id +" #reservationTotalRentalPrice .lastprice").html(parseFloat(totalRentalpriceAccounting.toFixed(2))  + currency);
                $(".car_"+id +" input[name=lastprice]").val(parseFloat(totalRentalpriceAccounting.toFixed(2)));
            }

            $(document).ready(function () {calculate("EUR_EUR");});
            $(".search-lang").change(function () {calculate($(this).val());});
            function calculate(currency) {
                $.ajax({
                    type: 'GET',
                    url: '/tr/get_list_cars/' + currency + '',
                    beforeSend: function () {
                        $('#listing-countdown--success').removeClass('hidden')
                    },
                    success: function (data) {
                        //console.log(data);
                        $("#ListeId").html(data);
                    },
                    complete: function () {
                        $('#listing-countdown--success').addClass('hidden')
                    },
                });
            }

            $('#contentBox .dropdown-menu').on('a', 'change', function () {
                var selVal = $(this).attr("href")
                alert(selVal);
            });

            $('#carouselExampleControls').carousel({interval: 500});

            $('.carousel-control').click(function (e) {
                e.stopPropagation();
                var goTo = $(this).data('slide');
                if (goTo == "prev") {
                    $('#carouselExampleControls').carousel('prev');
                } else {
                    $('#carouselExampleControls').carousel('next');
                }
            });
            let c = 0;
            $(".search-form-inner").on("click", '.change', function () {
                if (c == 0) {
                    $(".search-form-head").addClass("form-none");
                    $("#searchForm").removeClass("form-none");
                    $(".search-form-box1").css({"opacity": "1"});
                    c++;
                } else {
                    $(".search-form-head").removeClass("form-none");
                    $("#searchForm").addClass("form-none");
                    $(".search-form-box1").css({"background": "transparent"});
                    c--;
                }
            });
            @if(@$data["pick_up_time"])
            $(document).ready(function () {
                let t1 = '{{$data["checkin"].' '.$data["pick_up_time"]}}', startDate = new Date(t1), endDate = new Date(),
                    diff = (endDate.getTime() - startDate.getTime()),
                    msec = diff,
                    hh = Math.floor(msec / 1000 / 60 / 60);
                msec -= hh * 1000 * 60 * 60;
                let mm = Math.floor(msec / 1000 / 60);
                msec -= mm * 1000 * 60;
                let ss = Math.floor(msec / 1000);
                msec -= ss * 1000;
                if (hh > -4) {
                    $('#ListeId').remove();
                    swal.fire({
                        icon: 'error',
                        title: 'Hata...',
                        text: 'En Az 5 saat Sonrasına Rezervasyon yapılabilir '
                    })
                }
            });
            @endif
        </script>
@endsection
