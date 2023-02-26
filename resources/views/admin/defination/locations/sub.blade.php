@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bölgeler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.locations.create')}}" class="btn btn-primary"><i class="i-Add"></i> Yeni Ekle</a>
                            <a href="{{route('admin.admin.locations')}}" type="button" class="btn btn-danger"><i class="i-Back1"></i> GERİ</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Alış Lokasyon Adı</th>
                                <th scope="col">Üst Bölge</th>
                                <th scope="col">Tipi</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($locations))
                                @foreach($locations as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->title}}</td>
                                        <td>{{\App\Models\LocationValue::where("id_lang",1)->where("id_location",$item->id_parent)->first()->title}}</td>
                                        <td>
                                            @if($item->type == "center")
                                                Ofis
                                            @elseif($item->type == "hotel")
                                                Hotel
                                            @else
                                                Havalimanı
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Pasif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a  href="{{route('admin.admin.locations.edit',['id'=>$item->id])}}"  type="button" class="btn btn-success ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a href="{{route('admin.admin.locations.delete',['id'=>$item->id])}}"
                                               class="btn btn-danger ">
                                                <i class="nav-icon i-Close-Window "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deliveryArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Teslim Ofisleri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="post" class="needs-validation" ng-submit="setdeliveryArea()" id="addDeliveryArea"
                              enctype="multipart/form-data" autocomplete="off" style="width: 100%">
                            @csrf
                            <input type="hidden" id="id_location" ng-model="id_location" name="id_location"/>
                            <input type="hidden" id="id" ng-model="id" name="id" value="0"/>
                            <div class="modal-body">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="    margin: 20px 0;">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    @foreach($language as $item)
                                                        <li class="nav-item">
                                                            <a style="    padding: 0.3rem;"
                                                               class="nav-link @if($item->id == '1') active show @endif "
                                                               id="{{$item->id}}-tab" data-toggle="tab"
                                                               href="#{{$item->title}}lang" role="tab"
                                                               aria-controls="{{$item->id}}lang">{{$item->title}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    @foreach($language as $item)
                                                        <div
                                                            class="tab-pane fade @if($item->id == '1') active show @endif"
                                                            id="{{$item->title}}lang" role="tabpanel"
                                                            aria-labelledby="{{$item->id}}-tab">
                                                            <input class="form-control" name="title[]"
                                                                   id="location-title"
                                                                   placeholder="{{$item->title}} Bölge Adı"/>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Kaydet</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>Başlık</td>
                                    <td>İşlem</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="item in items">
                                    <td><?='{{item.title}}'?> <?='{{item.id}}'?></td>
                                    <td>
                                        <button onclick="return confirm('Silmek istediğinizden eminmisiniz?');"
                                                ng-click="deleteDeliveryArea(item.id,item.id_location)"
                                                class="btn btn-danger btn-sm"><i class="nav-icon i-Remove "></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div data-backdrop="static" class="modal fade" id="transferZoneFee" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">DÖNÜŞ BÖLGESİ Ücretleri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" class="needs-validation" ng-submit="settransferZoneFee()" id="settransferZoneFee"
                      enctype="multipart/form-data" autocomplete="off" style="width: 100%">
                    <div class="modal-body">
                        <div class="row">
                            @csrf
                            <input type="hidden" id="id_location" ng-model="id_location" name="id_location"/>
                            <input type="hidden" id="id" ng-model="id" name="id" value="0"/>
                            <div class="modal-body">
                                <h2 id="FROM"></h2>
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <td style="width: 21%;">Şehir</td>
                                                    <td style="width: 20%;">Mesafe</td>
                                                    <td style="width: 23%;">Ücret</td>
                                                    <td style="width: 10%;">Durum</td>
                                                    <td style="width: 10%;">İşlem</td>
                                                </tr>
                                                </thead>
                                            </table>
                                            <div class="form-group" style="    margin: 20px 0;">
                                                <div class="col-md-12">
                                                    <div class="accordion" id="accordionRightIcon">
                                                        <div class="card" ng-repeat="item in citys">
                                                            <div class="card-header">
                                                                <div class="row" style="width: 100%">
                                                                    <div class="col-md-3">
                                                                        <h6 class="card-title ul-collapse__icon--size  mb-0">
                                                                            <a data-toggle="collapse" class="text-default collapsed"  href="#accordion-item-icon-right-<?='{{item.code}}'?>" aria-expanded="false"> <?='{{item.name_city}}'?></a>
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" name="distance[]" value="<?='{{item.transfer_zone_fee.distance}}'?>" id="distance[]"/>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" name="price[]" value="<?='{{item.transfer_zone_fee.price}}'?>" id="price[]"/>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="hidden" name="id_city[]" id="id_city[]"  value="<?='{{item.code_city}}'?>"/>
                                                                        <input type="checkbox" style="width: 20px;height: 20px;    margin: 11px auto;" class="form-control" name="status[]" id="status"/>
                                                                    </div>
                                                                    <div class="col-md-1" style="    margin: 13px 0 0 0;">
                                                                        <h6 class="ul-collapse__icon--size ul-collapse__right-icon">
                                                                            <a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-icon-right-<?='{{item.code_city}}'?>"   aria-expanded="false"></a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="accordion-item-icon-right-<?='{{item.code_city}}'?>" class="collapse" data-parent="#accordionRightIcon" style="">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="id" ng-model="id" name="id" value="0" autocomplete="off"  class="ng-pristine ng-untouched ng-valid ng-empty">
                                                                        <div name="add_name" id="add_name" class="form">
                                                                            <div class="row">
                                                                                <div class="col-md-12">

                                                                                     <td>
                                                                                        <button data-code="<?='{{item.code_city}}'?>" type="button" name="add" id="adds" class="btn btn-success">  Yeni Ekle </button>
                                                                                    </td>
                                                                                    <div  id="dynamic_field_<?='{{item.code_city}}'?>" style="margin: 20px 0;">
                                                                                        <div id="row'+i+'">
                                                                                            <div class="form-group">
                                                                                                <div class="row" style="margin:0">
                                                                                                    <div class="col-md-3">
                                                                                                        <select name="transferzonesub['+id+']['+i+'][type]" class="form-control">
                                                                                                            <option value="center">Merkez</option>
                                                                                                            <option value="hotel">Otel</option>
                                                                                                            <option value="airport">Havalimanı</option>
                                                                                                            <option value="busstation">Otogar</option>
                                                                                                            </select>
                                                                                                         </div>
                                                                                                    <div class="col-md-9">
                                                                                                        <ul class="nav nav-tabs" id="myTab_'+id+'_'+i+'" role="tablist_'+id+'_'+i+'">
                                                                                                            @foreach($language as $item)
                                                                                                                <li class="nav-item">' +
                                                                                                                     <a style="padding: 0.3rem;"  class="nav-link " id="{{$item->id}}-tab_'+id+'_'+i+'" data-toggle="tab" href="#{{$item->title}}_'+id+'_'+i+'"  role="tab" aria-controls="{{$item->id}}lang_'+id+'">{{$item->title}}</a>' +
                                                                                                                    </li>
                                                                                                            @endforeach
                                                                                                            <li style="right: 14px;position: absolute;"><button class="btn btn-danger btn_remove" name="remove" id="' + i + '" ><i class="i-Remove"></i></button></li>'+
                                                                                                            </ul>
                                                                                                         <div class="tab-content"  id="myTabContent_'+id+'_'+i+'">
                                                                                                            @foreach($language as $item)
                                                                                                                <div class="tab-pane fade "  id="{{$item->title}}_'+id+'_'+i+'"  role="tabpanel" aria-labelledby="{{$item->id}}-tab_'+id+'_'+i+'">' +
                                                                                                                    <input  class="form-control" name="transferzonesub['+id+']['+i+'][title][{{$item->id}}]" id="location-title" placeholder="{{$item->title}} Bölge Adı">' +
                                                                                                                     </div>
                                                                                                            @endforeach
                                                                                                             </div></div></div></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div data-backdrop="static" class="modal fade" id="addPrice" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="    max-width: 1600px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2"><?='{{title}}'?> Ücretleri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" class="needs-validation" ng-submit="addPeriodPrice()" id="addPeriodPrice"
                      enctype="multipart/form-data" autocomplete="off" style="width: 100%">
                    <div class="modal-body">
                        <div class="row">
                            @csrf
                            <input type="hidden" id="id_location" ng-model="id_location" name="id_location"/>
                            <input type="hidden" id="id" ng-model="id" name="id" value="0"/>
                            <div class="modal-body">
                                <h2 id="FROM"></h2>
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <td style="width: 15%;"></td>
                                                    <td style="width: 75%;">
                                                        <div class="row" style="margin-left: 0px;">
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="1"> 1
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input" value="2"> 2
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input" value="3" > 3
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="4" > 4
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="5" > 5
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="6" >6
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input" value="7" > 7
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input" value="8" > 8
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input" value="9" > 9
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="10" > 10
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input name="mounth[]" type="checkbox" class="form-check-input" value="11" > 11
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-check-label">
                                                                    <input  name="mounth[]" type="checkbox" class="form-check-input"> 12
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 5%;">  1  </td>
                                                    <td style="width: 5%;"></td>
                                                </tr>
                                                </thead>
                                                <thead>
                                                <tr>
                                                    <td style="width: 15%;">Araç</td>
                                                    <td style="width: 75%;">
                                                        <div class="form-inline">
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>1-3</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>4 - 6</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>7 - 10</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>11 - 13</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>14 - 20</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>21 - 29</span>
                                                            </div>
                                                            <div  style="width: 13%;    text-align: center;margin:0 7px 0 7px;float: left">
                                                                <span>30++</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 5%;">İndirim</td>
                                                    <td style="width: 5%;">Durum</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="item in cars">
                                                    <td style="width: 15%;font-size: 11px;">
                                                        @{{item.title}}
                                                        <input type="hidden" name="id_car[]" value="@{{item.id}}" />
                                                    </td>
                                                    <td style="width: 75%;">
                                                        <div class="form-inline">
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                    <input type="text" name="period1[]" style="    width: 98%;" class="form-check-input">
                                                            </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                    <input type="text" name="period2[]"  style="    width: 98%;" class="form-check-input">
                                                             </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                    <input type="text" name="period3[]"  style="    width: 98%;" class="form-check-input">
                                                             </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                <input type="text" name="period4[]"  style="    width: 98%;" class="form-check-input">
                                                            </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                <input type="text" name="period5[]"  style="    width: 98%;" class="form-check-input">
                                                            </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                <input type="text" name="period6[]"  style="    width: 98%;" class="form-check-input">
                                                            </div>
                                                            <div  style="width: 13%;margin:0 7px 0 7px;float: left">
                                                                <input type="text" name="period7[]"  style="    width: 98%;" class="form-check-input">
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td style="width: 5%;">
                                                        <input name="discount[]" type="text" value="0" style="      width: 46px; margin: 0 auto;" class="form-check-input">
                                                    </td>
                                                    <td style="width: 5%;">
                                                        <label class="switch pr-5 switch-success mr-3">
                                                            <input name="status[]" type="checkbox" checked>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </form>
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

        $scope.deliveryArea = function (id) {
            $scope.id_location = id;
            $("#id_location").val(id);
            $("#deliveryArea").modal("show");
            $scope.getdeliveryArea(id);
        }

        $scope.transferZoneFee = function (id, title) {
            $scope.id_location = id;
            $("#settransferZoneFee").find("#id_location").val(id);
            $("#settransferZoneFee").find("#FROM").html(title);
            $("#transferZoneFee").modal("show");
            $scope.getCity(id);
        }

        $scope.getTransferZoneFee = function (id) {
            $http({
                method: 'GET',
                url: './getTransferZoneFee/' + id + '',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.zoneinfo = response.data;
            });
        }

        $scope.getCity = function (id) {
            $http({
                method: 'GET',
                url: './getCity/'+id+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                console.log(response.data);
                $scope.citys = response.data;
            });
        }

        $scope.getdeliveryArea = function (id) {
            $http({
                method: 'GET',
                url: './getdeliveryArea/' + id + '',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.items = response.data;
            });
        }

        $scope.setdeliveryArea = function () {
            const data = $("#addDeliveryArea").serialize();
            $http({
                method: 'POST',
                url: './setdeliveryArea',
                data: $("#addDeliveryArea").serialize(),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.getdeliveryArea(data.id);
            });
        }

        $scope.settransferZoneFee = function () {
            const data = $("#settransferZoneFee").serialize();
            $http({
                method: 'POST',
                url: './settransferZoneFee',
                data: data,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                swal(response);
            });
        }

        $scope.deleteDeliveryArea = function (id, id_location) {
            $http({
                method: 'DELETE',
                url: './deleteDeliveryArea/' + id + '',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                $scope.getdeliveryArea(id_location);
            });
        }

        $scope.addPrice = function (id,title) {
            $scope.title = title;
            $("#addPeriodPrice").find("input#id_location").val(id);
            $("#addPrice").modal("show");
            $scope.getCars(id);
        }

        $scope.getCars = function (id) {
            $http({
                method: 'GET',
                url: './getAllCar/'+id+'',
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
                location.reload();
            });
        }


    });
</script>


<script>
    $(document).ready(function () {
        var i = 0;
        $("#accordionRightIcon").on("click", "#adds", function () {
            var id = $(this).data("code");
            i++;
            // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
              $('#dynamic_field_'+id+'').append('<div id="row'+i+'">' +
                  '<div class="form-group">'+
                   '<div class="row" style="margin:0">'+
                   '<div class="col-md-3">'+
                      '<select name="transferzonesub['+id+']['+i+'][type]" class="form-control">'+
                      '<option value="center">Merkez</option>'+
                      '<option value="hotel">Otel</option>'+
                      '<option value="airport">Havalimanı</option>'+
                      '<option value="busstation">Otogar</option>'+
                      '</select>'+
                      '</div>'+
                      '<div class="col-md-9">'+
                  '<ul class="nav nav-tabs" id="myTab_'+id+'_'+i+'" role="tablist_'+id+'_'+i+'">' +
                  @foreach($language as $item)
                     '<li class="nav-item">' +
                        '<a style="padding: 0.3rem;"  class="nav-link " id="{{$item->id}}-tab_'+id+'_'+i+'" data-toggle="tab" href="#{{$item->title}}_'+id+'_'+i+'"  role="tab" aria-controls="{{$item->id}}lang_'+id+'">{{$item->title}}</a>' +
                     '</li>'+
                  @endforeach
                      '<li style="right: 14px;position: absolute;"><button class="btn btn-danger btn_remove" name="remove" id="' + i + '" ><i class="i-Remove"></i></button></li>'+
            '</ul>' +
                  '<div class="tab-content"  id="myTabContent_'+id+'_'+i+'">' +
                  @foreach($language as $item)
                      '<div class="tab-pane fade "  id="{{$item->title}}_'+id+'_'+i+'"  role="tabpanel" aria-labelledby="{{$item->id}}-tab_'+id+'_'+i+'">' +
                        '<input  class="form-control" name="transferzonesub['+id+']['+i+'][title][{{$item->id}}]" id="location-title" placeholder="{{$item->title}} Bölge Adı">' +
                      '</div>' +
                  @endforeach
              '</div></div></div></div>');
        });
        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
</script>
@endsection
