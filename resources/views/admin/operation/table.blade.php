<div class="card text-left">
    <div class="card-header">
        <div class="progress mb-3" style="font-weight: 800;height: 1.5rem;">
            <div class="progress-bar" role="progressbar" style="width: 50%;background-color: #8eb56b;color:#fff"
                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Çıkış Yapıldı
            </div>
            <div class="progress-bar" role="progressbar" style="width:50%;background-color: #ffbe6e;color:#fff"
                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Dönüş Yapıldı
            </div>
        </div>
    </div>
    <div class="card-body">
        <h4 class="card-title mb-3"> Operasyon Sonuçları </h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">

                <thead style="    height: 50px;">
                <tr>
                    <th class="text-15" scope="col">#</th>
                    <th class="text-15" scope="col">PNR</th>
                    <th class="text-15" scope="col">Müşteri</th>
                    <th class="text-15" scope="col">Araç</th>
                    <th class="text-15" scope="col">Alış/Dönüş Yeri</th>
                    <th class="text-15" scope="col">Plaka</th>
                    <th class="text-15" scope="col">Tarih Aralığı</th>
                    <th class="text-15" scope="col">Gün</th>
                    <th class="text-15" scope="col">Günlük</th>
                    <th class="text-15" scope="col">Ekstra</th>
                    <th class="text-15" scope="col">Toplam</th>
                    <th class="text-15" scope="col">Kalan</th>
                    <th class="text-15" scope="col">NOT</th>
                    <th class="text-15" style="    width: 75px;" scope="col">Çıkış Yapan</th>
                    <th class="text-15" style="    width: 75px;" scope="col">Dönüş Yapan</th>
                    <th class="text-15" scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php use App\Models\Location;$i = 1;  foreach($reservationarray as $item){  ?>
                <tr style="font-size: 14px;{{$item['tdcolor']}}">
                    <td title="{{$item['reservationStatus']}}"
                        style="text-align: center;vertical-align: middle;line-height: 2;color:#fff;background: {{$item['warning_color']}}"
                        scope="col"><?=$i?></td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;" scope="col">
                        <span style="display: flex;">
                            <a style="color:#000;font-weight: 600" target="_blank" href="/admin/admin/reservation/edit?id={{ $item['id'] }}">{{$item['pnr']}}</a></span>
                        <span
                            style="display: flex;color: #03993d; font-weight: 800;">{{date('d-m-Y H:i',strtotime($item['comfirm_date']))}}</span>
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;" scope="col">
                        <span style="display: flex;    white-space: nowrap;
    width: 145px;
    overflow: hidden;
    text-overflow: ellipsis;color:#000;font-weight: 800">{{$item['customer_fullname']}}</span>
                        <span style="display: flex">
                            <a href="javascript:;" data-toggle="popover" title="Telefon" data-content="{{$item['customer_phone']}}"><i style="color: rgb(242 70 54);font-size: 16px;font-weight:500;color:#fff;" class="i-Telephone"></i></a>
                            <a href="/admin/admin/reservation/customerreservation/{{$item['customer_id']}}">({{$item['reservationcount']}})</a>

                        </span>
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;" scope="col">
                        <span style="display: flex;color:#000;font-weight: 600">{{$item['car_info']}}</span>
                        <span style="display: flex;color:#000;font-weight: 600">{{$item['car_info_detail']}}</span>
                        <span style="display: flex;color:#000;font-weight: 800">{{$item['plate']}}</span>
                    </td>
                    <?php
                    if(isset($item['reservationInfo']))  { ?>
                    <td style="vertical-align: middle;" class="text-12">
                        <?php
                        $location = new Location();
                        $reservationinformation = $item['reservationInfo']->up_drop_information;
                        if($reservationinformation)
                        {
                        $details = json_decode($reservationinformation, true);
                        ?>
                        <span
                            style="color:#000;font-weight: 700;display: flex">{{$location->getViewCenterId($item['reservationInfo']->up_location ?? null)[0]->title ?? null}} </span>
                        <span
                            style="font-weight: 700;font-size:10px;color: #000"> ({!! $details['up']['value'] !!} )</span>
                        <hr style="margin: 0;border:1px solid #008fff">
                        <span
                            style="font-weight: 800;display: flex;color: #000">{{$location->getViewCenterId($item['reservationInfo']->drop_location ?? null)[0]->title ?? null}}  </span>
                        <span
                            style="font-weight: 700;color:#000;font-size:10px">({!! $details['drop']['value'] !!} )</span>
                        <?php } ?>
                    </td>
                    <?php }else{ ?>
                    <td>

                    </td> <?php } ?>


                    <td style="text-align: center;vertical-align: middle;line-height: 2;" scope="col">
                        <p class="plate"><span>TR</span>{{$item['plate']}}</p></td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;" scope="col">
                        <span
                            style="display: flex;display: flex;color: #000;font-weight: 800;">{{$item['checkin']}} {{$item['checkintime']}}</span>
                        <span
                            style="display: flex;display: flex;color: #009a3d;font-weight: 800;">{{$item['checkout']}} {{$item['checkouttime']}}</span>
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">{{$item['days']}}</td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">{{$item['day_price']}} {{$item['currency_icon']}}</td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">
                        <a href="javascript:;" data-toggle="popover" title="Ücretler"
                           data-content="<?php foreach($item['ekstras'] as $ekstralist){
                           if($ekstralist->price != 0){ ?>
                               <div>{{\App\Models\EkstraLanguage::getSelectLang($ekstralist->id_ekstra,'title',1)}} = {{$ekstralist->price}} {{$item['currency_icon']}}</div>
                            <?php } ?>
                           <?php } ?>
                               <div>Teslim Ücreti = {{$item->drop_price ?? 0}} {{$item['currency_icon']}}</div>
                        <div>Dönüş Ücreti  = {{$item->up_pice ?? 0}}    {{$item['currency_icon']}}</div>
                        <div>Ekstra Toplam Ücreti  = {{$item['ekstra_price']}} {{$item['currency_icon']}}</div>">Ücretler</a>
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">
                        <span style="display: flex">{{$item['payment_method']}}</span>
                        {{$item['total_amount']}} {{$item['currency_icon']}}</td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">
                        <?php if($item['reservationrest']){
                            foreach($item['reservationrest'] as $reservationRestInfo){  ?>
                                    <?php if($reservationRestInfo->rest == 1){ ?>
                            <a href="javascript:;" data-toggle="popover" title="Ücretler" data-content="
                                 <div> Tarih  = {{$reservationRestInfo->created_at}}</div>
                                                    <div> Not    = {{$reservationRestInfo->note}}</div>
                                                    <div> Fiyat  = {{$reservationRestInfo->price}}</div>
                                                    <hr style='margin-top: 0.5rem !important;margin-bottom: 0.5rem !important;'>
                                                "><i class="fa fa-warning"></i></a>

                                    <?php } ?>
                              <?php } ?>
                        <?php } ?>
                        @if($item['payment_method'] != "KK")
                            @if(auth()->user()->email == 'worldrentalanya@gmail.com' || auth()->user()->email == 'aderin@gmail.com')
                                @if($item['rest'] > 0)
                                    {{$item['rest']}} {{$item['currency_icon']}}
                                    <a href="#" ng-click="restUpdate({{$item['id']}})"><span
                                            class="btn btn-success btn-sm" style="display: flex;">Tahsilat</span></a>
                                @else
                                    @if(!is_null($item['reservationrest']))
                                        @if($item['rest'] == 0)
                                            <a href="javascript:;" data-toggle="popover" title="Ücretler" data-content="
                                                 <?php foreach($item['reservationrest'] as $reservationRestInfo){  ?>
                                                <div> Tarih  = {{$reservationRestInfo->created_at}}</div>
                                                    <div> Not    = {{$reservationRestInfo->note}}</div>
                                                    <div> Fiyat  = {{$reservationRestInfo->price}}</div>
                                                    <hr style='margin-top: 0.5rem !important;margin-bottom: 0.5rem !important;'>
                                                <?php } ?> ">Ödendi</a>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @else
                            0
                        @endif
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600"
                        scope="col">NOT
                    </td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600">{{$item['delivery_personal'] ? $item['delivery_personal']->user->name : "Çıkış Yapılmadı"}}</td>
                    <td style="text-align: center;vertical-align: middle;line-height: 2;color:#000;font-weight: 600">{{$item['drop_personal'] ? $item['drop_personal']->user->name : "Dönüş Yapılmadı"}}</td>

                    <td style="text-align: center;vertical-align: middle;line-height: 2;width: 185px;" scope="col">
                        <div class="btn-group" role="group" style="width:100%">
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Çıkış-Dönüş Bilgiler"
                                   data-original-title="Çıkış-Dönüş Bilgileri" style="line-height: 3;cursor:pointer"
                                   ng-click="reservationModal({{$item['id']}})" class="m-1">
                                    <img style="width:25px" src="{{asset('public/assets/images/cars_info.png')}}"/>
                                </a>
                            </div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Karşılama Yazısı"
                                   data-original-title="Karşılama Yazısı"
                                   style="line-height: 3;cursor:pointer; {{$item['is_letter']}}"
                                   target="_blank"
                                   ng-href="/admin/admin/reservation/welcome_print?id={{$item['id']}}"
                                   class=" m-1">
                                    <img style="width:25px"
                                         src="{{asset('public/assets/images/printer.png')}}"/>
                                </a></div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Sözleşme"
                                   data-original-title="Sözleşme" style="line-height: 3;cursor:pointer"
                                   target="_blank" ng-href="/admin/admin/reservation/welcome_print?id={{$item['id']}}"
                                   class=" m-1">
                                    <img style="width:25px"
                                         src="{{asset('public/assets/images/accept_agreement.png')}}"/>
                                </a></div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Plaka Atama Yap"
                                   data-original-title="Plaka Atama Yap" style="line-height: 3;cursor:pointer"
                                   ng-click="plateModal({{$item['id']}},'{{$item['plate']}}','{{$item['checkin']}}','{{$item['checkout']}}')"
                                   class="m-1">
                                    <img style="width:28px" title="Plaka Atama Yap"
                                         src="{{asset('public/assets/images/license-plate.png')}}"/>
                                </a></div>
                        </div>
                        <div class="btn-group" role="group" style="width:100%">
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Email Yönetimi"
                                   data-original-title="Email Yönetimi"
                                   style="line-height: 3;cursor:pointer"
                                   ng-click="mailModal({{$item['id']}})" class="m-1">
                                    <img style="width:25px"
                                         src="{{asset('public/assets/images/email.png')}}"/>
                                </a></div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Çıkış Yap"
                                   data-original-title="Çıkış Yap" style="line-height: 3;cursor:pointer"
                                   ng-click="operationModal({{$item['id']}},'drop')" class="m-1"
                                   @if(is_null($item['drop_date'])) disabled @endif >
                                    <img style="width:35px" src="{{asset('public/assets/images/up_auto.png')}}"/>
                                </a>
                            </div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Dönüş Yap"
                                   data-original-title="Dönüş Yap" style="line-height: 3;cursor:pointer"
                                   ng-click="operationModal({{$item['id']}},'up')" class="m-1"
                                   @if(is_null($item['up_date'])) disabled @endif >
                                    <img style="width:35px" src="{{asset('public/assets/images/drop_auto.png')}}"/>
                                </a>
                            </div>
                            <div class="buttonoptions">
                                <a data-toggle="tooltip" data-placement="top" title="Sms Gönder"
                                   data-original-title="Sms Gönder" style="line-height: 3;cursor:pointer"
                                   ng-click="smsModal({{$item['id']}})" class="m-1">
                                    <img style="width:35px" title="Sms Gönder"
                                         src="{{asset('public/assets/images/sms.png')}}"/>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++; } ?>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$totalcalculate['days']}}</td>
                    <td></td>
                    <td colspan="2"><b>  </b></td>
                    <td colspan="2"><b>
                            <span style="display: flex;">{{$totalcalculate['price']['eur']}} €</span>
                            <span style="display: flex;">{{$totalcalculate['price']['tl']}}  ₺</span>
                            <span style="display: flex;">{{$totalcalculate['price']['usd']}} $</span>
                            <span style="display: flex;">{{$totalcalculate['price']['gbp']}} £</span>
                        </b></td>
                    <td colspan="2"><b> </b></td>
                    <td colspan="2"><b> </b></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
                </tbody>
            </table>
        </div>


    </div>
</div>

