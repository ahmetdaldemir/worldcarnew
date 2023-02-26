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
                                <th class="text-12" scope="col">Araç - Plaka</th>
                                <th class="text-12" scope="col">Tarih Aralığı</th>
                                <th class="text-12" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-12" scope="col">Gün</th>
                                <th class="text-12" scope="col">Günlük</th>
                                <th class="text-12" scope="col">KiralamaFiyatı</th>
                                <th class="text-12" scope="col">Ekstra</th>
                                <th class="text-12" scope="col">Toplam</th>
                                <th class="text-12" scope="col">Kalan</th>
                                <th class="text-12" scope="col">Ödeme</th>
                                <th class="text-12" scope="col">Not</th>
                                <th class="text-12" scope="col">Personel</th>
                                <th class="text-12" scope="col">Durum</th>
                                <th class="text-12" scope="col">Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1; foreach($reservation as $item) { ?>

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
                                             data-original-title="{{$reservationlog}}"> {{$i}}</div>
                                    @else
                                        <div>  {{$i}}</div>
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
                                        <span style="display: flex;">
                                            <a target="_blank"
                                               href="{{route('admin.admin.reservation.edit',['id'=>$item->id])}}">
                                                <i class="i-Link"></i>{{$item->pnr}}</a>
                                        </span>
                                    <span
                                        style="color:#f00;display: flex;text-align:center">{{\App\Models\Reservation::RESERVATION_SOURCE_STRING[$item->reservation_source]}}</span>
                                </td>
                                <td style="@if(!is_null($item->comfirm_date)) background:beige; @endif vertical-align: middle;{{$item->tdcolor()}}">
                                        <span class="text-12 " style="display: flex"><b>
                                         <a href="/admin/admin/reservation/customerreservation/{{$item->customer->id}}">{{$item->private_str()}} ({{$item->reservationCount()}})</a></b></span>
                                    <?php if(!is_null($item->comfirm_date)){ ?>
                                    <span
                                        style="display: flex;font-weight: 800;color: white;text-indent: 11px;background: #4caf50;"
                                        class="text-12 flex">{{date("d-m-Y H:i",strtotime($item->comfirm_date))}}</span>
                                    <?php } ?>
                                </td>
                                <td style="vertical-align: middle">
                                        <span class="text-12">
                                            <?php
                                            if (is_null($item->plate)) {
                                                echo $data->getCarInfoFullNoYear($item->car);
                                            } else {
                                                echo $data->getCarInfoFullNoYear($item->getPlate->id_car);
                                            }
                                            ?>
                                          </span>
                                    <?php if(($item->plate != 0) && ($item->getPlate->id_car != $item->car)){ ?>
                                    <i data-toggle="tooltip" data-placement="top"
                                       data-original-title="{!! $item->plateDiff() !!}"
                                       style="font-size: 22px;color: #f00;font-weight: 600;" class="i-Danger"></i>
                                    <?php }  ?><br>
                                    {{$data->getPlateReservation($item->plate)}}</span>
                                </td>
                                <td style="vertical-align: middle">
                                        <span class="text-12 text-black-900"
                                              style="display: flex;">{{date("d-m-Y",strtotime($item->reservationInformation->checkin ?? null))}} {{$item->reservationInformation->checkin_time  ?? null }}</span>
                                    <span class="text-12 text-green-900"
                                          style="display: flex">{{date("d-m-Y",strtotime($item->reservationInformation->checkout ?? null))}} {{$item->reservationInformation->checkout_time  ?? null }}</span>
                                </td>

                                <?php
                                if(isset($item->reservationInformation))  { ?>
                                <td style="vertical-align: middle" class="text-12">
                                    <?php
                                    $reservationinformation = $item->reservationInformation->up_drop_information;
                                    if($reservationinformation)
                                    {
                                    $details = json_decode($reservationinformation, true);
                                    ?>
                                    <span
                                        style="color:#000;font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title ?? null}} </span>
                                    <br><span
                                        style="font-weight: 700;font-size:10px"> ( {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['up']['type'] ?? \App\Models\Reservation::TYPE_TRANSLATIONS['up']] !!}   {!! $details['up']['key'] !!} {!! $details['up']['value'] !!} )</span>
                                    <br><span class="text-green-900"
                                              style="font-weight: 700;">{{$location->getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null}}  </span>
                                    <br><span
                                        style="font-weight: 700;font-size:10px">(  {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['drop']['type']] !!} {!! $details['drop']['key'] !!} {!! $details['drop']['value'] !!} )</span>
                                    <?php } ?>
                                </td>
                                <?php }else{ ?>
                                <td>

                                </td> <?php } ?>

                                <td style="vertical-align: middle"><span class="text-12"> {{$item->days}}</span>
                                </td>
                                <td style="vertical-align: middle"><span
                                        class="text-12"> {{$item->day_price}} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle"><span
                                        class="text-12"> {{$item->days*$item->day_price}} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle"><span
                                        class="text-12"> {{$item->ekstra_price}} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle"><span
                                        class="text-12"> {{$item->total_amount}} {{$item->reservationCurrency->right_icon}}</span>
                                </td>
                                <td style="vertical-align: middle;font-size:13px;font-weight:bold;">
                                    @if($item->getPaymentMethod() != "KK")
                                        {{$item->total_amount}} {{$item->reservationCurrency->right_icon}}
                                    @else
                                        0
                                    @endif
                                </td>
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
                                    @if($item->it_made != "web")
                                    {{$item->user->name}}
                                    @else
                                    {{$item->it_made}}
                                    @endif
                                    </br> {{$item->device}}
                                </td>
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
                                </td>

                            </tr>
                            <?php $i++; } ?>
                            </tbody>
                            <tfoot>
                            <tr style="background: #003473; color: #fff;">
                                <th class="text-12" scope="col">#</th>
                                <th class="text-12" scope="col">İnfo</th>
                                <th class="text-12" scope="col">PNR</th>
                                <th class="text-12" scope="col">Adı ve Soyadı</th>
                                <th class="text-12" scope="col">Araç Plaka</th>
                                <th class="text-12" scope="col">Tarih Aralığı</th>
                                <th class="text-12" scope="col">Alış / Dönüş Şehri</th>
                                <th class="text-12" scope="col"><?=$totalcalculate['days'] ?? null?></th>
                                <th class="text-12" scope="col">Günlük</th>
                                <th class="text-12" scope="col"><?=$totalcalculate['ekstra_price'] ?? null?></th>
                                <th class="text-12" scope="col"><?=$totalcalculate['price'] ?? null?></th>
                                <th class="text-12" scope="col"><?=$totalcalculate['rest'] ?? null?></th>
                                <th class="text-12" scope="col"></th>
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
                        <?php //echo $reservation->links('pagination::bootstrap-4'); ?>
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
            border-spacing: 0px 0 !important;
        }

        .table.table-custom {
            border-collapse: separate !important;
        }


        .table-sm th, .table-sm td {
            padding: 0.3rem;
            border-right: 1px solid #ccc;
        }

        .table tr td {
            padding: 5px;
        }

        .table a {
            color: #000000 !important;
        }

        .table.table-custom tr:hover td {
            background: #e1e1e1;
        }

        .table.table-custom tr td {
            border-bottom: 2px solid white;
        }

        .table.table-custom tr {
            background: #fefefe;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        table {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        *, ::after, ::before {
            box-sizing: border-box;
        }

        .table thead th {
            padding: 7px !important;
        }
    </style>

@endsection

