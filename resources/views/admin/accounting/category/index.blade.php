@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Kategori</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a   class="btn btn-primary" href="{{route('admin.admin.accountingcategory.create')}}"><i class="i-Add"></i> Kategori Ekle</a>
                         </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accountingCategory as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        <a   href="{{route('admin.admin.accountingcategory.edit',['id'=>$item->id])}}" class="btn btn-success ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.accountingcategory.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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
