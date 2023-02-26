@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yorumlar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.comment.create')}}" class="btn btn-primary" ><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">İsim Soyisim</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($comment))
                                @foreach($comment as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->firstname}} {{$item->lastname}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>
                                            <label class="switch pr-5 switch-secondary mr-3">
                                                <input ng-click="changeStatus({{$item->id}},{{$item->status}})" type="checkbox" {{ $item->status ? 'checked' : ''}}>
                                                <span class="slider"></span>
                                            </label>
                                         </td>
                                        <td>
                                            <a href="{{route('admin.admin.comment.edit',['id'=>$item->id])}}" type="button" class="btn btn-success ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğizden eminmisiniz?')" href="{{route('admin.admin.comment.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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

<script>
    app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {


        $scope.changeStatus = function (id,status) {
            $http({
                method: 'GET',
                url: './comment/change_status?id=' + id + '&status='+status+'',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function successCallback(response) {
                swal({
                    type: 'success',
                    title: 'Güncellendi!',
                    text: '',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
            });
        }
    });
</script>
@endsection
