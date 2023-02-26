@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Markalar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a   class="btn btn-primary" href="{{route('admin.admin.car_model.create',['id'=>$id])}}"><i class="i-Add"></i> Marka Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Marka Adı</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <th scope="row">

                                        {{  $brandname  }}</th>
                                    <td>{{$item->modelname}}</td>
                                    <td>
                                        <a   href="{{route('admin.admin.car_model.edit',['id'=>$item->id])}}" class="btn btn-success ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.car_model.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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



    <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Kategoriler</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.admin.categories.save')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Kategori Parent:</label>
                            <input type="text" class="form-control" id="recipient-name-2" name="id_parent">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Kategori Adı:</label>
                            <input type="text" class="form-control" id="recipient-name-2" name="title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                        <button type="submit" class="btn btn-primary">KAYDET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
