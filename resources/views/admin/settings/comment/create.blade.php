@extends('layouts.admin')

@section('content')
    @php use  \App\Models\BlogLanguage; @endphp
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yorum Ekle</div>
                <form method="post" action="{{route('admin.admin.comment.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="pwd">İsim:</label>
                                                    <input type="text" class="form-control" placeholder="firstname" name="firstname" id="pwd">
                                                </div>
                                                <div class="col">
                                                    <label for="pwd">Soyisim:</label>
                                                    <input type="text" class="form-control" placeholder="lastname" name="lastname" id="pwd">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" id="comment-title" />
                                    </div>
                                        <div class="form-group">
                                            <label>Tipi</label>
                                            <select name="type" class="form-control">
                                                <option value="google">Google</option>
                                                <option value="normal" selected>Normal</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input class="form-control" name="link" id="comment-title"/>
                                        </div>
                                    <div class="form-group">
                                        <label>Araç</label>
                                        <select class="form-control" name="car">
                                            @foreach($data['car'] as $item)
                                                @php
                                                    $brand = \App\Models\Brand::find($item->brand);
                                                     if($brand != null)
                                                         {
                                                             $marka = $brand->brandname;
                                                         }else{
                                                             $marka = "Belirtilmedi";
                                                              }

                                                    $car_model = \App\Models\CarModel::find($item->model);
                                                      if($car_model != null)
                                                         {
                                                             $model = $car_model->modelname;
                                                         }else{
                                                             $model = "Belirtilmedi";
                                                              }
                                                    $year = $item->year;
                                                    $engine = \App\Models\Engine::find($item->engine)->title;
                                                @endphp
                                                <option value="{{$marka}},{{$model}}">

                                                    {{$marka}} | {{$model}}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ülke</label>
                                        <select class="form-control" name="country"  id="country">
                                            @foreach($data['country'] as $item)
                                                <option value="{{$item->country_name}}">{{$item->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kiraladığı Şehir</label>
                                      <input name="city" class="form-control" type="text" >
                                    </div>
                                    <div class="form-group">
                                        <label>Yıldız</label>
                                        <select class="form-control" name="star">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label>Açıklama</label>
                                            <textarea  class="form-control" id="description" name="description"></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                        <button type="submit" class="btn btn-primary">KAYDET</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
@endsection

