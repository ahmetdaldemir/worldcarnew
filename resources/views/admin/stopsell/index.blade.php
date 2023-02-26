@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">StopSell</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a   class="btn btn-primary" href="{{route('admin.admin.stopsell.create')}}"><i class="i-Add"></i> StopSell Ekle</a>
                         </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Araç</th>
                                <th scope="col">Checkin</th>
                                <th scope="col">Checkout</th>
                                <th scope="col">Ekleyen</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stopsell as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->car->brandfunction->brandname}} {{$item->car->modelfunction->modelname}} {{$item->car->fuel}}  {{$item->car->transmission}} </td>
                                    <td>{{$item->checkin}}</td>
                                    <td>{{$item->checkout}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>
                                        <a   href="{{route('admin.admin.stopsell.edit',['id'=>$item->id])}}" class="btn btn-success ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.stopsell.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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
