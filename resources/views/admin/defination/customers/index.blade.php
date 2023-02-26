@extends('layouts.admin')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Müşteriler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group" style="    width: 70%;float: left;">
                            <form class="form-inline" method="get" action="/admin/admin/customer">
                                <div class="form-group mb-2">
                                    <label style="    width: 100%;" for="staticEmail2">Email</label>
                                    <input type="email" class="form-control" id="staticEmail2" name="email">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="    width: 100%;" for="staticEmail2">İsim Soyisim</label>
                                    <input type="text" class="form-control" id="staticEmail2" name="fullname">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="    width: 100%;" for="staticEmail2">Telefon</label>
                                    <input type="text" class="form-control" id="staticEmail2" name="phone">
                                </div>
                                <button style="margin: 30px 0 0 0;" type="submit" class="btn btn-primary mb-2">Müşteri
                                    Ara
                                </button>
                            </form>
                        </div>
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.customer.create')}}" class="btn btn-primary"><i
                                    class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(!is_null($customers))
                            <table class="table table-sm table-gray-300 ">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Müşteri İSim Soyisim</th>
                                    <th scope="col">Cinsiyet</th>
                                    <th scope="col">Telefon</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($customers as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->firstname}} {{$item->lastname}}</td>
                                        <td>{{$item->gender == "woman" ? 'Kadın':'Erkek'}}</td>
                                        <td>
                                            ({{$item->phone_country}}) {!! str_replace($item->phone_country, ' ', $item->phone) !!}
                                         </td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Pasif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.admin.customer.edit',['id'=>$item->id])}}"
                                               class="btn btn-warning">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a href="{{route('admin.admin.customer.delete',['id'=>$item->id])}}"
                                               class="btn btn-danger ">
                                                <i class="nav-icon i-Close-Window "></i>
                                            </a>
                                            @if(!$item->blacklist)
                                                <a href="{{route('admin.admin.blacklist.add_customer',['id'=>$item->id])}}"
                                                   class="btn btn-primary ">
                                                    Kara Liste
                                                </a>
                                            @else
                                                <a href="{{route('admin.admin.blacklist.rollback',['id'=>$item->id])}}"
                                                   style="    width: 87px;" class="btn btn-light ">
                                                    TEMİZ
                                                </a>
                                            @endif
                                            <button ng-click="openModal({{$item->id}})" class="btn btn-dark ">
                                                Not Ekle
                                            </button>
                                            <a href="{{route('admin.admin.customer.reservations',['id'=>$item->id])}}"
                                               class="btn btn-warning ">
                                                Rezervasyonlar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center" style="height: 50px;margin: 13px 0;">  @if($customers != null)  {{$customers->links()}} @endif</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div id="customerNoteModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                style="right: 25px; position: absolute;">&times;
                        </button>
                        <h4 class="modal-title"><b style="color:#000">Müşteri</b> <b style="color:#f00">Notu</b></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">İd</th>
                                <th scope="col">Kullanıcı</th>
                                <th scope="col">Oluşturma Tarihi</th>
                                <th scope="col">Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in customernotelist">
                                <td scope="col">#-@{{item.id}}</td>
                                <td scope="col">@{{item.user}}</td>
                                <td scope="col">@{{item.created_at | date:'MM-dd-yyyy h:mma'}}</td>
                                <td scope="col">@{{item.note}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <form ng-submit="addSaveNote()" action="javascript:;" id="customerNoteForm">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id"/>
                            <input style="    width: 90%; float: left;" name="message" id="message"
                                   class="form-control"/>
                            <button class="form-control" style="    float: right; width: 10%;">Kaydet</button>
                        </div>
                    </form>
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
            $scope.openModal = function (id) {
                $("#customerNoteModal").find('#id').val(id);
                $("#customerNoteModal").modal("show");

                $http({
                    method: "GET",
                    url: "/admin/admin/customer/get_note?id=" + id + "",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    console.log(response);
                    $scope.customernotelist = response.data;
                });
            }

            $scope.addSaveNote = function (id) {
                const data = $("#customerNoteForm").serialize();
                $http({
                    method: 'POST',
                    url: "/admin/admin/customer/addsavenote",
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    swal("Müşteri Notu Eklendi", "Eklendi", "success");
                    $("#message").val('');
                    $scope.customernotelist = response.data;
                });
            }

        }]);

    </script>
@endsection
