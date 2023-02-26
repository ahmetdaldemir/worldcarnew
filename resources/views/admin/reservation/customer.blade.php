@extends('layouts.admin')

@section('content')
    <?php
    use App\Models\Location;
    use App\Models\Reservation;
    use App\User;
    use App\Repository\Data;
    $data = new Data();
    $location = new Location();
    $user = new User();
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rezervasyonlar</div>
                <div class="card-body">
                    <form id="searchlist" ng-submit="searchlist()" method="post"
                          action="{{route('admin.admin.reservation.searchlist')}}">
                        @csrf
                        <div class="search active"
                             style="    padding: 10px;  border: 1px solid #ccc; margin: 10px 0;   width: 99%;   margin: 10px auto 10px 10px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="select table-count custom1 small">
                                            <label>Adet</label>
                                            <select name="pagination" value="{{old('pagination')}}"
                                                    class="form-control">
                                                <option value="10" selected="selected">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="float:left">
                                        <label>Plaka</label>
                                        <input name="plate" class="form-control custom1 small plate"
                                               value="{{old('plate')}}" placeholder="Plaka" type="text">
                                    </div>
                                    <div class="col-md-4" style="float:left">
                                        <label>Müşteri</label>
                                        <select name="customer" value="{{old('customer')}}" class="form-control">
                                            @foreach($customers as $item)
                                                <option value="{{$item->id}}">{{$item->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Marka</label>
                                        <div class="select custom1 small">
                                            <select name="brand" class="form-control">
                                                <option value="">Hepsi</option>
                                                <?php foreach($brands as $brand){ ?>
                                                <option
                                                    {{ old('brand') == $brand->id ? 'checked' : '' }}  value="<?=$brand->id?>"><?=$brand->brandname?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Model</label>
                                        <div class="select custom1 small">
                                            <select name="model" class="form-control">
                                                <option value="">Hepsi</option>
                                                <?php foreach($models as $model){ ?>
                                                <option
                                                    {{ old('model') == $model->id ? 'checked' : '' }} value="<?=$model->id?>"><?=$model->modelname?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Yakıt</label>
                                        <div class="select custom1 small">
                                            <select value="{{old('fuel')}}" name="fuel" class="form-control">
                                                <option value="">Hepsi</option>
                                                <option
                                                    {{ old('fuel') == 'Elektrik' ? 'checked' : '' }}  value="Elektrik">
                                                    Elektrik
                                                </option>
                                                <option
                                                    {{ old('fuel') == 'Hibrid' ? 'checked' : '' }}    value="Hibrid">
                                                    Hibrid
                                                </option>
                                                <option
                                                    {{ old('fuel') == 'Benzin' ? 'checked' : '' }}    value="Benzin">
                                                    Benzin
                                                </option>
                                                <option {{ old('fuel') == 'Dizel' ? 'checked' : '' }}     value="Dizel">
                                                    Dizel
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Vites</label>
                                        <div class="select custom1 small">
                                            <select value="{{old('transmission')}}" name="transmission"
                                                    class="form-control">
                                                <option value="">Hepsi</option>
                                                <option
                                                    {{ old('transmission') == 'Manuel' ? 'checked' : '' }}      value="Manuel">
                                                    Manuel
                                                </option>
                                                <option
                                                    {{ old('transmission') == 'Otomatik' ? 'checked' : '' }}    value="Otomatik">
                                                    Otomatik
                                                </option>
                                                <option
                                                    {{ old('transmission') == 'F1' ? 'checked' : '' }}          value="F1">
                                                    F1
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6">
                                        <label>Durum</label>
                                        <div class="select custom1 small">
                                            <select value="{{old('status')}}" name="status" class="form-control">
                                                <option value="">Hepsi</option>
                                                <option
                                                    {{ old('status') == 'waiting' ? 'checked' : '' }}  value="waiting">
                                                    Beklemede
                                                </option>
                                                <option
                                                    {{ old('status') == 'comfirm' ? 'checked' : '' }}  value="comfirm">
                                                    Onaylandı
                                                </option>
                                                <option
                                                    {{ old('status') == 'closed' ? 'checked' : '' }}  value="closed">
                                                    İptal Edildi
                                                </option>
                                                <option
                                                    {{ old('status') == 'complate' ? 'checked' : '' }}  value="complate">
                                                    Tamamlandı
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-6" style="display: grid">
                                        <label></label>
                                        <button
                                            style="    bottom: -10px;margin: 0;vertical-align: bottom;position: relative"
                                            type="submit" class="button custom2 form-control" name="button">Filtrele
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @include('admin.reservation.topmenu')

                    </div>
                    <div class="table-responsive" style="margin: 0 auto;">
                        <table class="table table-sm table-custom spacing8  table-gray-300 ">
                            <thead>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-12" scope="col">#</th>
                                <th class="text-12" scope="col">İnfo</th>
                                <th class="text-12" scope="col">PNR</th>
                                <th class="text-12" scope="col">Adı ve Soyadı</th>
                                <th class="text-12" scope="col">Araç</th>
                                <th class="text-12" scope="col">Plaka</th>
                                <th class="text-12" scope="col">Tarih Aralığı</th>
                                <th class="text-12" scope="col">Gün</th>
                                <th class="text-12" scope="col">Günlük</th>
                                <th class="text-12" scope="col">Ekstra</th>
                                <th class="text-12" scope="col">Toplam</th>
                                <th class="text-12" scope="col">Kalan</th>
                                <th class="text-12" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-12" scope="col">Ödeme</th>
                                <th class="text-12" scope="col">Not</th>
                                <th class="text-12" scope="col">Personel</th>
                                <th class="text-12" scope="col">Durum</th>
                                <th class="text-12" scope="col">Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($reservation as $item)
                                <tr>
                                    <td style="vertical-align: middle" class="text-12">

                                        @if($item->email_send == 1)
                                            <?php

                                            $reservationlogresponse = $item->reservationLog->first();
                                            if ($reservationlogresponse) {
                                                $reservationlog = $user->find($reservationlogresponse->id_user)->name ?? "Bulunamadı";
                                            } else {
                                                $reservationlog = "Bulunamadı";
                                            }
                                            ?>
                                            <div style="background: #013473;text-align: center;color: #fff;"
                                                 data-toggle="tooltip" data-placement="top"
                                                 data-original-title="{{$reservationlog}}"> {{$item->id}}</div>
                                        @else
                                            <div>  {{$item->id}}</div>
                                        @endif
                                        <div style="    height: 1.1rem;" class="progress">
                                            <div data-toggle="tooltip" data-placement="top" title=""
                                                 data-original-title="{{$item->getReservationStatus()}}"
                                                 class="progress-bar bg-{{$item->getReservationStatusClass()}}"
                                                 role="progressbar" style="width: 100%" aria-valuenow="25"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" ng-click="getLogList({{$item->id}})"
                                           style="position: relative;top: 10px;"><i class="i-Information"></i></a>
                                    </td>
                                    <td class="text-12  font-weight-bold" style="vertical-align: middle">
                                        <span style="display: flex;"><a target="_blank"
                                                                        href="{{route('admin.admin.reservation.edit',['id'=>$item->id])}}"><i
                                                    class="i-Link"></i>{{$item->pnr}}</a></span>
                                        <span
                                            style="color:#f00;display: flex;text-align:center">{{\App\Models\Reservation::RESERVATION_SOURCE_STRING[$item->reservation_source]}}</span>
                                    </td>
                                    <td style="vertical-align: middle;{{$item->tdcolor()}}"><span class="text-12 " style="display: flex"><b>{{$item->private_str()}} ({{$item->reservationCount()}})</b></span>
                                        <?php if(!is_null($item->comfirm_date)){ ?>
                                        <span style="display: flex;font-weight: 800;color: white;text-indent: 11px;background: #4caf50;" class="text-12 flex">{{date("d-m-Y",strtotime($item->comfirm_date))}}</span>
                                        <?php } ?>
                                    </td>

                                    <td style="vertical-align: middle"><span class="text-12">{{$data->getCarInfoFullNoYear($item->car)}} - {{$item->car}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span class="text-12">
                                            <?php if(($item->plate != 0) && ($item->getPlate->id_car != $item->car)){ ?>
                                            <i data-toggle="tooltip" data-placement="top"
                                               data-original-title="{!! $item->reservationPlateList() !!} {!! $item->plateDiff() !!}"
                                               style="font-size: 22px;color: #f00;font-weight: 600;"
                                               class="i-Danger"></i>
                                            <?php }  ?>
                                            {{$data->getPlateReservation($item->plate)}}</span>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <span class="text-12 text-green-900"
                                              style="display: flex;">{{date("d-m-Y",strtotime($item->reservationInformation->checkin ?? null))}} {{$item->reservationInformation->checkin_time  ?? null }}</span>
                                        <span class="text-12 text-red-900"
                                              style="display: flex">{{date("d-m-Y",strtotime($item->reservationInformation->checkout ?? null))}} {{$item->reservationInformation->checkout_time  ?? null }}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span class="text-12"> {{$item->days}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-12"> {{$item->day_price}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-12"> {{$item->ekstra_price}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-12"> {{$item->total_amount}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle;"><span
                                            class="text-15 text-custom-900">! {{$item->rest}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <?php
                                    if(isset($item->reservationInformation))  { ?>
                                    <td style="vertical-align: middle" class="text-12">
                                        <?php
                                        $reservationinformation = $item->reservationInformation->up_drop_information;
                                        if($reservationinformation){
                                        $details = json_decode($reservationinformation, true);
                                        ?>

                                        <span style="display: flex;color:#4caf50;font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title ?? null}} <span
                                                style="font-size:8px"> ( {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['up']['type']] !!}   {!! $details['up']['key'] !!} {!! $details['up']['value'] !!} )</span></span>
                                        <span style="display: flex;color:#f00;font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null}}  <span
                                                style="font-size:8px">(  {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['drop']['type']] !!} {!! $details['drop']['key'] !!} {!! $details['drop']['value'] !!} )</span></span>
                                            <?php } ?>
                                    </td>
                                    <?php }else{ ?>
                                    <td>

                                    </td> <?php } ?>
                                    <td style="vertical-align: middle"
                                        class="text-12 font-weight-bold text-custom">{{$item->getPaymentMethod()}}</td>
                                    <td style="vertical-align: middle" class="text-20 text-red-900">
                                        <?php if ($item->reservationNotes and $item->reservationNotes->type == 'payment' ){  ?>
                                        <i class="i-Danger"></i>
                                        <?php } ?>
                                    </td>
                                    <td style="vertical-align: middle" class="text-12">
                                        <i data-toggle="tooltip" data-placement="top"
                                           data-original-title="{{$item->it_made}}"
                                           style="font-size: 18px;color: #f00;font-weight: 600;"
                                           class="i-Information"></i>
                                        {{$item->user->name}}</td>
                                    <td>
                                        <select id="status" data-id="{{$item->id}}" name="status">
                                            <option @if($item->status == 'waiting') selected @endif  value="waiting">
                                                Beklemede
                                            </option>
                                            <option @if($item->status == 'closed') selected @endif value="closed">İptal
                                                Edildi
                                            </option>
                                            <option @if($item->status == 'comfirm') selected @endif value="comfirm">
                                                Onaylandı
                                            </option>
                                            <option @if($item->status == 'complated') selected @endif value="complated">
                                                Tamamlandı
                                            </option>
                                        </select>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <a onclick="return confirm('Silmek İstediğinizden eminmisiniz?')"
                                           href="{{route('admin.admin.reservation.delete',['id'=>$item->id])}}"
                                           class="btn">
                                            <img style="width: 24px;" src="{{asset('public/assets/images/bin.png')}}"/>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-12" scope="col">#</th>
                                <th class="text-12" scope="col">İnfo</th>
                                <th class="text-12" scope="col">PNR</th>
                                <th class="text-12" scope="col">Adı ve Soyadı</th>
                                <th class="text-12" scope="col">Araç</th>
                                <th class="text-12" scope="col">Plaka</th>
                                <th class="text-12" scope="col">Tarih Aralığı</th>
                                <th class="text-12" scope="col"><!--?=$totalcalculate['days']? --></th>
                                <th class="text-12" scope="col">Günlük</th>
                                <th class="text-12" scope="col"><!-- ?=$totalcalculate['ekstra_price']? --></th>
                                <th class="text-12" scope="col"><!-- ?=$totalcalculate['price']? --></th>
                                <th class="text-12" scope="col"><!-- ?=$totalcalculate['rest']? --></th>
                                <th class="text-12" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-12" scope="col">Ödeme</th>
                                <th class="text-12" scope="col">Not</th>
                                <th class="text-12" scope="col">Personel</th>
                                <th class="text-12" scope="col">Durum</th>
                                <th class="text-12" scope="col">Sil</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="paginate" style="    padding: 19px;">
<!--                        --><?php //echo $reservation->links(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="reservationLogModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                style="right: 25px; position: absolute;">&times;
                        </button>
                        <h4 class="modal-title"><b style="color:#000">Rezervasyon</b>-<b style="color:#f00">Log</b>
                            Bilgileri</h4>
                    </div>
                    <div class="modal-body">
                        <div ng-repeat="item in reservationLoglist">
                            <span>@{{item}}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style="padding-bottom: 2px;padding-top: 5px;padding-left: 5px;padding-right: 5px;"
                                type="button" class="btn btn-default" data-dismiss="modal">KAPAT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {
            $scope.getLogList = function (id) {
                $http({
                    method: "GET",
                    url: "/admin/admin/reservation/get_log_list/" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationLoglist = response.data;
                    $('#reservationLogModal').modal('show');
                });
            }

            $scope.getLogList = function (id) {
                $http({
                    method: "GET",
                    url: "/admin/admin/reservation/get_log_list/" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.reservationLoglist = response.data;
                    $('#reservationLogModal').modal('show');
                });
            }


            $scope.statusChange = function (id) {
                alert("cs");
            }

        }]);

        $("table").on("change", "#status", function () {
            $.ajax({
                url: "/admin/admin/reservation/statusChange?id=" + $(this).attr("data-id") + "&status=" + $(this).val() + "",
                type: "get",
                success: function (response) {
                    swal("Durum Değiştirildi", "Başarılı", "");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

    </script>
    <style>
        .table.table-custom.spacing8 {
            border-spacing: 0px 5px !important;
        }

        .table.table-custom {
            border-collapse: separate !important;
        }

        .table.table-custom tr {
            border-bottom: 1px solid #ccc;
            background: #e6e6e6;
            border-top: 1px solid #ccc;
        }

        .table-sm th, .table-sm td {
            padding: 0.3rem;
            border-right: 1px solid #ccc;
        }

    </style>
@endsection


