@extends('layouts.welcome')
@section('title'){{__('all_campaigns')}} - @endsection
@section('content')
<?php
use \App\Repository\Data;
$datarepository = new Data();
?>
<section class="header-blogdetail" style="background-image: url('https://worldcarrental.com/storage/uploads/last-minute-offer-rental-worldcarrental.jpg')">
    <div class="container">
        <div class="text-center">
            <h1>{{$data["all_campain"]->title}}</h1>
        </div>
    </div>
</section>
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row ">
                <!--Content Side-->
                <div class="content-side col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <!--News Section-->
                    <section class="news-section col-12">
                        <div class="news-style-one">
                            <div class="inner-box">
                                <h3><?=  $datarepository::getCarInfoNoYear($data["all_campain"]->id_car)?></h3>
                                <figure class="image-box" style="float: none!important;">
                                    <img
                                        src="{{asset('storage/uploads/'.\App\Models\Image::where("id_module",$data["all_campain"]->id_car)->where("module","cars")->where("default","default")->first()->title)}}"
                                        alt="{{$data["all_campain"]->title}}">
                                </figure>
                                <div class="lower-content">
                                    <?php  $attributes = $datarepository::getCarAttibutes($data["all_campain"]->id_car); ?>
                                    <div>
                                        @foreach($attributes as  $item)
                                            <span class="btn btn-light btn-sm" style="padding: 5px 12px;">{{$item}}</span>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="text text-content">
                                        {!! $data["all_campain"]->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 padd-left-40">
                    <aside class="sidebar">
                        <div class="sidebar-widget popular-posts">
                            <form method="post" action="{{ route('campainreservation', app()->getLocale()) }}" class="form-area ">
                                @csrf
                                <input type="hidden" name="csrf_token" value=" {{csrf_token()}}">
                                <input type="hidden" name="id_car" value="<?=$data["all_campain"]->id_car?>">
                                <input type="hidden" name="id_campain" value="<?=$data['id_campain']?>">
                                <input type="hidden" name="currency" value="2">
                                <div class="widget-box" style="    background: #f8f9fa;">
                                    <div class="sidebar-title"><h3 style="font-weight: 600 !important;">{{__('reservation')}}</h3>
                                    </div>
                                    <div class="sidebar-body">
                                        <div class="default-form">
                                            <input value="<?=$data["all_campain"]->id_car?>" name="id_car"
                                                   type="hidden"/>
                                            <div class="field-label">
                                                <span
                                                    class="greenLabel greenLabelText"> {{__("Teslim / Dönüş Yeri")}} </span>
                                            </div>
                                            <div class="row ">
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <div class="field-inner">
                                                        <select name="pick_up_location1" id="pick_up_location1"  class="kc-options" required>
                                                            <option value="">{{__('Seçiniz')}}</option>
                                                            <?php foreach($data['center_location_pick_up'] as $item){ ?>
                                                            <?php $parantLocation = \App\Models\Location::getViewLocationId($item->id); ?>
                                                            <?php if($item->id_parent == 0){ ?>
                                                            <optgroup label="<?=$item->title?>">
                                                                <?php foreach($parantLocation as $val) {  ?>
                                                                <option id="selectOne" data-id="<?=$val['id']?>"
                                                                        value="<?=$val['id']?>"><?=$val['name']?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-xs-12">
                                                    <div class="check-box">
                                                        <input type="checkbox" name="is_active_select"
                                                               id="is_active_select"><label for="cbox-one"><span
                                                                class="icon"><span class="square"></span><span
                                                                    class="fa fa-check"></span></span> {{__('Farklı lokasyona arabayı bırakacağım')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div style="display:none;"
                                                     class="form-group col-md-12 col-sm-12 col-xs-12"
                                                     id="pick_drop_location_div">
                                                    <div class="field-label">
                                                        <span class="greenLabel ">{{__("drop_off_location")}}</span>
                                                    </div>
                                                    <div class="field-inner">
                                                        <select name="pick_down_location1" id="pick_down_location1">
                                                            <option value="0">{{__('Seçiniz')}}</option>
                                                            <?php foreach($data['center_location'] as $item){ ?>
                                                            <?php $parantLocation = \App\Models\Location::getViewLocationId($item->id); ?>
                                                            <?php if($item->id_parent == 0){ ?>
                                                            <optgroup label="<?=$item->title?>">
                                                                <?php foreach($parantLocation as $val) {  ?>
                                                                <option
                                                                    value="<?=$val['id']?>"><?=$val['name']?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span-bottom-20"></div>
                                            <div class="row champing">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="loc" >
														<div class="" style="box-sizing: unset;">
															<div class="row">
																<div class="d-none d-lg-block">
																	<div class="flex">
																		<span class="greenLabel">{{__('Çıkış Tarihi / Saat')}}</span>
																		<span class="redLabel">{{__('Dönüş Tarihi / Saat')}}</span>
																	</div>
																</div>
																<div class="carSearch" style="width: 100%;">
																<div class="row">
																	<div class="col-9 col-md-5 fa fa-calendar-alt">

																			<div class="desc">{{__('pick_up_date')}}</div>
																			<div id="cikis_timer" class="picktimer fa fa-sort-down">
																				<input id="from" class="flatpickr-input" type="hidden" name="cikis_tarihi_submit" value="<?=$data['checkin']?>">
																				<input type="hidden" id="t1" name="cikis_saati_submit" value="{{date("H")+1}}:00">
																				<div class="date" onclick="openCalendar()"><?=date('d', strtotime($data['checkin']))?></div>
																				<div class="date-detail">
																					<span class="month uppercase" onclick="openCalendar()"><?php echo \App\Service\Search::getMounthName($data['checkin'], 1) ?></span>
																					<span class="day" onclick="openCalendar()"><?php echo \App\Service\Search::getMounthName($data['checkin'], 3) ?></span>
																				</div>
																				<div class="date-detail timer fa fa-clock t1">
																					<span class="time"><b>{{date("H")+1}}</b>:00</span>
																				</div>
																			</div>
																	</div>
																	<div class="col-9 col-md-5 fa fa-calendar-alt">
																			<div class="desc">{{__('drop_off_date')}}</div>
																			<div id="donus_timer" class="droptimer fa fa-sort-down">
																				<input id="to" class="flatpickr-input" type="hidden" name="donus_tarihi_submit" value="<?=$data['checkout']?>">
																				<input type="hidden" id="t2" name="donus_saati_submit" value="{{date("H")+1}}:00">
																				<div class="date" onclick="openCalendar2()"><?=date('d', strtotime($data['checkout']))?></div>
																				<div class="date-detail">
																				<span class="month uppercase" onclick="openCalendar2()"><?php echo \App\Service\Search::getMounthName($data['checkout'], 1) ?></span>
																					<span class="day" onclick="openCalendar2()"><?php echo \App\Service\Search::getMounthName($data['checkout'], 3) ?></span>
																				</div>
																				<div class="date-detail timer fa fa-clock t2">
																					<span class="time"><b>{{date("H")+1}}</b>:00</span>
																				</div>
																			</div>
																	</div>
                                                                    <div class="col-12">
																		<div style="margin-top:10px">
																			<button type="button" style="width: 90%;height: 40px; border: none;" class="form-control btn-primary applyBtn">{{__('hesapla')}}</button>
																			<div style="margin: 25px 0;" class="form-group col-sm-12 col-xs-12">
																				<span style="font-size: 25px;line-height: 1;">{{__('ara_toplam')}}:<span>
																				<span style="font-weight: bolder;" id="SubTotal">0 €</span>
																			</div>
																		</div>
                                                                    </div>
                                                                    <div class="carSearch">
																	<div style="margin-top:20px" class="">
																		<div class="row">
																			<div class="col-12">
																				<div class="sidebar-title"><h3 style="font-weight: 600 !important;">{{__('extra_services')}}</h3></div>
																			</div>
@dd($item);
																			<div class="">
																				<div class="ekstraPackage">
																				   <?php $son_fiyat =0; ?>
                                                                                    @foreach($data['ekstras'] as $ekstra)

                                                                                         <div class="col-12 col-md-6">
                                                                                            <div class="price-row extra_{{$data['all_campain']->id_car}}_<?=$ekstra['id']?>">
                                                                                                <div class="row">
													<span class="col-9 col-md-7"><img  class="ekstraimg" src="{{asset('public/view/icon/'.$ekstra['image'].'')}}"/>{{ \App\Models\EkstraLanguage::getSelectLang($ekstra['id'],'title',$data['langId'])}}
														<small><?php if($ekstra['sellType'] == "daily"){ ?>{{ __('extra_daily') }}<?php }else{ ?> {{ __('extra_ofrent') }} <?php } ?></small>
														<i data-toggle="popover" data-trigger="hover" data-content="{{ \App\Models\EkstraLanguage::getSelectLang($ekstra['id'],'info',$data['langId'])}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
													</span>
                                                                                                    <span class="col-3 col-md-2 text-right" id="totalprice_div_{{$data['all_campain']->id_car}}_<?=$ekstra['id']?>">
                                                        <?php if($ekstra['mandatoryInContract'] == 'yes'){?> {{$ekstra['price'] * $item['days']}} <?php }else{ ?> {{$ekstra['price']}} <?php  } ?>  {{$data['currency']}}

													</span>
                                                                                                    <div class="col-12 col-md-3">
                                                                                                        <div class="row">
                                                                                                            <div class="col-4 col-md-12"></div>
                                                                                                            <div class="col-6 col-md-12">
                                                                                                                <button style="float: left;background:#d0d5db;height: 30px;"
                                                                                                                        id="button_minus_ekstra_{{$data['all_campain']->id_car}}_<?=$ekstra['id']?>" onclick="addEkstra({{$data['all_campain']->id_car}},<?=$ekstra['id']?>,'minus',{{$son_fiyat}},'{{$data['currency']}}','{{$ekstra['sellType']}}')"
                                                                                                                        class="btn btn-spinner col-4" type="button" disabled><i class="fa fa-minus"></i>
                                                                                                                </button>
                                                                                                                <input id="ekstra_{{$data['all_campain']->id_car}}_<?=$ekstra['id']?>"
                                                                                                                       data-price="<?php echo $ekstra['price']; ?>"
                                                                                                                       data-day="{{$item["days"]}}"
                                                                                                                       style="float: left;width: 40%;height:30px;text-align: center;font-weight: 600;color:#002a68"
                                                                                                                       maxlength="<?=$ekstra['value']?>"
                                                                                                                       class="form-control col-4"
                                                                                                                       name="ekstra[<?=$ekstra['id']?>][]"
                                                                                                                       value="<?php if($ekstra['mandatoryInContract'] == 'yes'){echo"1";}else{echo"0";} ?>"
                                                                                                                       readonly/>
                                                                                                                <button style="float: left;background: #cfcdc9;height: 30px;"
                                                                                                                        id="button_plus_ekstra_{{$data['all_campain']->id_car}}_<?=$ekstra['id']?>"
                                                                                                                        onclick="addEkstra({{$data['all_campain']->id_car}},<?=$ekstra['id']?>,'plus',$('#son_price').text(),'{{$data['currency']}}','{{$ekstra['sellType']}}')"
                                                                                                                        class="btn btn-spinner col-4" type="button" <?php if($ekstra['mandatoryInContract'] == 'yes'){echo"disabled";} ?>><i style="line-height: 1;float: right;" class="fa fa-plus"></i>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
																				</div>
																			</div>
																		</div>
																		<div>
																			<hr style="width: 100%;">
																			<div style="margin: 0;" class="form-group col-sm-12 col-xs-12">
																				<span style="font-size: 25px;line-height: 1;">{{__('total')}}:<span>
																				<span style="font-weight: bolder;" id="Total">0 €</span>
																				 <input name="totalPrice" id="TotalInput" type="hidden">
																			</div>
																			<hr style="width: 100%;">
																			<div class="form-group col-sm-12 col-xs-12">
																				<button type="submit" class="theme-btn btn-success" style="width: 90%;height: 40px; border: none;">{{__("create_reservation")}}</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															</div>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <style>
    div#cikis_timer, div#donus_timer {
    padding: 4px 0 3px 33px;
    width: 90%;
    background-color: white;
    cursor: pointer;
}
.price-row {
    border: none;
}
.carSearch .fa-calendar-alt:before {left: 21px;height: 20px;}
@media (max-width: 768px){
	.col-4 {
    flex: inherit;
}
.carSearch .fa-calendar-alt:before {left: 86px;height: 20px;}
.desc {
    display: block;
    color: black;
    float: left;
    position: absolute;
    padding: 12px 5px;
    height: 34px;
    width: 50px;
    border-left: 2px solid #f9af00;
}
}
    </style>

    <script>

function addEkstra(id, id_ekstra, type, totalRentalprice,currency) {alert("asdasd");
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
        $("#pick_up_location").change(function () {
            var id = $(this).val();
            getDropLocation(id);
        });

        function getDropLocation(id) {
            $("#pick_down_location").html('');
            if (id == "") {
                var id_location = 0;
            } else if (id == undefined) {
                var id_location = 0;
            } else {
                var id_location = id;
            }
            $.ajax({
                type: 'GET',
                url: '/getDropLocation?id=' + id_location + '',
                success: function (data) {
                    console.log(data);
                    var row = "";
                    var x = 0;
                    $.each(data, function (key, value) {
                        if (value.id_parent == 0) {
                            row += '<optgroup label="' + value.title + '">';
                            $.each(value.parentList, function (keys, values) {
                                row += '<option  value="' + keys.id + '">' + values.title + '</option>';
                            });
                            row += '</optgroup>';
                        }
                        x++;
                    });
                    $("#pick_down_location").append(row);
                }
            });
        }
    </script>

    <script>

        $(document).ready(function () {
            $(".ekstraPackage .decrease").on("click", function () {

                var name = [];
                var value = [];

                $('.extras-list__input').each(function() {
                    name.push($(this).attr('id'));
                    value.push($(this).val());
                });



                var checkin = $("input[name='cikis_tarihi_submit']").val();
                var checkinTime = $("input[name='cikis_saati_submit']").val();
                var checkout = $("input[name='donus_tarihi_submit']").val();
                var checkoutTime = $("input[name='donus_saati_submit']").val();
                var id_car = $("input[name='id_car']").val();
                var id_campain = $("input[name='id_campain']").val();


                var pick_up_location = $("select[name='pick_up_location1']").val();

                if (pick_up_location == 0) {
                    $(".extras-list__input").val(0);
                    $(".decrease").attr("disabled", true);
                    $(".increase").attr("disabled", false);
                    swal("Alış Bölgesi Seçiniz !");
                } else {
                    var pick_down = $("select[name='pick_down_location1']").val();

                    if (pick_down == 0) {
                        var pick_down_location = pick_up_location;
                    }

                    $.ajax({
                        url: '/Calculate?checkin=' + checkin + '&checkinTime=' + checkinTime + '&checkout=' + checkout + '&checkoutTime=' + checkoutTime + '&id_car=' + id_car + '&id_campain=' + id_campain + '&pick_up_location=' + pick_up_location + '&pick_down_location=' + pick_down_location + '&name=' + name + '&value=' + value + '',
                        cache: false,
                        processData: false,
                        contentType: false,
                        method: "get",
                        success: function (gelenveri) {
                            $("#Total").text(gelenveri.price + "€");
                            $("#TotalInput").val(gelenveri.price);
                        },
                        error: function (hata) {

                        }
                    });
                }
            });

            $(".ekstraPackage .increase").on("click", function () {

                var name = [];
                var value = [];


                $('.extras-list__input').each(function() {
                    name.push($(this).attr('id'));
                    value.push($(this).val());
                });



                var checkin = $("input[name='cikis_tarihi_submit']").val();
                var checkinTime = $("input[name='cikis_saati_submit']").val();
                var checkout = $("input[name='donus_tarihi_submit']").val();
                var checkoutTime = $("input[name='donus_saati_submit']").val();
                var id_car = $("input[name='id_car']").val();
                var id_campain = $("input[name='id_campain']").val();


                var pick_up_location = $("select[name='pick_up_location1']").val();

                if (pick_up_location == 0) {
                    $(".extras-list__input").val(0);
                    $(".increase").attr("disabled", false);
                    $(".decrease").attr("disabled", true);
                    swal("Alış Bölgesi Seçiniz !");
                } else {
                    var pick_down = $("select[name='pick_down_location1']").val();

                    if (pick_down == 0) {
                        var pick_down_location = pick_up_location;
                    }

                    $.ajax({
                        url: '/Calculate?checkin=' + checkin + '&checkinTime=' + checkinTime + '&checkout=' + checkout + '&checkoutTime=' + checkoutTime + '&id_car=' + id_car + '&id_campain=' + id_campain + '&pick_up_location=' + pick_up_location + '&pick_down_location=' + pick_down_location + '&name=' + name + '&value=' + value + '',
                        cache: false,
                        processData: false,
                        contentType: false,
                        method: "get",
                        success: function (gelenveri) {
                            console.log(gelenveri);
                            $("#Total").text(gelenveri.price + "€");
                            $("#TotalInput").val(gelenveri.price);
                        },
                        error: function (hata) {

                        }
                    });
                }
            });
        });


        $(document).ready(function () {

            $(".applyBtn ").click(function () {
                var checkin = $("input[name='cikis_tarihi_submit']").val();
                var checkinTime = $("input[name='cikis_saati_submit']").val();
                var checkout = $("input[name='donus_tarihi_submit']").val();
                var checkoutTime = $("input[name='donus_saati_submit']").val();
                var id_car = $("input[name='id_car']").val();
                var id_campain = $("input[name='id_campain']").val();


                var pick_up_location = $("select[name='pick_up_location1']").val();

                if (pick_up_location == 0) {
                    swal("Alış Bölgesi Seçiniz !");
                } else {
                    var pick_down = $("select[name='pick_down_location1']").val();
                    if (pick_down == 0) {
                        var pick_down_location = pick_up_location;
                    }

                    $.ajax({
                        url: '/Calculate?checkin=' + checkin + '&checkinTime=' + checkinTime + '&checkout=' + checkout + '&checkoutTime=' + checkoutTime + '&id_car=' + id_car + '&id_campain=' + id_campain + '&pick_up_location=' + pick_up_location + '&pick_down_location=' + pick_down_location + '',
                        cache: false,
                        processData: false,
                        contentType: false,
                        method: "get",
                        success: function (gelenveri) {
                            $("#SubTotal").text(gelenveri.price + "€");
                            $("#Total").text(gelenveri.price + "€");
                            $("#TotalInput").val(gelenveri.price);
                        },
                        error: function (hata) {

                        }
                    });
                }

            });


        });

    </script>
@endsection

<style>
.header-blogdetail {
    position: relative;
    background-repeat: no-repeat;
    background-color: #f6f6f6;
    background-position: center center;
    text-align: center;
}

img.ekstraimg {
width: 20px;
margin-right: 10px;
}

.clearfix, clearfix:after {
display: table;
content: " ";
}

.news-style-one .lower-content .text p {
position: relative;
margin-bottom: 20px;
}


.default-form .field-label {
display: block;
line-height: 24px;
margin-bottom: 10px;
color: #777777;
font-weight: 400;
font-size: 16px;
}


.default-form .form-group {
position: relative;
margin-bottom: 20px;
}

.default-form .form-group .field-inner {
position: relative;
}

    .default-form input[type="text"], .default-form input[type="email"], .default-form input[type="password"], .default-form input[type="tel"], .default-form input[type="url"], .default-form select, .default-form textarea {
        display: block;
        width: 100%;
        line-height: 22px;
        height: 44px;
        font-size: 14px;
        border: 1px solid #e3e3e3;
        padding: 10px 20px;
        background-color: #ffffff;
        color: #222222;
        border-radius: 3px;
        transition: all 500ms ease;
        -webkit-transition: all 500ms ease;
        -ms-transition: all 500ms ease;
        -o-transition: all 500ms ease;
    }

    .span-bottom-20 {
        margin-bottom: 20px;
    }

    .booking-tabs .default-form .row {
        margin: 0px -10px;
    }

    .default-form .form-group .field-inner .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        margin-top: -10px;
        line-height: 20px;
        font-size: 12px;
        color: #18ba60;
    }

    .default-form .check-box label .square {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 14px;
        height: 14px;
        border: 1px solid #eeeeee;
    }

    .default-form .check-box label .icon {
        position: absolute;
        left: 0px;
        top: 4px;
        display: block;
        width: 16px;
        height: 16px;
    }

    .default-form .check-box label .fa {
        position: absolute;
        left: 0px;
        top: 0px;
        color: #18ba60;
        padding-right: 2px;
        width: 16px;
        height: 16px;
        line-height: 16px;
        font-size: 10px;
        text-align: center;
        opacity: 0;
    }

    .default-form .check-box label {
        position: relative;
        display: block;
        font-weight: normal;
        padding-left: 26px;
        font-size: 14px;
        line-height: 24px;
        cursor: pointer;
    }

    .default-form .check-box input {
        position: absolute;
        top: 6px;
        z-index: 9;
    }
.form-area .loc span.greenLabel,.form-area .loc span.redLabel {
    color: #020202!important;
    text-shadow: none!important;
}
.form-area .loc span.redLabel {
    margin-left: 11rem!important;
    padding-bottom: 0.5rem;
}

</style>

