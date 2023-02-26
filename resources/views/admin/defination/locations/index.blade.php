@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bölgeler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.locations.create')}}" class="btn btn-primary"><i
                                    class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
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
                                <th scope="col">Fiyatlandır</th>
                                <th scope="col">Min. Kiralama Süresi</th>
                                <th scope="col">Sıra</th>
                                <th scope="col">Teslim Bölgesi Fİyatlandır</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($locations))
                                @foreach($locations as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->title}}</td>
                                        <td><a href="{{route('admin.admin.locations.sub',['id'=>$item->id])}}">
                                            @if($item->id_parent == 0)
                                                Merkez
                                            @endif
                                            </a>
                                        </td>
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
                                                <a  href="{{route('admin.admin.locations.updateLocationStatus',['id'=>$item->id,'status'=> 0])}}"><span class="badge badge-success">Aktif</span></a>
                                            @else
                                                <a  href="{{route('admin.admin.locations.updateLocationStatus',['id'=>$item->id,'status'=> 1])}}"> <span class="badge badge-danger">Pasif</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-primary " href="{{route('admin.admin.locations.price',['id'=>$item->id,'title' => $item->title])}}" > <!-- ng-click="addPrice({{$item->id}},'{{$item->title}}')" -->
                                                Fiyat Ekle
                                            </a>
                                        </td>
                                        <td><input class="form-control" name="min_day" id="rental_period"  ng-keypress="rentalPeriod({{$item->id}},$event)" value="{{$item->min_day}}" data-id="{{$item->id}}" /></td>
                                        <td><input name="sort" class="form-control" value="{{$item->sort}}"></td>
                                        <td>
                                            <a  href="{{route('admin.admin.locations.return-zone',['id'=>$item->id,'title' => $item->title])}}" type="button" class="btn btn-success "  ng-click="transferZoneFee({{$item->id}},'{{$item->title}}')">
                                                Dönüş Bölgesi Ücretleri
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.admin.locations.edit',['id'=>$item->id])}}" class="btn btn-success ">
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
        $scope.rentalPeriod = function (id,keyEvent) {
            let value = keyEvent.key;
            $http({
                method: 'GET',
                url: 'locations/rentalPeriod?id='+id+'&min_day='+value+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                swal("Süre Güncellendi");
            });
        }


    });
</script>
@endsection
