@extends('layouts.admin')

@section('content')
    <link href="{{asset('public/assets/popover/css/bootstrap-popover-x.css')}}" media="all" rel="stylesheet"
          type="text/css"/>
    <script src="{{asset('public/assets/popover/js/bootstrap-popover-x.js')}}" type="text/javascript"></script>
    <?php
    use App\Models\Location;
    use App\Repository\Data;
    $data = new Data();
    $location = Location::getViewMain();
    ?>
    <div  class="row">
        @if($errors->any())
            <div style="    width: 100%;" class="alert alert-danger" role="alert"><strong
                    class="text-capitalize">UYARI!</strong> {{$errors->first()}}
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="javascript:void(0);" name="filter-form" ng-submit="getReservation()" id="reservationdata"
                  data-table="operations-table">
                <div class="row">
                    <div class="col-sm-1">
                        <label for="type" class="text-12">Tür</label>
                        <select class="form-control" id="type" name="type">
                            <option value="in">Çıkışlar</option>
                            <option value="out">Dönüşler</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="date_time_first" class="text-12">Operasyon Tarihi Aralığı</label>
                        <div class="input-group">
                            <input class="form-control" name="date_time_first" type="text" id="operation_up_datepicker"
                                   value="{{ old('date_time_first') }}" autocomplete="false">
                            <span class="input-group-addon"><i class="fa-arrows-h"></i></span>
                            <input class="form-control date-picker text-center" name="date_time_last"
                                   value="{{ old('date_time_last') }}" id="operation_drop_datepicker" type="text"
                                   autocomplete="false">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="car_status" class="text-12">Plaka Durumu</label>
                        <select class="form-control" id="plate" name="plate">
                            <option value="2" selected="selected">Tümü</option>
                            <option value="0">Atanmamış</option>
                            <option value="1">Atanmış</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label for="reservation_status" class="text-12">Onay Durumu</label>
                        <select class="form-control" id="reservation_status" name="reservation_status">
                            <option value="" selected="selected">Hepsi</option>
                            <option value="waiting">Bekliyor</option>
                            <option value="comfirm">Onaylandı</option>
                            <option value="closed">İptal</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="payment_method" class="text-12">Ödeme Yöntemi</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="" selected="selected">Hepsi</option>
                            <option value="debit-card">Havale & EFT</option>
                            <option value="delivery-debit-card">Araç Tesliminde Nakit & K. Kartı</option>
                            <option value="debit-cash">Araç Tesliminde Nakit Ödeme Yapın</option>
                            <option value="online-credit-card">Online Ödeme</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="city_id" class="text-12">Şehir</label>
                        <select class="form-control" id="city_id" name="city_id">
                            <option value="" selected="selected">Hepsi</option>
                            <?php   foreach ($location as $item){ ?>
                            <option value="<?=$item->id?>"><?=$item->title?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="type_id" class="text-12">Model</label>
                        <select class="form-control" id="car" name="car">
                            <option value="" selected="selected">Hepsi</option>
                            <?php foreach ($car as $item){ ?>
                            <option value="<?=$item->id?>"><?=$data->getCarInfoFullNoYear($item->id)?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12"
                     style="padding: 0;margin-top: 10px;background: #ebebeb;text-align: center;text-align: right;">
                    <button class="btn btn-success" type="submit" style="width:15%;border: 2px solid #013473;">ARA
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-12" style="margin-top:10px ">
            <div class="card">
                <div class="card-header">Rezervasyonlar</div>
                <div class="card-header">
                    <div class="progress mb-3" style="font-weight: 800;height: 1.5rem;">
                        <div class="progress-bar" role="progressbar"
                             style="width: 50%;background-color: #489a3f;color:#fff" aria-valuenow="50"
                             aria-valuemin="0" aria-valuemax="100">Çıkış Yapıldı
                        </div>
                        <div class="progress-bar" role="progressbar"
                             style="width:50%;background-color: #ffbe6e;color:#fff" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">Dönüş Yapıldı
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 " ng-init="getOpetationData()">
                            <thead>
                            <tr>
                                <th class="text-15" scope="col">#</th>
                                <th class="text-15" scope="col">PNR</th>
                                <th class="text-15" scope="col">Müşteri</th>
                                 <th class="text-15" scope="col">Araç</th>
                                <th class="text-15" scope="col">Yer</th>
                                <th class="text-15" scope="col">Plaka</th>
                                <th class="text-15" scope="col">Tarih Aralığı</th>
                                <th class="text-15" scope="col">Gün</th>
                                <th class="text-15" scope="col">Günlük</th>
                                <th class="text-15" scope="col">Ekstra</th>
                                <th class="text-15" scope="col">Toplam</th>
                                <th class="text-15" scope="col">Rest</th>
                                <th class="text-15" scope="col">NOT</th>
                                <th class="text-15" scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr ng-repeat="item in reservationlist" style="font-size: 14px;@{{item.tdcolor}}">
                                <td style="vertical-align: middle">
                                    @{{$index + 1}}
                                    <div class="progress mb-3">
                                        <div data-toggle="tooltip" data-placement="top" title=""
                                             data-original-title="@{{$item.reservationStatus}}"
                                             class="progress-bar bg-@{{$item.reservationStatusClass}}"
                                             role="progressbar" style="width: 100%" aria-valuenow="25"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="font-weight-bold" style="vertical-align: middle">
                                    <a target="_blank" ng-href="/admin/admin/reservation/edit?id=@{{ item.id }}">
                                        <i class="i-Link"></i>@{{item.pnr}}
                                    </a>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="font-weight-600 " style="display: block;text-transform: uppercase">@{{item.customer_fullname.fullname}}</span>
                                </td>
                                <td style="vertical-align:middle">
                                    <span style="display: block;">@{{ item.car_info }}</span>
                                    <span style="display: block;">@{{ item.car_info_detail }}</span>
                                </td>
                                <td style="vertical-align: middle" class="">
                                    <span  uib-popover="@{{item.reservationInfoUp.up.value}}" popover-title="@{{item.reservationInfoUp.up.key}}" style="display: block;font-weight: 800">@{{item.location.up_location[0].title}}</span>
                                    <span  uib-popover="@{{item.reservationInfoUp.drop.value}}" popover-title="@{{item.reservationInfoUp.drop.key}}" style="display: block;">@{{item.location.drop_location[0].title}}</span>
                                </td>
                                <td style="vertical-align:middle"><span>@{{item.car_plate}}</span></td>

                                <td style="vertical-align:middle">
                                      <span class=" font-weight-bold " style="display: flex;">
                                           @{{item.checkin | date:'dd/MM/yyyy'}}
                                           @{{item.checkintime |   date:'mediumTime'}}
                                      </span>
                                    <span class="" style="display: flex">
                                          @{{item.checkout | date:'dd/MM/yyyy'}}
                                          @{{item.checkouttime|  date:'h:mma'}}
                                      </span>
                                </td>
                                <td style="vertical-align: middle"><span class=""> @{{item.days}}</span>
                                </td>
                                <td style="vertical-align: middle"><span
                                        class="text-13"> @{{(item.day_price | number:2)}} @{{ item.currency_icon }}</span>
                                </td>
                                <td style="vertical-align: middle">
                                    <span
                                        class="text-13"> @{{(item.ekstra_price | number:2)}} @{{ item.currency_icon }}</span>
                                </td>
                                <td style="vertical-align: middle">
                                    <span
                                        class="text-13"> @{{(item.total_amount | number:2)}} @{{ item.currency_icon }}</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="text-13 text-red-900">@{{(item.rest | number:2)}} @{{ item.currency_icon }}</span>
                                </td>
                                <td style="vertical-align: middle" class="text-20 text-red-900">
                                    <span ng-if="item.note.type=='payment'">
                                        <a target="_blank"
                                           ng-href="/admin/admin/reservation/welcome_print?id=@{{ item.id }}"
                                           class="btn btn-primary m-1">
                                           <img style="width:24px"
                                                src="{{asset('public/assets/images/cars_info.png')}}"/>
                                        </a>
                                    </span>
                                    <span ng-if="item.note.type == NULL">
                                        <img style="width:24px" src="{{asset('public/assets/images/cancel.png')}}"/>
                                    </span>
                                    <span class="buttonoptions" ng-click="noteModal(item.id)"
                                          ng-if="item.note.type != NULL">
                                        <img style="width:24px" src="{{asset('public/assets/images/note.png')}}"/>
                                    </span>
                                </td>
                                <style>
                                    .buttonoptions {
                                        width: 40px;
                                        border-radius: 5px;
                                        background: #dfdfdf;
                                        text-align: center;
                                        float: left;
                                        margin: 2px;
                                    }
                                </style>
                                <td>
                                    <div class="btn-group" role="group" style="width:100%">
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Çıkış-Dönüş Bilgiler"
                                               data-original-title="Çıkış-Dönüş Bilgileri"
                                               style="line-height: 3;cursor:pointer"
                                               ng-click="reservationModal(item.id)" class="m-1">
                                                <img style="width:25px"
                                                     src="{{asset('public/assets/images/cars_info.png')}}"/>
                                            </a>
                                        </div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Karşılama Yazısı"
                                               data-original-title="Karşılama Yazısı"
                                               style="line-height: 3;cursor:pointer; @{{item.is_letter}}"
                                               target="_blank"
                                               ng-href="/admin/admin/reservation/welcome_print?id=@{{ item.id }}"
                                               class=" m-1">
                                                <img style="width:25px"
                                                     src="{{asset('public/assets/images/printer.png')}}"/>
                                            </a></div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Sözleşme"
                                               data-original-title="Sözleşme" style="line-height: 3;cursor:pointer"
                                               target="_blank"
                                               ng-href="/admin/admin/reservation/welcome_print?id=@{{ item.id }}"
                                               class=" m-1">
                                                <img style="width:25px"
                                                     src="{{asset('public/assets/images/accept_agreement.png')}}"/>
                                            </a></div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Plaka Atama Yap"
                                               data-original-title="Plaka Atama Yap" style="line-height: 3;cursor:pointer"
                                               ng-click="plateModal(item.id,item.plate,item.checkin,item.checkout)" class="m-1">
                                                <img style="width:28px" title="Plaka Atama Yap" src="{{asset('public/assets/images/license-plate.png')}}"/>
                                            </a></div>
                                    </div>
                                    <div class="btn-group" role="group" style="width:100%">
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Email Yönetimi"
                                               data-original-title="Email Yönetimi"
                                               style="line-height: 3;cursor:pointer"
                                               ng-click="mailModal(item.id)" class="m-1">
                                                <img style="width:25px"
                                                     src="{{asset('public/assets/images/email.png')}}"/>
                                            </a></div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Çıkış Yap"
                                               data-original-title="Çıkış Yap" style="line-height: 3;cursor:pointer"
                                               ng-click="operationModal(item.id,'drop')" class="m-1">
                                                <img style="width:35px" src="{{asset('public/assets/images/up_auto.png')}}"/>
                                            </a></div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top" title="Dönüş Yap"
                                               data-original-title="Dönüş Yap" style="line-height: 3;cursor:pointer"
                                               ng-click="operationModal(item.id,'up')" class="m-1">
                                                <img style="width:35px" src="{{asset('public/assets/images/drop_auto.png')}}"/>
                                            </a></div>
                                        <div class="buttonoptions">
                                            <a data-toggle="tooltip" data-placement="top"  title="Sms Gönder"
                                               data-original-title="Sms Gönder" style="line-height: 3;cursor:pointer"
                                               ng-click="operationModal(item.id,'up')" class="m-1">
                                                <img style="width:35px"  title="Sms Gönder"  src="{{asset('public/assets/images/sms.png')}}"/>
                                            </a></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="reservationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style="right: 25px; position: absolute;">&times;
                        </button>
                        <h4 class="modal-title"><b style="color:#000">Çıkış</b>-<b style="color:#f00">Dönüş</b>
                            Bilgileri</h4>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped">
                            <tr class="bg-primary text-white">
                                <td>Çıkış Tarihi</td>
                                <td>Çıkış KM</td>
                                <td>Çıkış Yakıt</td>
                                <td>Resim</td>
                                <td>Kullanıcı</td>
                            </tr>
                            <tr>
                                <td>@{{entry_exit.drop.created}}</td>
                                <td>@{{entry_exit.drop.km}} Km</td>
                                <td>@{{entry_exit.drop.fuel}} </td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="Dönüş Yap"
                                       data-original-title="Dönüş Yap" style="line-height: 3;cursor:pointer"
                                       ng-click="mediaModal(reservationid,'drop')" class="m-1">
                                        <i class="i-Disk"></i>
                                    </a>
                                </td>
                                <td>
                                    @{{entry_exit.drop.user}}
                                </td>
                            </tr>
                        </table>
                        <hr/>
                        <table class="table table-striped background-danger">
                            <tr class="bg-danger text-white">
                                <td>Dönüş Tarihi</td>
                                <td>Dönüş KM</td>
                                <td>Dönüş Yakıt</td>
                                <td>Kullanıcı</td>
                            </tr>
                            <tr>
                                <td>@{{entry_exit.up.created}}</td>
                                <td>@{{entry_exit.up.km}} Km</td>
                                <td>@{{entry_exit.up.fuel}} </td>
                                <td>
                                    @{{entry_exit.up.user}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button style="padding-bottom: 2px;padding-top: 5px;padding-left: 5px;padding-right: 5px;"
                                type="button" class="btn btn-default" data-dismiss="modal">KAPAT
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Rezervasyon İle İglili Mail Gönderme</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="model-header" style="margin: 1rem 0 0 0;">
                        <div class="col-md-12">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-success" ng-click="getPage('comfirm',reservationid,'comfirm',1)"
                                        type="button">Onay Maili
                                </button>
                                <button class="btn btn-danger" ng-click="getPage('cancel',reservationid,'closed',2)"
                                        type="button">Red Maili
                                </button>
                                <button class="btn btn-primary"
                                        ng-click="getPage('reservation_edit',reservationid,'reservation_edit',4)"
                                        type="button">Geliş Dönüş Bilgileri
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 100%;margin-top: 1rem; margin-bottom: 1rem;">
                    <div class="modal-body">
                        <form class="form-group" method="post" enctype="multipart/form-data"
                              action="{{route('admin.admin.reservation.addmail')}}">
                            @csrf
                            <div class="modal-body">
                                <input name="id" value="@{{reservationid}}" type="hidden">
                                <input name="file" value="@{{file}}" type="hidden">
                                <input name="status" value="@{{status}}" type="hidden">
                                <div style="width: 100%;font-size: 12px" rows="20"  ng-bind-html="message  | unsafe"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                                <button class="btn btn-primary ml-2" type="submit">GÖNDER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
             aria-hidden="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: .5rem;">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Yorumlar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body" style="padding: .5rem;">
                        <table class="table table-bordered table-hover table-condensed table-nowrap-th">
                            <thead>
                            <tr>
                                <th>Görevli</th>
                                <th>Tür</th>
                                <th>İçerik</th>
                                <th>Zaman</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="comment in data">
                                <td class="nowrap">@{{ comment.sender }}</td>
                                <td class="nowrap"><span class="text-gray">Not</span></td>
                                <td class="table-container">@{{ comment.messages }}</td>
                                <td class="nowrap">@{{ comment.created_at | date:'d-MM-yyyy HH:mm:ss' }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="height: 10px;"></div>
                        <form class="form-group" id="notes" method="post" enctype="multipart/form-data"
                              ng-submit="addComment(reservationid)">
                            @csrf
                            <input name="id" value="@{{reservationid}}" type="hidden">
                            <div class="input-group">
                                <input style="width: 95%;float: left" type="text" name="messages"  placeholder="Yeni ekle..">
                                <span class="input-group-addon separator"></span>
                                <span style="width: 5%;float: left" class="input-group-btn"><button type="submit" style="border-radius: 0; margin: 1px 0;height: 35px;" class="btn btn-primary btn-add">Ekle</button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Dönüş İşlemleri</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form class="form-group" method="post" enctype="multipart/form-data"
                          action="{{route('admin.admin.reservation.process')}}">
                        @csrf
                        <div class="modal-body">
                            <input name="id" id="reservationidprocess" value="" type="hidden">
                            <input name="type" value="up" type="hidden">
                            <table class="table table-striped">
                                <tr class="bg-primary text-white">
                                    <td>Çıkış Tarihi</td>
                                    <td>Çıkış KM</td>
                                    <td>Çıkış Yakıt</td>
                                </tr>
                                <tr>
                                    <td>@{{entry_exit_s.drop.created}}</td>
                                    <td>@{{entry_exit_s.drop.km}} Km</td>
                                    <td>@{{entry_exit_s.drop.fuel}} Çizgi</td>
                                </tr>
                            </table>
                            <table
                                class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                <tbody>
                                <tr>
                                    <th style="width: 40%;">Personel</th>
                                    <td>
                                        <select class="form-control" name="id_user">
                                            <?php foreach($users as $user){ ?>
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>KM</th>
                                    <td>
                                        <input class="form-control" ng-keyup="upKey()" name="km" type="number"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Yakıt</th>
                                    <td>
                                        <select class="form-control" name="fuel">
                                            <option value="1/8">1/8</option>
                                            <option value="2/8">2/8</option>
                                            <option value="3/8">3/8</option>
                                            <option value="4/8">4/8</option>
                                            <option value="5/8">5/8</option>
                                            <option value="6/8">6/8</option>
                                            <option value="7/8">7/8</option>
                                            <option value="8/8">8/8</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Çıkış Resimler</th>
                                    <td>
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="inputGroupFile02" name="files[]"
                                                   type="file" multiple>
                                            <label class="custom-file-label" for="inputGroupFile02"
                                                   aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <div style="color:#f00;" class="">@{{errormessage}}</div>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary ml-2 lockup" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="dropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Çıkış İşlemleri</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <form class="form-group" method="post" enctype="multipart/form-data"
                          action="{{route('admin.admin.reservation.process')}}">
                        @csrf
                        <div class="modal-body">
                            <input name="id" id="reservationidprocess" value="" type="hidden">
                            <input name="type" value="drop" type="hidden">
                            <table
                                class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                <tbody>
                                <tr>
                                    <th style="width: 40%;">Personel</th>
                                    <td>
                                        <select class="form-control" name="id_user">
                                            <?php foreach($users as $user){ ?>
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>KM</th>
                                    <td>
                                        <input class="form-control" name="km" type="number"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Yakıt</th>
                                    <td>
                                        <select class="form-control" name="fuel">
                                            <option value="1/8">1/8</option>
                                            <option value="2/8">2/8</option>
                                            <option value="3/8">3/8</option>
                                            <option value="4/8">4/8</option>
                                            <option value="5/8">5/8</option>
                                            <option value="6/8">6/8</option>
                                            <option value="7/8">7/8</option>
                                            <option value="8/8">8/8</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dönüş Resimler</th>
                                    <td>
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="inputGroupFile02" name="file[]"
                                                   type="file"
                                                   multiple>
                                            <label class="custom-file-label" for="inputGroupFile02"
                                                   aria-describedby="inputGroupFileAddon02">Resimleri Seç</label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary ml-2" type="button">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="medias-modal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle-2"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%;">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
             aria-hidden="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding: .5rem;">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Yorumlar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body" style="padding: .5rem;">
                        <table class="table table-bordered table-hover table-condensed table-nowrap-th">
                            <thead>
                            <tr>
                                <th>Görevli</th>
                                <th>Tür</th>
                                <th>İçerik</th>
                                <th>Zaman</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="comment in data">
                                <td class="nowrap">@{{ comment.sender }}</td>
                                <td class="nowrap"><span class="text-gray">Not</span></td>
                                <td class="table-container">@{{ comment.messages }}</td>
                                <td class="nowrap">@{{ comment.created_at | date:'d-MM-yyyy HH:mm:ss' }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="height: 10px;"></div>
                        <form class="form-group" id="notes" method="post" enctype="multipart/form-data"
                              ng-submit="addComment(reservationid)">
                            @csrf
                            <input name="id" value="@{{reservationid}}" type="hidden">
                            <div class="input-group">
                                <input style="width: 95%;float: left" type="text" name="messages"
                                       placeholder="Yeni ekle..">
                                <span class="input-group-addon separator"></span>
                                <span style="width: 5%;float: left" class="input-group-btn"><button type="submit"
                                                                                                    style="border-radius: 0; margin: 1px 0;height: 35px;"
                                                                                                    class="btn btn-primary btn-add">Ekle</button></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="plateModal"  role="dialog" aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle-2">Onaylama Ve Plaka Atama</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="model-header">
                        <div class="col-md-12">
{{--                            <?php if(isset($reservation->plate)){ ?>--}}
{{--                            <?php if($reservation->plate == 0){ ?> <span style="font-size:16px;font-weight: bold; color: #f00">*Atanmadı.</span> <?php }else{ ?>--}}
{{--                            <span style="font-size:16px;font-weight: bold; color: #f00">* <?=$reservation->getPlate->plate?> plakalı araç atanmıştır.</span>--}}
{{--                            <?php } ?>--}}
{{--                            <?php } ?>--}}
                        </div>
                    </div>
                    <form class="form-group" method="post" enctype="multipart/form-data" action="{{route('admin.admin.reservation.addplate')}}">
                        @csrf
                        <div class="modal-body">
                            <input name="id" value="@{{reservationid}}" type="hidden">
                            <table
                                class="table table-bordered table-striped table-condensed table-nowrap-th vertical-middle text-13">
                                <tbody>
                                <tr>
                                    <th style="width: 25%;">Plaka Atama</th>
                                    <td>
                                        <select id="mySelect2" class="form-control" name="plate">
                                            <option value="0">PLAKASIZ</option>
                                            <option ng-repeat="plate in plates" ng-selected="plate.id == plate" value="@{{plate.id}}" ng-disabled="plate.status != 40">@{{plate.plate}} | @{{plate.car}} | @{{plate.data.checkout| date:'dd MMM yyyy'}}
                                                | <span>@{{  plate.data.droplocation[0].title}}</span></option>
                                                | <!-- ?=$dropdata['checkout']?>-< ?=$dropdata['checkouttime']?>
                                                | < ?=$dropdata['droplocation']?> | REZ = < ?=$dropdata['reservation_id']? -->
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kapat</button>
                            <button class="btn btn-primary ml-2" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table-sm th, .table-sm td {
            padding: 0.1rem;
            border-right: 2px solid #fff;
        }

        .table th, .table td {
            padding-left: 0.5rem;
            vertical-align: top;
            padding-bottom: 0.3rem;
            border-top: 10px solid #dee2e6;
            padding-top: 0.3rem;
            padding-right: 0.5rem;
            border-right: 2px solid #ccc;
        }

        .table thead {
            height: 50px
        }

        .table thead th {
            vertical-align: middle;
            border-bottom: 2px solid #dee2e6;
        }

        #medias-modal .modal-dialog .modal-content {
            height: 600px;
            padding: 15px;
        }

        #medias-iframe {
            width: 100%;
            height: 100%;
        }

        .system-code {
            color: #333;
            text-decoration: underline;
            cursor: copy;
            font-size: 90%;
            font-weight: 700;
        }

        .one-row {
            display: block;
            white-space: nowrap;
            line-height: 3;
            overflow: hidden;
            -ms-text-overflow: ellipsis;
            text-overflow: ellipsis;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.1rem 0.2rem;
            font-size: 0.813rem;
            line-height: 1.5;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 0px;
            height: 34px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: 2px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        #medias-iframe {
            width: 100%;
            height: 100%;
        }
    </style>

    <style>
        .popover {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1060;
            display: none;
            max-width: 276px;
            padding: 1px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            word-wrap: normal;
            white-space: normal;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 6px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            line-break: auto
        }

        .popover.top {
            margin-top: -10px
        }

        .popover.right {
            margin-left: 10px
        }

        .popover.bottom {
            margin-top: 10px
        }

        .popover.left {
            margin-left: -10px
        }

        .popover-title {
            padding: 8px 14px;
            margin: 0;
            font-size: 14px;
            background-color: #f7f7f7;
            border-bottom: 1px solid #ebebeb;
            border-radius: 5px 5px 0 0
        }

        .popover-content {
            padding: 9px 14px
        }

        .popover > .arrow, .popover > .arrow:after {
            position: absolute;
            display: block;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid
        }

        .popover > .arrow {
            border-width: 11px
        }

        .popover > .arrow:after {
            content: "";
            border-width: 10px
        }

        .popover.top > .arrow {
            bottom: -11px;
            left: 50%;
            margin-left: -11px;
            border-top-color: #999;
            border-top-color: rgba(0, 0, 0, .25);
            border-bottom-width: 0
        }

        .popover.top > .arrow:after {
            bottom: 1px;
            margin-left: -10px;
            content: " ";
            border-top-color: #fff;
            border-bottom-width: 0
        }

        .popover.right > .arrow {
            top: 50%;
            left: -11px;
            margin-top: -11px;
            border-right-color: #999;
            border-right-color: rgba(0, 0, 0, .25);
            border-left-width: 0
        }

        .popover.right > .arrow:after {
            bottom: -10px;
            left: 1px;
            content: " ";
            border-right-color: #fff;
            border-left-width: 0
        }

        .popover.bottom > .arrow {
            top: -11px;
            left: 50%;
            margin-left: -11px;
            border-top-width: 0;
            border-bottom-color: #999;
            border-bottom-color: rgba(0, 0, 0, .25)
        }

        .popover.bottom > .arrow:after {
            top: 1px;
            margin-left: -10px;
            content: " ";
            border-top-width: 0;
            border-bottom-color: #fff
        }

        .popover.left > .arrow {
            top: 50%;
            right: -11px;
            margin-top: -11px;
            border-right-width: 0;
            border-left-color: #999;
            border-left-color: rgba(0, 0, 0, .25)
        }

        .popover.left > .arrow:after {
            right: 1px;
            bottom: -10px;
            content: " ";
            border-right-width: 0;
            border-left-color: #fff
        }
        .fade:not(.show) {
            opacity: 1 !important;
        }
    </style>
    <script src="{{ asset('public/js/angularcustom.js') }}"></script>



@endsection
