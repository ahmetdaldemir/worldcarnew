@extends('layouts.admin')

@section('content')
    <style>.table th, .table td {text-align: left;}</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}} => Fiyatlandırma</div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form method="post" class="needs-validation" ng-submit="addPeriodPrice()" id="addPeriodPrice" enctype="multipart/form-data" autocomplete="off" style="width: 100%">
                                 <div class="row" style="width:100%">
                                    @csrf
                                    <input type="hidden" id="id_location" ng-model="id_location" value="{{$id}}" name="id_location"/>
                                    <input type="hidden" id="id" ng-model="id" name="id" value="0"/>
                                         <h2 id="FROM"></h2>
                                        <div class="form" style="width:100%">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <td style="width: 15%;"></td>
                                                            <td colspan="4">
                                                                <div class="row" style="margin-left: 0px;">
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(1,{{$id}})" id="1" type="radio" class="form-check-input" value="1"> Ocak
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(2,{{$id}})" id="2" type="radio" class="form-check-input" value="2"> Şubat
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(3,{{$id}})" id="3" type="radio" class="form-check-input" value="3" > Mart
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(4,{{$id}})" id="4" type="radio" class="form-check-input" value="4" > Nisan
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(5,{{$id}})" id="5" type="radio" class="form-check-input" value="5" > Mayıs
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(6,{{$id}})" id="6" type="radio" class="form-check-input" value="6" > Haziran
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(7,{{$id}})" id="7" type="radio" class="form-check-input" value="7" > Temmuz
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(8,{{$id}})" id="8" type="radio" class="form-check-input" value="8" > Ağustos
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(9,{{$id}})" id="9" type="radio" class="form-check-input" value="9" > Eylül
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(10,{{$id}})" id="10" type="radio" class="form-check-input" value="10" > Ekim
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input name="mounth" ng-click="getPrice(11,{{$id}})" id="11" type="radio" class="form-check-input" value="11" > Kasım
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="form-check-label">
                                                                            <input  name="mounth" ng-click="getPrice(12,{{$id}})" id="12" type="radio" class="form-check-input" value="12"> Aralık
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <thead>
                                                        <tr>
                                                            <td class="col-3">Araç</td>
                                                            <td>
                                                                <div class="form-inline">
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>1-3</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>4 - 6</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>7 - 10</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>11 - 13</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>14 - 20</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>21 - 29</span>
                                                                    </div>
                                                                    <div  style="width: 10%;text-align: center;float: left">
                                                                        <span>30++</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="col-1">İndirim</td>
                                                            <td class="col-1">Min Gün</td>
                                                            <td class="col-1">Durum</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr ng-repeat="item in cars">
                                                            <td style="width: 25%;font-size: 17px;">
                                                                @{{item.title}}
                                                                <input type="hidden" name="id_car[]" value="@{{item.id}}" />
                                                            </td>
                                                            <td>
                                                                <div class="form-inline">
                                                                    <div  style="width: 10%;">
                                                                        <input type="text" name="period1[]" value="@{{item.period1}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period2[]"  value="@{{item.period2}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period3[]"  value="@{{item.period3}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period4[]"  value="@{{item.period4}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period5[]"  value="@{{item.period5}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period6[]" value="@{{item.period6}}"  style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>
                                                                    <div  style="width: 10%;float: left">
                                                                        <input type="text" name="period7[]"  value="@{{item.period7}}" style="width: 90%;font-size: 18px;text-align: center;" class="form-check-input">
                                                                    </div>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input name="discount[]" type="text" value="@{{item.discount}}" style="      width: 46px; margin: 0 auto;" class="form-check-input">
                                                            </td>
                                                            <td>
                                                                <input name="min_day[]" type="text" value="@{{item.min_day}}" style="      width: 46px; margin: 0 auto;" class="form-check-input">
                                                            </td>
                                                            <td>
                                                                <select name="status[]">
                                                                    <option ng-selected="item.status == 1"  value="1">Aktif</option>
                                                                    <option ng-selected="item.status == 0"  value="0">Pasif</option>
                                                                </select>
{{--                                                                <label class="switch pr-5 switch-success mr-3">--}}
{{--                                                                   --}}
{{--                                                                    <input ng-checked="item.status == 'on'" name="status[@{{item.id}}]" value="on" type="checkbox">--}}
{{--                                                                    <span class="slider"></span>--}}
{{--                                                                </label>--}}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                 </div>
                             <div class="row">
                                <button class="btn btn-primary" type="submit">Kaydet</button>
                                <a href="{{ URL::previous() }}" class="btn btn-secondary" data-dismiss="modal">Geri</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        input[type="radio"], input[type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
            width: 20px;
            height: 20px;
            margin: 1px -25px;
        }
    </style>



<script>
app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
    $scope.getPrice = function (mounth,id) {
        $http({
            method: 'GET',
            url: './getPrice?mounth='+mounth+'&id_location='+id+'',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            console.log(response.data);
            $scope.cars = response.data;
        });
    }
    $scope.addPeriodPrice = function () {
        const data = $("#addPeriodPrice").serialize();
        $http({
            method: 'POST',
            url: './addPeriodPrice',
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function successCallback(response) {
            console.log(response);
            swal("{{$title}} Lokasyon Fiyatı", "Güncellendi", "success");
        });
    }
});
</script>

@endsection
