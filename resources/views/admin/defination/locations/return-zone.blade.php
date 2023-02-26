@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <div style="background: #f3f3f3;    width: 50%;float: left;" class="d-sm-flex mb-2" data-view="print">
                           <span>{{$title}}</span>
                        </div>
                        <a style="float: right" href="{{route('admin.admin.locations')}}" type="button" name="add" id="adds"  class="btn btn-success">
                            Lokasyonalra Git
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12" >
                        <form method="post" class="needs-validation" ng-submit="settransferZoneFee()" id="settransferZoneFee"  enctype="multipart/form-data" autocomplete="off"  style="width: 100%">
                            @csrf
                            <input value="{{$id}}" type="hidden" name="id_location"  />
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td style="width: 21%;">Şehir</td>
                                                <td style="width: 20%;">Mesafe</td>
                                                <td style="width: 23%;">Ücret</td>
                                                <td style="width: 10%;">Durum</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($locations as $val){  $status = \App\Models\TransferZoneFee::where("id_location",$id)->where("id_location_transfer_zone",$val->id)->first()->status ?? 0; ?>
                                            <tr>
                                                <td style="width: 10%;"><input value="{{$val->id}}" type="hidden" name="id_location_transfer_zone[]"  />{{$val->title}}</td>
                                                <td style="width: 10%;"><input class="form-control" type="text" value="{{ \App\Models\TransferZoneFee::where("id_location",$id)->where("id_location_transfer_zone",$val->id)->first()->distance ?? 0 }}" name="distance[]"  /></td>
                                                <td style="width: 10%;"><input class="form-control" type="text" value="{{ \App\Models\TransferZoneFee::where("id_location",$id)->where("id_location_transfer_zone",$val->id)->first()->price ?? 0 }}" name="price[]"  /></td>
                                                <td style="width: 10%;vertical-align: middle;">
                                                     <select name="status[]" style="    width: 100% !important;">
                                                        <option @if($val->status == 0){{ 'selected' }} @endif value="0">Pasif</option>
                                                        <option @if($val->status == 1){{ 'selected' }} @endif value="1">Aktif</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div></div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <button type="submit" class="btn btn-success">KAYDET</button>
                                </div>
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


        $scope.settransferZoneFee = function (id) {
            $http({
                method: 'POST',
                url: './settransferZoneFee',
                data: $("#settransferZoneFee").serialize(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response);
                swal("Dönüş Lokasyon Fiyatı", "Güncellendi", "success");
                // $scope.transfer_zone_show_data = response.data;
            });
        }

        $scope.deleteZone = function (id,idzone) {
            $http({
                method: 'GET',
                url: './deleteZoneSub?id=' + id + '&zone='+idzone+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.show(idzone);
            });
        }


        $scope.getPrice = function (mounth, id) {
            $http({
                method: 'GET',
                url: './getPrice?mounth=' + mounth + '&id_location=' + id + '',
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
                swal("{{$title}} Lokasyon Fiyatı", "Güncellendi", "success");
            });
        }


    });


    $(document).ready(function() {
        $("#sec1").on("click",".remove_field", function(e){
            var id = $(this).attr("data-id");
            e.preventDefault(); $('tr#'+id).remove();
        })
    })

</script>
@endsection
