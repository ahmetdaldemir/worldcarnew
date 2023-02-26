@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bayiler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a class="btn btn-primary" href="{{route('admin.admin.supplier.create')}}"><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bayi Yetkili</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <th scope="row">{{$supplier->id}}</th>
                                    <td>{{$supplier->fullname}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->password}}</td>
                                    <td>
                                        @if($supplier->status == 1)
                                            <a href="{{route('admin.admin.supplier.status',['id'=>$supplier->id,'status'=>0])}}"><span class="badge badge-success">Aktif</span></a>
                                        @else
                                            <a href="{{route('admin.admin.supplier.status',['id'=>$supplier->id,'status'=>1])}}"><span class="badge badge-danger">Pasif</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.admin.supplier.token',['id'=> $supplier->id])}}"><span class="badge badge-warning">TOKEN</span></a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.admin.supplier.edit',['id'=>$supplier->id])}}" class="btn btn-danger ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.supplier.delete',['id'=>$supplier->id])}}" class="btn btn-danger ">
                                            <i class="nav-icon i-Close-Window "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
