@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Marka Ekle</div>
                <form method="post" action="{{route('admin.admin.mobil_slider.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="    margin: 20px 0;">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($languages as $item)
                                                <li class="nav-item">
                                                    <a style="    padding: 0.3rem;"
                                                       class="nav-link @if($item->id == '1') active show @endif "
                                                       id="{{$item->id}}-tab" data-toggle="tab"
                                                       href="#{{$item->title}}lang" role="tab"
                                                       aria-controls="{{$item->id}}lang">{{$item->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            @foreach($languages as $item)
                                                <div class="tab-pane fade @if($item->id == '1') active show @endif"
                                                     id="{{$item->title}}lang" role="tabpanel"
                                                     aria-labelledby="{{$item->id}}-tab">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Resim Üzeri Yazısı</label>
                                                        <input class="form-control" name="title[]" id="location-title" placeholder="{{$item->title}} Mobil Slider Adı"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Seo Başlık</label>
                                                        <input class="form-control" name="meta_title[]" id="location-title" placeholder="{{$item->meta_title}} Mobil Title"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Seo Açıklaması</label>
                                                        <input class="form-control" id="meta_description" name="meta_description[]" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group" style="width: 100%;">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Resim</label>
                                                <input class="form-control" type="file" name="file">
                                                <small id="emailHelp" class="form-text text-muted">800 * 600 Büyük olamaz</small>
                                            </div>
                                        </div>
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

