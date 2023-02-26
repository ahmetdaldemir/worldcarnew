@extends('layouts.welcome')

@section('content')
    <section class="header-home d-none d-xl-block">
        <div class="container" style="display:flex;text-align:center;">
        </div>
        <img src="https://worldcarrental.com/storage/uploads/pages_1245_1623272628.png" width="100%">
    </section>
    <div class="auto-container">
        <div class="row user-menu">
            @include('user.menu')
            <div class="col-12 col-sm-12 user-content">
                <h4>{{__('reservations')}}</h4>
                <table class="table table-hover" style="font-size:13px;font-weight:500">
                    <thead>
                    <tr>
                        <th scope="col">{{__('image')}}</th>
                        <th scope="col">{{__('pnr')}}</th>
                        <th scope="col">{{__('arac')}}</th>
                        <th scope="col">{{__('sehir')}}</th>
                        <th scope="col">{{__('plaka')}}</th>
                        <th scope="col">{{__('rent_date')}}</th>
                        <th scope="col">{{__('day')}}</th>
                        <th scope="col">{{__('total')}}</th>
                        <th scope="col">{{__('status')}}</th>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['reservation'] as $result)
                        <tr>
                            <th scope="row"><img style="width: 100px;" src="{{asset("storage/uploads/".$result->reservationCar->default_images."")}}"></th>
                            <th scope="row">{{$result->pnr}}</th>
                            <th scope="row">
                                <?php
                                if($result->plate == null){ ?>
                                {{$result->reservationCar->brandfunction->brandname}}
                                {{$result->reservationCar->modelfunction->modelname}}<br>
                                {{$result->reservationCar->fuel}}
                                {{$result->reservationCar->transmission}}
                                <?php }else{ ?>
                                <?php
                                       $plate = App\Models\Plate::find($result->plate);
                                    echo $plate->car->brandfunction->brandname." ";
                                    echo $plate->car->modelfunction->modelname."</br>";
                                    echo $plate->car->fuel ." ";
                                    echo $plate->car->transmission." ";
                                ?>
                                <?php } ?>
                            </th>
                            <th scope="row">{{$result->uplocationName()}}  </br> {{$result->droplocationName()}}</th>
                            <th scope="row"> @if(!empty($result->plate)) {{  $result->reservationPlateText()->plate}} @endif  </th>
                            <th scope="row">
                                {{ date('d-m-Y',strtotime($result->checkin))}} {{ date('H:i',strtotime($result->checkin_time))}}
                                <br> {{date('d-m-Y',strtotime($result->checkout))}} {{ date('H:i',strtotime($result->checkout_time))}}</th>
                            <th scope="row">{{$result->days}}</th>
                            <td>{{$result->total_amount. " ".$result->reservationCurrency->right_icon}}</td>
                            <th scope="row">{{\App\Models\Reservation::RESERVATION_STATUS_STRING[$result->status]}}</th>
                            <td>
                                @if($result->status == 'comfirm' || $result->status == 'waiting')
                                <a class="btn btn-success" href="/{{app()->getLocale()}}/profil/reservations/edit?id={{$result->id}}"><i class="fa fa-edit"></i></a>
                               @endif
                                <a class="btn btn-danger" target="_blank" href="{{ url(app()->getLocale().'/profil/download?pdf='.$result->pnr.'') }}" ><i class="fa fa-download"></i></a>
                                @if($result->status == 'waiting')
                                <a class="btn btn-danger" ng-click="cancelReservation({{$result->id}})" href="javascript:;"><i class="fa fa-remove"></i></a>
                                @endif

                                <a class="btn btn-warning" target="_blank" title="Yazdir" href="{{ url(app()->getLocale().'/profil/printview?pdf='.$result->pnr.'') }}" ><i  class="fa fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <?php //var_dump($data['reservation'])?>
            </div>
        </div>
    </div>

    <div class="modal" id="cancelReservationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rezervasyon İptal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header">
                    <span>Sayın @{{reservationCancelName}}</span>
                </div>
                <form id="cancelReservationModalForm" ng-submit="cancelReservationProcess()">
                    <div class="modal-body">
                        <input name="id" id="id" value="@{{reservationId}}" type="hidden">
                        <label class>İptal Nedeniniz</label>
                        <textarea name="message" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('Kaydet')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Kapat')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    var app = angular.module("app", []);
    app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
        $scope.cancelReservationProcess = function () {
            var data = $("#cancelReservationModalForm").serialize();
            $http({
                method: 'POST',
                url: './reservationscancel',
                data: data,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                alert("İptal talebinize istinaden en kısa sürede iptal birimi yetkililerimiz sizinle iletişime geçecektir.");
            });
        }

      //  href="{{url(app()->getLocale().'/profil/reservations/cancel',['id'=>$result->id])}}"
    });
</script>
<style>
    .user-menu {
        margin-top: 20px;
    }

    .user-menu .user-links {
    }

    .user-menu .user-links a {
        display: block;
        line-height: 40px;
        padding: 0 30px;
        transition: all .5s;
        background: #ffe39f;
        margin-bottom: 5px;
    }

    .user-menu .user-links a:hover, .user-menu .user-links a.active {
        background-color: #f9af00;
        color: #FFF;
        text-shadow: #555 0px 0px 3px;
    }

    .user-content {
    }

    .user-menu h4 {
        padding: 7px 0;
        border-bottom: 3px solid #f9af00;
        font-size: 21px;
    }
</style>
