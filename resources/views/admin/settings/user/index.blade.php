@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kullanıcılar</div>
                <div class="card-header">
                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.user.create')}}" class="btn btn-primary"><i class="i-Add"></i>
                                Yeni Ekle</a>
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
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($users))
                                @foreach($users as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->name}}</td>

                                        <td>{{$item->email}}</td>
                                        <td>
                                            @foreach($item->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($item->is_status == 1)
                                                <a href="{{route('admin.admin.user.status',['is_status'=> 0,'id'=>$item->id])}}"><span class="badge badge-success">Aktif</span></a>
                                            @else
                                                <a href="{{route('admin.admin.user.status',['is_status'=> 1,'id'=>$item->id])}}"><span class="badge badge-danger">Pasif</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.admin.user.edit',['id'=>$item->id])}}"
                                               class="btn btn-success ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <?php if($item->is_active == 1){ ?>
                                            <a href="{{route('admin.admin.user.memberlogout',['id'=>$item->id])}}"
                                               class="btn btn-success ">
                                                ÇIKIŞ YAP
                                            </a>
                                            <?php } ?>
                                            <a href="{{route('admin.admin.user.delete',['id'=>$item->id])}}"
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
@endsection
