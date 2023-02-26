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
                <div class="card-header">İptal Edilen Rezervasyonlar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        @include('admin.reservation.topmenu')
                    </div>
                    <div class="table-responsive" style="margin: 0 auto;">
                        <table class="table table-sm table-custom spacing8  table-gray-300 ">
                            <thead>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-13" scope="col">#</th>
                                <th class="text-13" scope="col">İnfo</th>
                                <th class="text-13" scope="col">PNR</th>
                                <th class="text-13" scope="col">Adı ve Soyadı</th>
                                <th class="text-13" scope="col">Araç</th>
                                <th class="text-13" scope="col">Plaka</th>
                                <th class="text-13" scope="col">Tarih Aralığı</th>
                                <th class="text-13" scope="col">Gün</th>
                                <th class="text-13" scope="col">Günlük</th>
                                <th class="text-13" scope="col">Ekstra</th>
                                <th class="text-13" scope="col">Toplam</th>
                                <th class="text-13" scope="col">Kalan</th>
                                <th class="text-13" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-13" scope="col">Ödeme</th>
                                <th class="text-13" scope="col">Not</th>
                                <th class="text-13" scope="col">Personel</th>
                                <th class="text-13" scope="col">Durum</th>
                                <th class="text-13" scope="col">Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($reservation as $item)

                                <tr>
                                    <td style="vertical-align: middle" class="text-13">

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
                                    <td class="text-13  font-weight-bold" style="vertical-align: middle"><a
                                            target="_blank"
                                            href="{{route('admin.admin.reservation.edit',['id'=>$item->id])}}"><i
                                                class="i-Link"></i>{{$item->pnr}}</a></td>
                                    <td style="vertical-align: middle;{{$item->tdcolor()}}"><span
                                            class="text-13 "
                                            style="display: flex"><b>{{$item->private_str()}}</b></span>
                                        <?php if(!is_null($item->comfirm_date)){ ?>
                                        <span
                                            style="display: flex;font-weight: 800;color: white;text-indent: 11px;background: #4caf50;"
                                            class="text-13 flex">{{date("d-m-Y",strtotime($item->comfirm_date))}}</span>
                                        <?php } ?>
                                    </td>

                                    <td style="vertical-align: middle"><span class="text-13">{{$data->getCarInfoFullNoYear($item->car)}} - {{$item->car}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span class="text-13">
                                            <?php if($item->plate != 0 && $item->getPlate->id_car != $item->car){ ?>
                                            <i data-toggle="tooltip" data-placement="top"
                                               data-original-title="Farklı Araç Verildi"
                                               style="font-size: 22px;color: #f00;font-weight: 600;"
                                               class="i-Danger"></i>
                                            <?php }  ?>
                                            {{$data->getPlateReservation($item->plate)}}</span>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <span class="text-13 text-green-900"
                                              style="display: flex;">{{date("d-m-Y",strtotime($item->reservationInformation->checkin ?? null))}} {{$item->reservationInformation->checkin_time  ?? null }}</span>
                                        <span class="text-13 text-red-900"
                                              style="display: flex">{{date("d-m-Y",strtotime($item->reservationInformation->checkout ?? null))}} {{$item->reservationInformation->checkout_time  ?? null }}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span class="text-13"> {{$item->days}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-13"> {{$item->day_price}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-13"> {{$item->ekstra_price}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle"><span
                                            class="text-13"> {{$item->total_amount}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <td style="vertical-align: middle;"><span
                                            class="text-15 text-custom-900">! {{$item->rest}} {{$item->reservationCurrency->right_icon}}</span>
                                    </td>
                                    <?php
                                    if(isset($item->reservationInformation) || $item->reservationInformation != NULL  || $item->reservationInformation != "")  { ?>
                                    <td style="vertical-align: middle" class="text-13">
                                        <?php
                                        $reservationinformation = $item->reservationInformation->up_drop_information;
                                        if(!empty($reservationinformation))
                                            {
                                        $details = json_decode($reservationinformation, true);
                                        ?>
                                        <div style="color:#4caf50;font-weight: 700;">
                                            <p style="margin-bottom: 0px;font-size: 8px;">{{$location->getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title ?? null}}</p>
                                            <p style="margin-bottom: 0px;font-size: 8px;">
                                                ( {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['up']['type']] !!}   {!! $details['up']['key'] !!} {!! $details['up']['value'] !!} )
                                            </p>
                                        </div>
                                        <div style="color:#f00;font-weight: 700;">
                                            <p style="margin-bottom: 0px;font-size: 8px;">{{$location->getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null}}</p>
                                            <p style="margin-bottom: 0px;font-size: 8px;">(  {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['drop']['type']] !!} {!! $details['drop']['key'] !!} {!! $details['drop']['value'] !!} )</p>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <?php }else{ ?>
                                    {{\Illuminate\Support\Facades\Log::info('bos',['id'=> $item->id])}}
                                    <td></td>
                                    <?php } ?>
                                    <td style="vertical-align: middle"
                                        class="text-13 font-weight-bold text-custom">{{$item->getPaymentMethod()}}</td>
                                    <td style="vertical-align: middle" class="text-20 text-red-900">
                                        <?php if ($item->reservationNotes and $item->reservationNotes->type == 'payment' ){  ?>
                                        <i class="i-Danger"></i>
                                        <?php } ?>
                                    </td>
                                    <td style="vertical-align: middle" class="text-13">{{$item->user->name}}</td>
                                    <td>
                                        <select  style="background-color:{{$item->statusColor()}};color:#fff;    margin-top: 35px;" id="status" data-id="{{$item->id}}" name="status">
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
                                            <option @if($item->status == 'not_found') selected @endif value="not_found">
                                                Bulunamadı
                                            </option>
                                        </select>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <a onclick="return confirm('Silmek İstediğinizden eminmisiniz?')"
                                           href="{{route('admin.admin.reservation.delete',['id'=>$item->id])}}"
                                           class="btn">
                                            <img style="width: 24px;" src="{{asset('public/assets/images/bin.png')}}"/>
                                        </a>
                                        <a onclick="return confirm('Onaylamak İstediğinizden eminmisiniz?')"
                                           href="{{route('admin.admin.reservation.checked',['id'=>$item->id])}}"
                                           class="btn">
                                            <img style="width: 24px;" src="{{asset('public/assets/images/checked.png')}}"/>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
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


        }]);

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

