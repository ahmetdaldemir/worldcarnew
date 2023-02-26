@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bölgeler</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.destinations.create')}}" class="btn btn-primary" ><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bölge Adı</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Resim</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($Destinations))
                                @foreach($Destinations as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->updated_at}}</td>
                                        <td>
                                            @if(!is_null($item->images()))
                                                <img src="{{asset('storage/webp/'.$item->images()->title.'') }}" style="width:50px;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.admin.destinations.edit',['id'=>$item->id_destination])}}" class="btn btn-success ">
                                                <i class="nav-icon i-Pen-2 "></i>
                                            </a>
                                            <a href="{{route('admin.admin.destinations.delete',['id'=>$item->id_destination])}}" class="btn btn-danger ">
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
