@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Araçlar</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" style="float: right;margin: 10px 0px 10px 0;">
                            <a href="{{route('admin.admin.cars.create')}}" class="btn btn-primary" ><i class="i-Add"></i> Yeni Ekle</a>
                            <button type="button" class="btn btn-secondary"><i class="i-Refresh"></i> Yenile</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-gray-300 ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Araç</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $item)

                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>
                                            @php
                                                $brand = \App\Models\Brand::find($item->brand);
                                                 if($brand != null)
                                                     {
                                                         $marka = $brand->brandname;
                                                     }else{
                                                         $marka = "null";
                                                          }

                                                $car_model = \App\Models\CarModel::find($item->model);
                                                  if($car_model != null)
                                                     {
                                                         $model = $car_model->modelname;
                                                     }else{
                                                         $model = "null";
                                                          }
                                                $year = $item->year;
                                                $engine = \App\Models\Engine::find($item->engine)->title;
                                            @endphp
                                        {{$marka}} | {{$model}} | {{$item->car_name}} | {{$year}} | {{$engine}} | {{$item->fuel}}</td>
                                    <td>{{\App\Models\Category::find($item->category)->title}}</td>
                                    <td>
                                        @if($item->is_active == 1)
                                            <a href="{{route('admin.admin.cars.is_active',['id'=>$item->id,'is_active'=>$item->is_active])}}">
                                             <span class="badge badge-success">Aktif</span>
                                            </a>
                                        @else
                                            <a href="{{route('admin.admin.cars.is_active',['id'=>$item->id,'is_active'=>$item->is_active])}}" >
                                            <span class="badge badge-danger">Pasif</span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.admin.cars.image',['id'=>$item->id])}}" class="btn btn-warning ">
                                            <i class="nav-icon i-File-Text--Image "></i>
                                        </a>
                                        <a href="{{route('admin.admin.cars.edit',['id'=>$item->id])}}" class="btn btn-warning ">
                                            <i class="nav-icon i-Pen-2 "></i>
                                        </a>
                                        <a href="{{route('admin.admin.cars.delete',['id'=>$item->id])}}" class="btn btn-danger ">
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
