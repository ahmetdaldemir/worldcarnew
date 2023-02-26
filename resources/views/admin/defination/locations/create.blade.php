@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Alış Bölgesi</div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.admin.locations.save')}}">
                        @csrf
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="    margin: 20px 0;">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach($languages as $item)
                                        <li class="nav-item">
                                            <a style="    padding: 0.3rem;" class="nav-link @if($item->id == '1') active show @endif " id="{{$item->id}}-tab" data-toggle="tab" href="#{{$item->title}}lang" role="tab" aria-controls="{{$item->id}}lang">{{$item->title}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach($languages as $item)
                                        <div class="tab-pane fade @if($item->id == '1') active show @endif" id="{{$item->title}}lang" role="tabpanel" aria-labelledby="{{$item->id}}-tab">

                                            <div class="form-group">
                                                <label>Adı</label>
                                                <input class="form-control" name="title[]"
                                                       id="location-title"
                                                       placeholder="{{$item->title}} Bölge Adı" />
                                            </div>
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input class="form-control" name="meta_title[]"
                                                       id="location-meta_title"
                                                       placeholder="{{$item->meta_title}} Bölge Meta" />
                                            </div>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer-title col-md-12" class="col-form-label" style="width: 100%">Üst Bölgesi:</label>
                                    <select class="form-control" name="id_parent" id="location-id_parent">
                                        <option value="0" selected>Merkez</option>
                                        @foreach($locations as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="location-price col-md-12" class="col-form-label" style="width: 100%">Tipi:</label>
                                    <select class="form-control" name="type" id="location-price">
                                        <option value="center">Merkez</option>
                                        <option value="hotel">Otel</option>
                                        <option value="airport">Havalimanı</option>
                                        <option value="address">Adres</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="location-price col-md-12" class="col-form-label" style="width: 100%">Sıra No:</label>
                                    <input class="form-control" name="sort" id="location-sort" value="1000" />
                                </div>
                                <div class="form-group">
                                    <label for="location-price col-md-12" class="col-form-label" style="width: 100%">Teslim Ücreti:</label>
                                    <input class="form-control" name="price" id="location-price"  value="0" />
                                </div>
                                <div class="form-group">
                                    <label for="location-price col-md-12" class="col-form-label" style="width: 100%">Drop Ücreti:</label>
                                    <input class="form-control" name="drop_price"   id="location-drop_price" value="0" />
                                </div>
                                <div class="form-group">
                                    <label for="location-price col-md-12" class="col-form-label" style="width: 100%">Min Gün Sayısı:</label>
                                    <input class="form-control" name="min_day" id="location-min_day" />
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                    <button type="submit" class="btn btn-primary">KAYDET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
