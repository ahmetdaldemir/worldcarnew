@extends('layouts.welcome')
<link href="{{ asset('public/view/css/reservation.css') }}" rel="stylesheet"/>
<link href="{{ asset('public/view/css/intlTelInput.css') }}" rel="stylesheet"/>
<link href="{{ asset('public/view/country/countrySelect.css') }}" rel="stylesheet"/>

@section('content')
    <!--
    <section class="header-blogdetail">
        <div class="container">
            <div class="text-center">
                <h4>{{__('Müsteri Bilgileri')}}</h4>
            </div>
        </div>
    </section>-->
    <div class="reservation">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div id="fixed-div">
                        <div class="card">
                            <div class="card-body">
                                <h4 style="    font-size: 20px;    text-align: center;">{{$data["cars"]}} {{__('veya')}}
                                    <i style="font-size: 15px" id="popoverOption" data-toggle="popover"
                                       data-trigger="hover" data-container="body"
                                       data-content="{{$data["cars"]}} {{__('or_car')}}"
                                       class="extras-list__info fa fa-info ativo tooltipstered"></i>
                                </h4>
                                <div class="image-thumb">
                                    <img style="width: 100%" src="{{ asset('storage/uploads/'.$data["car"]->default_images.'') }}" alt="{{$data["cars"]}} ">
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-12">
                                        <b><i class="fa fa-car" aria-hidden="true"></i>
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </b>
                                        {{$data['up_location']}}
                                        : {{date("d-m-Y",strtotime($data["reservationOptions"]["cikis_tarihi_submit"]))}}
                                        <i class="fa fa-clock"
                                           aria-hidden="true"></i> {{$data["reservationOptions"]["cikis_saati_submit"]}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <b><i class="fa fa-car" aria-hidden="true"></i> <i
                                                class="fa fa-angle-double-left" aria-hidden="true"></i> </b>
                                        {{$data['down_location']}}
                                        : {{date("d-m-Y",strtotime($data["reservationOptions"]["donus_tarihi_submit"]))}}
                                        <i class="fa fa-clock"
                                           aria-hidden="true"></i> {{$data["reservationOptions"]["donus_saati_submit"]}}
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h5>{{__('price_detail')}}</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">{{__('rent_price')}} <span
                                                style="font-weight:600;float: right;">{{$data['datas']->rent_price}} {{$data['datas']->currency}}</span>
                                        </li>

                                        @foreach($data["ekstra"] as $item)
                                            @if($item["EkstaItem"] > 0 && $item["TotalItemPrice"]>0)
                                                <li class="list-group-item">{{$item["EkstaName"]}} <span
                                                        style="font-weight:600;float: right;">
                                                 @if($item['sellType'] != 'ofRent')
                                                            {{ $item["TotalItemPrice"] * $data['datas']->days}}  {{$data['datas']->currency}}
                                                        @else
                                                            {{ $item["TotalItemPrice"]}}  {{$data['datas']->currency}}
                                                        @endif
                                                 </span></li>
                                            @endif
                                        @endforeach
                                        @if(is_numeric($data['datas']->up_price ) && $data['datas']->up_price > 0)
                                            <li class="list-group-item"><b>{{__('up_price')}}</b> <span
                                                    style="font-weight:600;float: right;">{{$data['datas']->up_price}}  {{$data['datas']->currency}}</span>
                                            </li>
                                        @endif
                                        @if(is_numeric($data['datas']->drop_price ) && $data['datas']->drop_price > 0)
                                            <li class="list-group-item"><b>{{__('drop_price')}}</b> <span
                                                    style="font-weight:600;float: right;">{{$data['datas']->drop_price}}  {{$data['datas']->currency}}</span>
                                            </li>
                                        @endif
                                        @if($data['discount'] > 0)
                                            <li class="list-group-item"><b>İndirim</b> <span
                                                    style="font-weight:600;float: right;color: #00a52d">%  {{$data['discount']}}</span>
                                            </li>
                                        @endif
                                        {{--                                            <li class="list-group-item"><b>Ekstra Total</b> <span--}}
                                        {{--                                                    style="font-weight:600;float: right;">{{$data["ekstraTotal"]}}  {{$data['datas']->currency}}</span>--}}
                                        {{--                                            </li>--}}

                                        @if(is_numeric($data['datas']->last_price ))
                                            <li class="list-group-item"><b>{{__('total')}}</b> <span
                                                    style="font-weight:600;float: right;"><?php $xx = $data['datas']->rent_price + $data['datas']->up_price + $data['datas']->drop_price + $data["ekstraTotal"];
                                                    if($data['discount'] > 0)
                                                        {
                                                          echo  $xx - (($xx * $data['discount'])  / 100);
                                                        }else{
                                                        echo $xx;
                                                    }
                                                    ?>  {{$data['datas']->currency}}</span>
                                            </li>

                                        @endif
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 style="font-size: 17px;"><i class="fa fa-tags"></i> {{__("discount_query")}}</h4>
                                <div class="input-group default-group-style">
                                    <input type="text" name="discount_code" class="form-control col-md-7"
                                           placeholder="{{__('discount_code')}}" autocomplete="false">
                                    <input type="button" name="tel" id="phone"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                           class="form-control btn btn-success col-md-5"
                                           value="{{__('discount_button')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php if(!Auth::guard('web')->check()){ ?>
                    <div class="alert alert-block alert-info">
                        <div class="auto-container">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="row">
                                <div class="col-2">
                                    <i class="fa fa-user-lock" style="font-size: 25px;"></i>
                                </div>
                                <div class="col-10">
                                    <p>{{__('accountVarsa')}}<a href="/{{app()->getLocale()}}" style="font-weight: 600;"
                                                                data-toggle="modal"
                                                                data-target=".login">{{__('Login')}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <form id="checkout" action="checkout" method="post" class="form-group" autocomplete="off">
                        @csrf
                        <div class="card">
                            <div class="card-header"
                                 style="color: #545454;font-weight: 600;font-size: 18px;">{{__('peronal_information')}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('name')}}</label>
                                        <input id="firstnameInput" type="text" required name="firstname"
                                               class="form-control default-input"
                                               value="{{ Auth::guard('web')->user()->firstname ?? NULL}}"
                                               autocomplete="off"/>
                                        <div id="spanmail"></div>
                                    </div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('lastname')}}</label>
                                        <input id="lastnameInput" type="text" required name="lastname"
                                               class="form-control default-input"
                                               value="{{ Auth::guard('web')->user()->lastname ?? NULL }}"
                                               autocomplete="off"/>
                                        <div id="spanmail"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group default-group-style col-md-6" style="width: 100%;">
                                        <label style="width: 100%" for="name">{{__('origin_country')}}</label>
                                        <input id="country" required name="nationality" class="form-control" type="text"
                                               value="{{ Auth::guard('web')->user()->nationality ?? NULL }}"
                                               autocomplete="off"  style="    width: 90%;"/>
                                    </div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('mobile')}}</label>
                                        <input type="text" name="phone_country" id="phone_country" autocomplete="false"
                                               maxlength="5" class="form-control col-3 col-md-3"
                                               style="background: #FCFCFC;"
                                               value="{{ Auth::guard('web')->user()->phone_country ?? "+90" }}"
                                               readonly=""/>
                                        <input id="telInput" type="text" required name="tel" id="phone"
                                               class="form-control col-9 col-md-9"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                               value="{{ \App\Helpers\Helper::authphonereplace() ?? NULL}}"
                                               autocomplete="false"/>
                                        <div id="spanmail"></div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('E-Mail Address')}}</label>
                                        <input id="mailInfoInput" type="email" required name="email"
                                               class="form-control"
                                               placeholder="{{__('E-Mail Address')}}"
                                               value="{{ Auth::guard('web')->user()->email ?? NULL }}"
                                               autocomplete="off"/>
                                        <div id="spanmail"></div>
                                        <div id="mailInfo" class="alert alert-info" style="margin-top: 5px;"><i
                                                class="fa fa-info" style="font-size: 10px"></i> {{ __('mail_text') }}
                                        </div>
                                    </div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('phone')}}</label>
                                        <input type="text" name="phone" class="form-control"
                                               value="{{ Auth::guard('web')->user()->phone ?? NULL }}"
                                               autocomplete="off">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('birthday')}}</label>
                                        <input name="birthday" required id="birthday" type="text"
                                               value="{{ Auth::guard('web')->user()->birthday  ?? NULL}}"
                                               class="form-control" data-mask="00/00/0000" autocomplete="off"
                                               style="    width: 90%;">
                                    </div>

                                    <div class="input-group default-group-style col-md-6">
                                        <label style="width: 100%" for="name">{{__('driving_age')}}</label>
                                        <select name="driving_age" class="form-control" style="    width: 90%;">
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"
                                 style="color: #545454;font-weight: 600;font-size: 18px;">{{__('pick_drop_info')}}</div>
                            <div class="card-header"
                                 style="color: #545454;font-weight: 600;font-size: 14px;border: none;background: transparent;">{{__('pick_info')}}{{--pick_drop_info--}}</div>
                            @if($data["pickupType"] == "airport")
                                <div class="card-body row" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[up][type]" value="up_<?=$data["pickupType"]?>"
                                           autocomplete="off"/>
                                    <div class="col-md-6">
                                        <label for="email">{{__('ucusNo')}}</label>
                                        <input type="text" name="info[up][key]" class="form-control" id="flight_number"
                                               autocomplete="off"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pwd">{{__('descrp')}}</label>
                                        <input type="text" name="info[up][value]" class="form-control" id="airport"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                            @elseif($data["pickupType"] == "hotel")
                                <div class="card-body row" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[up][type]" value="up_<?=$data["pickupType"]?>">
                                    <div class="col-md-6">
                                        <label for="email">{{__('hotelName')}}</label>
                                        <input style="    width: 100%;" type="text" name="info[up][key]"
                                               class="form-control" id="flight_number" autocomplete="off"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pwd">{{__('adresOrRoom')}}</label>
                                        <input style="    width: 100%;" type="text" class="form-control"
                                               name="info[up][value]" id="airport" autocomplete="off"/>
                                    </div>
                                </div>
                            @elseif($data["pickupType"] == "address")
                                <div class="card-body" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[up][type]" value="up_<?=$data["pickupType"]?>">
                                    <div class="form-group">
                                        <label for="email" style="width: 100%">{{__('address')}}</label>
                                        <input type="text" name="info[up][key]" class="form-control" id="flight_number"
                                               autocomplete="off"/>
                                        <input type="hidden" name="info[up][value]" value="0" autocomplete="off"/>
                                    </div>
                                </div>
                            @else
                                <div class="card-body" style="padding: 0 1rem 1rem;">
                                    <span>{{__('ofisTeslim')}}</span>
                                    <input type="hidden" name="info[up][type]" value="ofis" autocomplete="off"/>
                                    <input type="hidden" name="info[up][key]" value="0" autocomplete="off"/>
                                    <input type="hidden" name="info[up][value]" value="0" autocomplete="off"/>
                                </div>
                            @endif

                            <div class="card-header"
                                 style="color: #545454;font-weight: 600;font-size: 14px;border: none;background: transparent;">{{__('drop_info')}}{{--pick_drop_info--}}</div>
                            @if($data["dropType"] == "airport")
                                <div class="card-body row" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[drop][type]" value="drop_<?=$data["dropType"]?>">
                                    <div class="col-md-6">
                                        <label for="email">{{__('ucusNo')}}</label>
                                        <input type="text" name="info[drop][key]" class="form-control"
                                               id="flight_number" autocomplete="off"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pwd">{{__('descrp')}}</label>
                                        <input type="text" name="info[drop][value]" class="form-control" id="airport"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                            @elseif($data["dropType"] == "hotel")
                                <div class="card-body row" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[drop][type]" value="drop_<?=$data["dropType"]?>"
                                           autocomplete="off"/>
                                    <div class="col-md-6">
                                        <label for="email">{{__('hotel_name')}}:</label>
                                        <input style="    width: 100%;" type="text" name="info[drop][key]"
                                               class="form-control" id="flight_number" autocomplete="off"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pwd">{{__('room_number')}}:</label>
                                        <input style="    width: 100%;" type="text" class="form-control"
                                               name="info[drop][value]" id="airport" autocomplete="off"/>
                                    </div>
                                </div>
                            @elseif($data["dropType"] == "address")
                                <div class="card-body" style="padding: 0 1rem 1rem;">
                                    <input type="hidden" name="info[drop][type]" value="drop_<?=$data["dropType"]?>">
                                    <div class="form-group">
                                        <label for="email" style="width: 100%">{{__('address')}}</label>
                                        <input type="text" name="info[drop][key]" class="form-control"
                                               id="flight_number" autocomplete="off"/>
                                        <input type="hidden" name="info[drop][value]" value="0" autocomplete="off"/>
                                    </div>
                                </div>
                            @else
                                <div class="card-body" style="padding: 0 1rem 1rem;">
                                    <span>{{__('ofisFns')}}</span>
                                    <input type="hidden" name="info[drop][type]" value="ofis" autocomplete="off"/>
                                    <input type="hidden" name="info[drop][key]" value="0" autocomplete="off"/>
                                    <input type="hidden" name="info[drop][value]" value="0" autocomplete="off"/>
                                </div>
                            @endif
                            <div class="card-body" style="padding: 0 1rem 1rem;">
                                <label for="pwd">{{__('reservation_note')}}</label>
                                <input class="form-control" name="description"/>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header"
                                 style="color: #545454;font-weight: 600;font-size: 18px;">{{__('payment_type')}}</div>
                            <div class="card-body" style="padding: 6px 20px;">
                                <div class="row">
                                    <div id="debit-box" class="custom-control">
                                        <input class="form-control" name="method" required="required" type="radio"
                                               value="debit-card" id="debit-card">
                                        <label class="custom-control-label d-flex align-items-center" for="debit-card">
                                        <span class="d-md-flex align-items-center w-100">
                                            <div class="col-md-8">
                                                <div class="item-title">{{__('payment1')}}</div>
                                                <div class="item-description">{{__('paymentText1')}}</div>
                                            </div>
                                             <div class="col-md-4" style="text-align: right">
                                                 @if(is_numeric($data['datas']->office_price ))
                                                     <span style="font-weight:600;float: left;">{{$data['datas']->office_price  + $data["ekstraTotal"]}}</span>
                                                 @endif
                                                <i id="popoverOption" data-placement="left" data-toggle="popover"
                                                   data-trigger="hover" data-container="body"
                                                   data-content="{{__('paymentInfo1')}}"
                                                   class="extras-list__info fa fa-info ativo tooltipstered"></i>
                                            </div>
                                       </span>
                                        </label>
                                    </div>
                                    <div id="delivery-debit-card-box" class="custom-control">
                                        <input class="form-control" name="method" required="required" type="radio"
                                               value="delivery-debit-card" id="delivery-debit-card">
                                        <label class="custom-control-label d-flex align-items-center"
                                               for="delivery-debit-card">
                                    <span class="d-md-flex align-items-center w-100">
                                        <div class="col-md-8">
                                            <div class="item-title">{{__('payment2')}}</div>
                                            <div class="item-description">{{__('paymentText2')}}</div>
                                        </div>
                                         <div class="col-md-4" style="text-align: right">
                                             @if(is_numeric($data['datas']->office_price ))
                                                 <span
                                                     style="font-weight:600;float: left;">{{$data['datas']->office_price  + $data["ekstraTotal"]}}</span>
                                             @endif
                                            <i id="popoverOption" data-placement="left" data-toggle="popover"
                                               data-trigger="hover" data-container="body"
                                               data-content="{{__('paymentInfo2')}}"
                                               class="extras-list__info fa fa-info ativo tooltipstered"></i>
                                        </div>
                                   </span>
                                        </label>
                                    </div>
                                    <div id="cash-box" class="custom-control">
                                        <input class="form-control" name="method" required="required" type="radio"
                                               value="debit-cash" id="debit-cash">
                                        <label class="custom-control-label d-flex align-items-center" for="debit-cash">
                                        <span class="d-md-flex align-items-center w-100">
                                            <div class="col-md-8">
                                                <div class="item-title">{{__('cash')}}</div>
                                                <div class="item-description">{{__('paymentText3')}}</div>
                                            </div>
                                             <div class="col-md-4" style="text-align: right">
                                                 @if(is_numeric($data['datas']->office_price ))
                                                     <span
                                                         style="font-weight:600;float: left;">{{$data['datas']->office_price  + $data["ekstraTotal"]}}</span>
                                                 @endif
                                                  <i id="popoverOption" data-placement="left" data-toggle="popover"
                                                     data-trigger="hover" data-container="body"
                                                     data-content="{{__('paymentInfo3')}}"
                                                     class="extras-list__info fa fa-info ativo tooltipstered"></i>

                                            </div>
                                       </span>
                                        </label>
                                    </div>
                                    @if($data['static']['card_payment'] == 'true')
                                        <div id="online-credit-card-box" class="custom-control">
                                            <input class="form-control" name="method" required="" type="radio"
                                                   value="online-credit-card" id="online-credit-card">
                                            <label class="custom-control-label d-flex align-items-center" for="cash">
                                            <span class="d-md-flex align-items-center w-100">
                                                <div class="col-md-8">
                                                    <div class="item-title">{{__('payment3')}} </div>
                                                    <div class="item-description">{{__('paymentText4')}}</div>
                                                </div>
                                                 <div class="col-md-4" style="text-align: right">
                                                       @if(is_numeric($data['datas']->price ))
                                                         <span
                                                             style="font-weight:600;float: left;">{{$data['datas']->price + $data["ekstraTotal"]}}</span>
                                                     @endif
                                                <i id="popoverOption" data-placement="left" data-toggle="popover"
                                                   data-trigger="hover" data-container="body"
                                                   data-content="{{__('paymentInfo4')}}"
                                                   class="extras-list__info fa fa-info ativo tooltipstered"></i>
                                                </div>
                                           </span>
                                            </label>
                                        </div>
                                    @endif
                                    @if($data['static']['card_payment'] == 'true')
                                        <div class="creditCardForm">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card border-0"><input class="form-control ps-5"
                                                                                          type="text" name="cardnumber"
                                                                                          placeholder="Card number">
                                                            <span class="far fa-credit-card"></span></div>
                                                    </div>
                                                    <div class="col-6"><input class="form-control my-3" maxlength="2"
                                                                              type="text" name="exp_date_mounth"
                                                                              placeholder="AY"></div>
                                                    <div class="col-6"><input class="form-control my-3" maxlength="2"
                                                                              type="text" name="exp_date_year"
                                                                              placeholder="YIL"></div>
                                                    <div class="col-6"><input class="form-control my-3" type="text"
                                                                              name="cvv" placeholder="cvv"></div>
                                                    <p class="p-blue h8 fw-bold mb-3">MORE PAYMENT METHODS</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="alert alert-block alert-info">{{__('cardinfo')}}</div>
                                    @endif
                                </div>
                                <div class="row" style="margin-top: 20px;border-top: 1px solid #EEE;padding-top: 15px;">
                                    <div class="col-12 col-sm-8" style="margin-bottom: 25px;">
                                        <input class="custom-control-input" id="rental_conditions" type="checkbox"
                                               required checked>
                                        <b><a href="policedata"
                                              target="_blank"><span> {{__('comfirm_check')}}</span></a></b>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <button
                                            class="btn btn-block btn-blue-2 btn-success reservation-complete-btn btn-loading" id="idOfButton"
                                            type="submit">  {{__('book_now')}}  </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="required" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body mb-0 p-0">
                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                        <iframe class="embed-responsive-item"
                                src="https://worldcarrental.com/tr/arac-kiralama-yazilar/kiralama-kosullari/3"
                                allowfullscreen></iframe>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
                            data-dismiss="modal">{{__('closed')}}</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <style>
        #spanmail {
            color: #f00;
            line-height: 1;
            width: 10%;
            text-align: center;
            font-size: 30px;
        }

        form {
            margin-bottom: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .cardName {
            width: 35%;
            float: left;
            margin: 26px 3px;
            height: 42px;
            border: 1px solid #002a68;
        }

        .form-row {
            width: 62%;
            height: 42px;
            float: left;
            margin: 26px 8px;
            border: 1px solid #32325d;
        }

        @media (max-width: 768px) {
            .cardName {
                width: 100%;
                float: none;
            }

            .form-row {
                width: 97%;
            }
        }

        label {
            font-weight: 500;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        #card-errors {
            height: 20px;
            padding: 4px 0;
            color: #fa755a;
        }

        .token {
            color: #32325d;
            font-family: 'Source Code Pro', monospace;
            font-weight: 500;
        }

        .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        #stripe-token-handler {
            position: absolute;
            top: 0;
            left: 25%;
            right: 25%;
            padding: 20px 30px;
            border-radius: 0 0 4px 4px;
            box-sizing: border-box;
            box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
            0 15px 35px rgba(50, 50, 93, 0.15),
            0 5px 15px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 500ms ease-in-out;
            transition: all 500ms ease-in-out;
            transform: translateY(0);
            opacity: 1;
            background-color: white;
        }

        #stripe-token-handler.is-hidden {
            opacity: 0;
            transform: translateY(-80px);
        }

        #card-element {
            background-color: white;
            width: 453.23px;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .btn-Stripe {
            border: none;
            border-radius: 4px;
            outline: none;
            text-decoration: none;
            color: #fff;
            background: #002a68;
            white-space: nowrap;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            padding: 0 14px;
            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
            border-radius: 0px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-decoration: none;
            -webkit-transition: all 150ms ease;
            transition: all 150ms ease;
            float: left;
            margin-left: 12px;
            margin-top: 28px;
        }

        .btn-Stripe:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, .10), 0 3px 6px rgba(0, 0, 0, .08);
            background-color: #002a68;
        }

        #card-element--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        #card-element--invalid {
            border-color: #fa755a;
        }

        #card-element--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"
            type="text/javascript"></script>
    <script src="{{asset("public/view/js/country.js")}}"></script>
    <script src="{{asset("public/view/country/countrySelect.js")}}"></script>
    <script>
        $('.reservation-complete-btn').click(function () {
            if ($.trim($("#mailInfoInput").val()) == "" || $.trim($("input[name='firstname']").val()) == "" || $.trim($("input[name='birthday']").val()) == ""
            || $.trim($("input[name='lastname']").val()) == "" || $.trim($("input[name='tel']").val()) == "" || $.trim($("input[name='method']").val()) == "") {
                $("#mailInfoInput").next("#spanmail").text("*");
                $("#mailInfoInput").next("#mailInfo").show();
                $("#mailInfoInput").css("border","2px solid #c00");
                $("#firstnameInput").next("#spanmail").text("*");
                $("#firstnameInput").css("border","2px solid #c00");
                $("#birthday").next("#spanmail").text("*");
                $("#birthday").css("border","2px solid #c00");
                $("#lastnameInput").next("#spanmail").text("*");
                $("#lastnameInput").css("border","2px solid #c00");
                $("#telInput").next("#spanmail").text("*");
                $("#telInput").css("border","2px solid #c00");
                $("#debit-box").css("border","2px solid #c00");
                return false;
            }else{
                $(this).prop( "disabled", true );
                var x = document.getElementsByTagName("form");
                x[0].submit();// Form submission
            }
        });



    </script>
    <script>


        $(function () {
            $("#phone").on("keyup", function (e) {
                if ($(this).val().slice(0, 1) == 0) {
                    if (e.key == 0) {
                        alert("Sadece 5555555555 Şeklinde yazabilrisiniz");
                    }
                }
            })

            $("#telInput").on("keyup", function (e) {
                if ($(this).val().slice(0, 1) == 0) {
                    if (e.key == 0) {
                        alert("Sadece 5555555555 Şeklinde yazabilrisiniz");
                    }
                }
            })
        })

        // $(document).scroll(function () {
        //     if ($(window).width() > 770) {
        //         checkOffsetx();
        //     }
        // });
        /*
        function checkOffset() {
            var a=$(document).scrollTop()+window.innerHeight;
            var b=$('.footers').offset().top;
            if (a<b) {
                $('#fixed-div').css('position', 'fixed'); // restore when you scroll up
                $('#fixed-div').css('bottom', 'auto');
            } else {
                $('#fixed-div').css('position','absolute');
                $('#fixed-div').css('bottom', (10+(a-b))+'px');
            }
        }*/
        // if ($(window).width() > 770) {
        //     $(document).ready(checkOffsetx);
        //     $(document).scroll(checkOffsetx);
        // }
        //
        // function checkOffsetx() {
        //     var a=window.innerHeight;
        //     let top = $('.footers').offset().top;
        //     //alert($('.footers').height())
        //     if($('#fixed-div').offset().top + $('#fixed-div').height() >= 1450){
        //         $('#fixed-div').css('position','absolute');
        //         $('#fixed-div').css('bottom', $(document).scrollTop()-top);
        //     }
        //     if($(document).scrollTop() + window.innerHeight < 444) {
        //         $('#fixed-div').css('bottom', 'auto');
        //         $('#fixed-div').css('top', $(document).scrollTop());
        //         //$('#fixed-div').css('position', 'fixed'); // restore when you scroll up
        //     }
        // }
        /*
        var distance = $('#fixed-div').offset().top;
        $(window).scroll(function() {
            if ($(window).scrollTop() >= (distance-155)) {
                if ($(window).scrollTop() <= 990) {
                    $('#fixed-div').addClass("fixed-car");
                } else {
                    $('#fixed-div').removeClass("fixed-car");
                }
            } else {
                $('#fixed-div').removeClass("fixed-car");
            }
               alert(checkOffset());
        });*/

        $('#birthday').mask("99-99-9999", {placeholder: "_ _ -_ _ -_ _ _ _"});
        $(document).ready(function () {
            // Radio button
            $('.radio-group .radio').click(function () {
                $(this).parent().parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });
        })

        $("#country").countrySelect();
        $("#phoneCountry").intlTelInput({
            separateDialCode: true,
            formatOnInit: true,
        });
    </script>
    <style>
        .intl-tel-input {
            position: relative !important;
            display: inline-block !important;
            width: 25% !important;
        }

        .image-thumb {
            text-align: center;
            max-width: 100%;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        //         $(document).ready(function () {
        //             // Create a Stripe client
        //             var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
        //
        // // Create an instance of Elements
        //             var elements = stripe.elements();
        //
        // // Custom styling can be passed to options when creating an Element.
        // // (Note that this demo uses a wider set of styles than the guide below.)
        //             var style = {
        //                 base: {
        //                     color: '#32325d',
        //                     lineHeight: '18px',
        //                     fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        //                     fontSmoothing: 'antialiased',
        //                     fontSize: '16px',
        //                     '::placeholder': {
        //                         color: '#aab7c4'
        //                     }
        //                 },
        //                 invalid: {
        //                     color: '#fa755a',
        //                     iconColor: '#fa755a'
        //                 }
        //             };
        //
        // // Create an instance of the card Element
        //             var card = elements.create('card', {style: style});
        //
        // // Add an instance of the card Element into the `card-element` <div>
        //             card.mount('#card-element');
        //
        // // Handle real-time validation errors from the card Element.
        //             card.addEventListener('change', function (event) {
        //                 var displayError = document.getElementById('card-errors');
        //                 if (event.error) {
        //                     displayError.textContent = event.error.message;
        //                 } else {
        //                     displayError.textContent = '';
        //                 }
        //             });
        //
        // // Handle form submission
        //             var form = document.getElementById('payment-form');
        //
        //             form.addEventListener('submit', function (event) {
        //                 event.preventDefault();
        //
        //                 stripe.createToken(card).then(function (result) {
        //                     if (result.error) {
        //                         // Inform the user if there was an error
        //                         var errorElement = document.getElementById('card-errors');
        //                         errorElement.textContent = result.error.message;
        //                     } else {
        //                         // Send the token to your server
        //                         stripeTokenHandler(result.token);
        //                     }
        //                 });
        //             });
        //         });

    </script>


@endsection

