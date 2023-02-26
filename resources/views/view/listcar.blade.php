<div class="accordion" id="accordionExample">
    <?php use Illuminate\Support\Facades\Crypt;  foreach ($data as $item){    ?>
    <div class="car-item car_{{$item["id_car"]}} col-md-12 category_0 category_{{$item["category"]}} transmission_{{$item["transmission"]}}">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <h4>{{$item["car"]}} <small>{{__('veya benzeri')}}</small>
                        <i data-toggle="popover" data-trigger="hover" data-content="{{$item["car"]}}  {{__("or_car")}}" class="extras-list__info fa fa-info ativo popoverFileSee"></i>
                    </h4>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="image-thumb">
                            <?php if($item['image']){ ?>
                            <img src="{{ asset('storage/uploads/') }}/{{$item['image']}}" alt="{{$item["car"]}} "  style="max-width: 100%;">
                            <?php }else{ ?>
                            <img src="{{ asset('public/view/images/no-image.jpg') }}" alt="{{$item["car"]}} " style="max-width: 100%;">
                            <?php } ?>
                        </div>
                        <?php $i = 0; foreach ($item['imageLists'] as $imageItem){ ?>
                        <a href="{{asset("storage/uploads/")}}/{{$imageItem->title}}" class="btn lightbox" data-group="gallery{{$item["id_car"]}}">
                            @if($i == 0)
                                {{--<i class="fas fa-images"></i> {{__('Araç Resimleri')}}--}}
                            @endif
                            <img src="{{asset("storage/uploads/")}}/{{$imageItem->title}}" alt="{{$item["car"]}}" width="0" style="display: none">
                        </a>
                        <?php $i++; } ?>
                    </div>
                    <div class="col-6 col-md-7">
                        <div class="row">
                            <div class="col-12 item-prop mb-3">
                                <div class="text-left row">
                                    <div class="col-lg-4 col-md-4 col-6 pr-0">
                                        <i class="glyph-icon flaticon-sit"></i>
                                        {{$item["passenger"]}} {{__('pasager')}}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6 pr-0"><i
                                            class="glyph-icon flaticon-car-door"></i>
                                        {{$item["doors"]}} {{__('door')}}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 pr-0"><i class="glyph-icon flaticon-snowflakes"></i>
                                        <?php if($item['air_conditioner'] == 1){ ?>
                                        <span>{{__('Evet')}}</span>
                                        <?php }else{ ?>
                                        <span>{{__('Hayır')}}</span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 pr-0"><i
                                            class="glyph-icon flaticon-gasoline"></i>
                                        {{$item["fuel"]}}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6 pr-0"><i
                                            class="glyph-icon flaticon-gear-shift"></i>
                                        {{$item["transmission"]}}
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-6 pr-0"><i
                                            class="glyph-icon flaticon-luggage"></i>
                                        {{$item["big_luggage"]}} {{__('big_suitcase')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 item-extra d-none d-xl-block">
                                <div class="row">
                                    <div class="col-lg-6 col-md-5" style="font-weight: 400;font-size:14px">
                                        <i class="fa fa-check text-primary"></i>
                                        <?php if($item['car_km_day'] < $item['days']){ ?>
                                        <span>  {{__('km_limit')}} : {{__('unlimited_km')}}</span>
                                        <?php }else{ ?>
                                        <span> {{__('km_limit')}} :{{$item["days"] * $item["car_km"]}}</span>
                                        <?php } ?>
                                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_1')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                                        <br>
                                        <i class="fa fa-check text-primary"></i> {{__('minimum_driver_age')}}
                                        : {{$item["driver_age"]}}
                                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_2')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                                        <br>
                                    </div>
                                    <div class="col-lg-6 col-md-7" style="font-weight: 400;font-size:14px">
                                        <i class="fa fa-check text-primary"></i> {{__('minimum_driver_licance')}}
                                        : {{$item["license_age"]}}
                                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_3')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                                        <br>
                                        <i class="fa fa-check text-primary"></i> {{__('additional_driver')}}: {{__('free')}}
                                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_4')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block d-xl-none">
                    <div class="row">
                        <div class="col-6 checkli"><i class="fa fa-check text-primary"></i>
                            <?php if($item["days"] >= $item["car_km_day"]){ ?>
                            <span> {{__('km_limit')}} : {{__('unlimited_km')}}</span>
                            <?php } ?>
                            <?php if($item["days"] <= $item["car_km_day"]){ ?>
                            <span>  {{__('km_limit')}} : {{$item["days"] * $item["car_km"]}}</span>
                            <?php } ?>
                            <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_1')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                        </div>
                        <div class="col-6 checkli"><i class="fa fa-check text-primary"></i> {{__('minimum_driver_age')}}
                            : {{$item["driver_age"]}}
                            <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_2')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                        </div>
                        <div class="col-6 checkli"><i class="fa fa-check text-primary"></i> {{__('minimum_driver_licance')}}
                            : {{$item["license_age"]}}
                            <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_3')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                        </div>
                        <div class="col-6 checkli"><i class="fa fa-check text-primary"></i> {{__('additional_driver')}}
                            : {{__('free')}}
                            <i data-toggle="popover" data-trigger="hover" data-content="{{__('orta_4')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <?php if($item["price"]['day_price'] > 0){ ?>
                <div style="color: #102a70;background: #fbfbfb;border: 1px solid #e4e4e4;padding: 0 3px;">
                    <span style="font-size:16px;text-indent: 10px;font-weight: 600;margin-left: 7px;">{{__('dayPrice')}}</span>
                    <span style=" font-size: 35px;line-height: 1.1;font-weight: 600;">{{$item["price"]['day_price']}}<span style="vertical-align: top;line-height: 1.6;font-size: 25px;font-weight: 600;">{{$currency}}</span></span>

                </div>
                <div class="item-price-daily">
                    <div>{{__('rental_period')}}: <span style="float: right;">{{$item["price"]["total_day"]}} {{__('day')}}</span>
                    </div>
                    <?php if($item['price']['discount'] > 0){ ?>
                    <div class="row_discount">İndirim : <span style="float: right;"> %{{$item["price"]['discount']}} </span>
                    </div>
                    <?php } ?>
                    <?php if($item["price"]['drop_price'] > 0){ ?>
                    <div>{{__('dropPrice')}} <span style="float: right;">   {{$item["price"]['drop_price']}} {{$currency}}</span>
                    </div>
                    <?php } ?>

                    <?php if($item["price"]['up_price'] > 0 ){ ?>
                    <div>{{__('teslimPrice')}} <span style="float: right;"> {{$item["price"]['up_price']}} {{$currency}}</span>
                    </div>
                    <?php } ?>
{{--                    <?php if($item["price"]['rent_price'] > 0 ){ ?>--}}
{{--                    <div>{{__('rentPrice')}} <span style="float: right;"> {{$item["price"]['rent_price']}} {{$currency}}</span>--}}
{{--                    </div>--}}
{{--                    <?php } ?>--}}
                        <?php if($item["price"]['rent_price'] > 0 ){ ?>
                          <div>{{__('rentPrice')}} <span style="float: right;"> {{$item["price"]['main_price']}} {{$currency}}</span> </div>
                        <?php } ?>
                </div>
                <a data-toggle="collapse" class="btn btn-outline-primary focus-chgDate d w-100 d-none d-md-block car_sel" id="car_list{{$item["id_car"]}}" href="#collapse{{$item["id_car"]}}">{{__('car_select')}}</a>
                <?php }else{ ?>
                <div class="hotel-points">
                </div>
                <div id="hotel-reviewContent-sxnnzxj7y1ee" class="row d-none">
                    <div class="col-12 m-0 p-0">
                        <ul class="category-field p-0 m-0 hotel-review-popover-content">
                        </ul>
                    </div>
                </div>

                <div class="price-card price-card-height">
                    <div class="change-date-card">
                        <div class="change-date">
                            <div class="pb-1 chg-date-text">{{__('noPriceText')}}</div>
                            <button class="btn btn-outline-primary focus-chgDate d" style="width:100%">{{__('reCall')}}</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <footer class="card-result__footer_25vAN6Zr card-result__footer--fluid-list_3sr-UMHR">
                <strong class="included-title_2tPQsLU1">{{__('fiyatDahil')}}: </strong>
                <div class="row col-12">
                    <div class="col-6 col-sm-2 checkli" title="{{__('dahil1')}}"><i class="fa fa-check text-primary"></i>{{__('dahil1')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil1text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                    <div class="col-6 col-sm-2 checkli"><i class="fa fa-check text-primary"></i> {{__('dahil2')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil2text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                    <div class="col-6 col-sm-2 checkli"><i class="fa fa-check text-primary"></i> {{__('dahil3')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil3text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                    <div class="col-6 col-sm-2 checkli"><i class="fa fa-check text-primary"></i> {{__('dahil4')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil4text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                    <div class="col-6 col-sm-2 checkli"><i class="fa fa-check text-primary"></i> {{__('dahil5')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil5text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                    <div class="col-6 col-sm-2 checkli"><i class="fa fa-check text-primary"></i> {{__('dahil6')}}
                        <i data-toggle="popover" data-trigger="hover" data-content="{{__('dahil6text')}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
                    </div>
                </div>
            </footer>
        </div>
        <div class="row">
            <form action="reservation" method="post" style="width: 100%;margin-bottom: 0;">
                @csrf
                 <?php  $son_fiyat = $item["price"]["discount_price"];  // $son_fiyat = \Akaunting\Money\Money::{$kur}($item["price"]["discount_price"],TRUE); ?>
                <div id="collapse{{$item["id_car"]}}" class="colsspan_car_list{{$item["id_car"]}} panel-collapse collapse" style="width: 100%;" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="panel-body">
                        <div id="home" class="ekstralist">
                            <div class="col-12 col-md-5 d-none">
                                <div class="car-slide-c">
                                    <div class="imageOn">
                                        <div id="carouselExampleControls{{$item["id_car"]}}"
                                             class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php $i = 0; foreach ($item['imageLists'] as $imageItem){ ?>
                                                <div class="carousel-item <?php if ($i == 0) { echo "active";} ?>">
                                                    <img class="d-block w-100" style="    height: 350px;" src="{{asset("storage/uploads/")}}/{{$imageItem->title}}">
                                                </div>
                                                <?php $i++; } ?>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls{{$item["id_car"]}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next"href="#carouselExampleControls{{$item["id_car"]}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12" style="color:#fff;border-left: 1px solid #dde1e6;">
                                <div class="row row-price"><span class="col-12">{{__('list_service_tab2')}}</span></div>
                                <div class="row">
                                     @foreach($ekstras as $ekstra)
                                        <div class="col-12 col-md-6">
                                            <div class="price-row extra_{{$item["id_car"]}}_<?=$ekstra['id']?>">
                                                <div class="row">
													<span class="col-9 col-md-7"><img  class="ekstraimg" src="{{asset('public/view/icon/'.$ekstra['image'].'')}}"/>{{ \App\Models\EkstraLanguage::getSelectLang($ekstra['id'],'title',$langId)}}
														<small><?php if($ekstra['sellType'] == "daily"){ ?>{{ __('extra_daily') }}<?php }else{ ?> {{ __('extra_ofrent') }} <?php } ?></small>
														<i data-toggle="popover" data-trigger="hover" data-content="{{ \App\Models\EkstraLanguage::getSelectLang($ekstra['id'],'info',$langId)}}" data-placement="top" class="fa fa-info popoverFileSee"></i>
													</span>
													<span class="col-3 col-md-2 text-right" id="totalprice_div_{{$item["id_car"]}}_<?=$ekstra['id']?>">
                                                        <?php if($ekstra['mandatoryInContract'] == 'yes'){?> {{$ekstra['price'] * $item['days']}} <?php }else{ ?> {{$ekstra['price']}} <?php  } ?>  {{$currency}}

													</span>
                                                    <div class="col-12 col-md-3">
                                                        <div class="row">
                                                        <div class="col-4 col-md-12"></div>
                                                        <div class="col-6 col-md-12">
                                                            <button style="float: left;background:#d0d5db;height: 30px;"
                                                                    id="button_minus_ekstra_{{$item["id_car"]}}_<?=$ekstra['id']?>" onclick="addEkstra({{$item["id_car"]}},<?=$ekstra['id']?>,'minus',{{$son_fiyat}},'{{$currency}}','{{$ekstra['sellType']}}')"
                                                                    class="btn btn-spinner col-4" type="button" disabled><i class="fa fa-minus"></i>
                                                            </button>
                                                            <input id="ekstra_{{$item["id_car"]}}_<?=$ekstra['id']?>"
                                                                   data-price="<?php echo $ekstra['price']; ?>"
                                                                   data-day="{{$item["days"]}}"
                                                                   style="float: left;width: 40%;height:30px;text-align: center;font-weight: 600;color:#002a68"
                                                                   maxlength="<?=$ekstra['value']?>"
                                                                   class="form-control col-4"
                                                                   name="ekstra[<?=$ekstra['id']?>][]"
                                                                   value="<?php if($ekstra['mandatoryInContract'] == 'yes'){echo"1";}else{echo"0";} ?>"
                                                                   readonly/>
                                                            <button style="float: left;background: #cfcdc9;height: 30px;"
                                                                    id="button_plus_ekstra_{{$item["id_car"]}}_<?=$ekstra['id']?>"
                                                                    onclick="addEkstra({{$item["id_car"]}},<?=$ekstra['id']?>,'plus',$('#son_price').text(),'{{$currency}}','{{$ekstra['sellType']}}')"
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
                                <div id="son_price" style="display:none"><?php echo $son_fiyat . $currency?></div>
                                <div class="row reserve-end">
                                    <div class="col-12 col-md-4 text"><i class="fa fa-check"></i> {{__('selectCart1')}}</div>
                                    <div class="col-12 col-md-3 text"><i class="fa fa-check"></i> {{__('selectCart2')}}</div>
                                    <div class="col-6 col-md-3 text-right" id="reservationTotalRentalPrice">
                                        <span style="font-weight: bold;">{{__("total")}} :</span>
                                        <span class="lastprice"><?php echo $son_fiyat .$currency; ?></span>
                                    </div>
                                    <input value="<?=$item["id_car"]?>" type="hidden" name="id_car">
                <input value="<?=Crypt::encrypt($item["price"])?>" type="hidden" name="hidden">
                <input value="<?=$currencyData?>" name="currency_price" type="hidden"/>
                <input type="hidden" value="{{$item["id_car"]}}" name="id_car">
                <input type="hidden" value="{{$item["days"]}}" name="days">
                <input type="hidden" value="{{$item["price"]['day_price']}}" name="day_price">
                <input type="hidden" value="{{$item["price"]["main_price"]}}" name="main_price">
                <input type="hidden" value="{{$item["price"]["up_price"]}}" name="up_price">
                <input type="hidden" value="{{$item["price"]["drop_price"]}}" name="drop_price">
                <input type="hidden" value="{{$item["price"]["rent_price"]}}" name="rent_price">
                <input type="hidden" value="{{base64_encode($item["price"]["discount"])}}" name="discount">
                <input type="hidden" value="{{$item["price"]["discount_price"]}}" name="discount_price">
                <input type="hidden" value="{{$son_fiyat}}" name="last_price">
                <input type="hidden" value="{{$item["price"]["mandatoryInContract"]}}" name="mandatoryInContract">
                <input type="hidden" value="{{$item["price"]["currency_data"]}}" name="currency_data">
                <input type="hidden" value="{{$item["price"]["ekstra_including_price"]}}" name="ekstra_including_price">
                <input type="hidden" value="{{$currency}}" name="currency">
                                    <div class="col-6 col-md-2">
                                        <button ng-model-options="{ updateOn: 'blur mouseover' }" data-toplam="{{$son_fiyat}}" class="btn btn-block btn-success reservationNextButton"> {{__('Devam Et')}} <i style="vertical-align: inherit;" class="fas fa-angle-double-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php if($item["price"]['day_price'] > 0){ ?>
        <div class="row">
            <a data-toggle="collapse" class="btn btn-outline-primary focus-chgDate w-100 d-block d-xl-none mm-x" id="car_list{{$item["id_car"]}}" href="#collapse{{$item["id_car"]}}">{{__('car_select')}}</a>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <style>
        .chg-date-text {text-align: center;color: #f5a416;font-weight: 500;}
        .p-0 {padding: 0 !important;}
        .hotel-points, .price-card {height: auto;border-radius: 6px;background-color: #f6f9fd;float: right;width: 100%;text-align: right;margin-bottom: 3px;
            padding: 15px;margin-left: 15px;position: relative;z-index: 1;}
        .hotel-review-popover-content {min-width: 200px;}
        .show-price-card, .change-date-card {width: 100%;min-height: 125px;bottom: 0;padding-top: 30px;}
        .change-date {bottom: 15px;last_priceposition: absolute;width: 88%;}
        @media (min-width: 769px) {.mm-x {display: none!important;}}
    </style>
    <script>
        var tobii = new Tobii()
        $(document).ready(function (){
            $(".car-item").on('click','.focus-chgDate.d',function (){
                let btn = $('.focus-chgDate.d'),html = $(this).text()
                btn.text('{{__('Araç Seç')}}')
                if(html==''){
                    $(this).html('{{__('Araç Seç')}}')
                }else{
                    $(this).html('<i class="fa fa-close" aria-hidden="true"></i>')
                }
            });
            $(".car-item").on('click','.focus-chgDate.mm-x',function (){
                $('.focus-chgDate.mm-x').attr('style','')
                $(this).attr('style','visibility:hidden;height:0;padding:0')
                let e = $(this).attr('href');
                $('body').animate({scrollTop: $(e).offset().top},500);
            });
        });
        $('[data-toggle="popover"]').popover()
        $(document).on( "click", ".popoverFileSee", function() {
            $(this).popover("toggle");
        });
    </script>
