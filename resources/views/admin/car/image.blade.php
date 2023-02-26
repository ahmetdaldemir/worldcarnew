@extends('layouts.admin')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            @php
                $item = \App\Models\Car::where("id",$id)->first() ?? "Bulunamadı";
                $brand = \App\Models\Brand::find($item->brand)->brandname ?? "Bulunamadı";
                $car_model = \App\Models\CarModel::find($item->model)->modelname ?? "Bulunamadı";
                $year = $item->year;
                $engine = \App\Models\Engine::find($item->engine)->title;

            @endphp
            <div class="breadcrumb">
                <h1>Araç Resimleri</h1>
                <ul>
                    <li><a href="">{{$brand}}</a></li>
                    <li> {{$car_model}}</li>
                    <li> {{$year}}</li>
                    <li> {{$engine}}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card text-left">
                <label style="margin-top:20px;text-align: center">Varsayılan Araç Resmi Ekleme <small>*(Sadece 1 Resim Eklenebilir)</small></label>
                <div class="card-body"  style="padding: 30px">
                    <form action="{{route('admin.admin.cars.defaultupload')}}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="fallback col-md-9">
                            <input name="image" type="file" />
                        </div>
                        <div class="fallback col-md-3">
                            <button class="btn btn-danger">YÜKLE</button>
                        </div>
                    </form>
                </div>
                <div class="row thumb-row">
                    @php $image = \App\Models\Car::find($id); @endphp
                         <div class="col-sm-3 col-xs-6">
                            <div class="thumb-box" style="height: 200px">
                                <img  src="/storage/uploads/{{$image->default_images}}" class="img-responsive" style="widt: 100%"/>
                            </div>
                        </div>
                 </div>
            </div>
        </div>
        <div class="col-md-7 mb-4" style="padding: 10px">
            <div class="card text-left">
                <label  style="margin-top:20px;text-align: center">Araç listeleme sayfası slider resimleri ekleme alanı</label>
                <div class="card-body" style="padding: 30px">
                    <form action="{{route('admin.admin.cars.upload')}}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="fallback col-md-9">
                            <input name="image" type="file" />
                        </div>
                        <div class="fallback col-md-3">
                            <button class="btn btn-danger">YÜKLE</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row thumb-row">
                        @php $image = \App\Models\Image::where("module","cars")->where("default","normal")->where("id_module",$id)->get(); @endphp
                        @foreach($image as $val)
                        <div class="col-sm-3 col-xs-6" style="height:160px">
                            <div class="thumb-box" style="   margin-bottom: 10px; height: auto;border: 1px solid #ccc;box-shadow: 0px 3px 5px 1px #ccc;">
                                <img  src="/storage/uploads/{{$val->title}}" class="img-responsive" style="widt: 100%"/>
                                <div class="caption">
                                    <a class="btn btn-danger" href="{{route('admin.admin.cars.imageDelete',['id'=>$val->id])}}">Sil</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
