@extends('layouts.admin')

@section('content')
    @php use  \App\Models\DestinationLanguage; @endphp
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bölge Ekle</div>
                <form method="post" action="{{route('admin.admin.destinations.update')}}" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="{{$id}}">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Merkez Bölgesi</label>
                                        <select class="form-control" name="main_destination">
                                            <option @if($main_destination == "main") selected @endif  value="main">Anasayfada Göster</option>
                                            <?php foreach($destinations as $val){ ?>
                                              <option @if($main_destination->main_destination == $val->id) selected @endif value="<?=$val->id?>"><?=$val->title?></option>
                                         <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasyon Bölgesi</label>
                                        <select class="form-control" name="location_destination" required>
                                            <option value="">Seçim Yapınız</option>
                                            <?php foreach($locations as $val){ ?>
                                            <option @if($main_destination->location_destination == $val->id) selected @endif value="<?=$val->id?>"><?=$val->title?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasyon Koordinat</label>
                                        <input class="form-control" value="<?=$main_destination->coordinate?>" name="coordinate" required />
                                    </div>
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
                                                        <input class="form-control"  name="title[]" id="location-title"  value="{{ DestinationLanguage::getSelectLang($id,"title",$item->id)}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kısa Açıklama</label>
                                                        <textarea class="form-control" name="short_description[]"  id="location-short_description">{{ DestinationLanguage::getSelectLang($id,"short_description",$item->id)}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Detaylı Açıklama</label>
                                                        <textarea  class="form-control" id="description_{{$item->id}}" style="height:500px"  name="description[]">{{ DestinationLanguage::getSelectLang($id,"description",$item->id)}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Meta Başlığı</label>
                                                        <input class="form-control" name="meta_title[]" id="location-meta_title"  value="{{ DestinationLanguage::getSelectLang($id,"meta_title",$item->id)}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Resim Alt Yazısı</label>
                                                        <input class="form-control" id="image_title" name="image_alt[]"  value="{{ DestinationLanguage::getSelectLang($id,"image_alt",$item->id)}}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Resim Title Yazısı</label>
                                                        <input class="form-control" id="image_title" name="image_alt_title[]"  value="{{ DestinationLanguage::getSelectLang($id,"image_alt_title",$item->id)}}"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group" style="width: 100%;  margin-top: 100px;">
                                            <p>
                                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    Resim İşlemleri
                                                </a>

                                            </p>
                                            <div class="collapse show" id="collapseExample">
                                                <div class="card card-body" style="    padding: 20px;">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" style="width: 100%">Resim</label>
                                                        <input type="file" name="file" class="form-control" id="file" style="width: 70%;float: left">
                                                        @if($images)
                                                            <img src="{{asset('storage/webp/'.$images->title.'') }}" style="width:100px;float: right">
                                                        @endif
                                                        <small id="emailHelp" class="form-text text-muted">Max 800 * 600</small>
                                                    </div>

                                                </div>
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
