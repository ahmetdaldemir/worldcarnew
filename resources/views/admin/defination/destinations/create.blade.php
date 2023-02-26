@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bölge Ekle</div>
                <form method="post" action="{{route('admin.admin.destinations.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Merkez Bölgesi</label>
                                        <select class="form-control" name="main_destination" required>
                                            <option value="main">Anasayfada Göster</option>
                                            <?php foreach($destinations as $val){ ?>
                                              <option value="<?=$val->id_destination?>"><?=$val->title?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasyon Koordinat</label>
                                        <input class="form-control"  name="coordinate" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasyon Bölgesi</label>
                                        <select class="form-control" name="location_destination" required>
                                            <option value="">Seçim Yapınız</option>
                                            <?php foreach($locations as $val){ ?>
                                            <option value="<?=$val->id?>"><?=$val->title?></option>
                                            <?php } ?>
                                        </select>
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
                                                        <input class="form-control" name="title[]" id="location-title"
                                                               placeholder="{{$item->title}} Bölge Adı"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kısa Açıklama</label>
                                                        <textarea class="form-control" name="short_description[]"  id="location-short_description"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Detaylı Açıklama</label>
                                                        <textarea  class="form-control" id="description_{{$item->id}}" style="height:500px"  name="description[]"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Meta Başlığı</label>
                                                        <input class="form-control" name="meta_title[]" id="location-meta_title"  />
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
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body" style="    padding: 20px;">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Resim</label>
                                                        <input class="form-control" type="file" name="image">
                                                        <small id="emailHelp" class="form-text text-muted">800 * 600 Büyük olamaz</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Resim Alt Etiketi</label>
                                                        <input class="form-control" name="image_alt[]" id="location-image_alt"  />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Resim Title</label>
                                                        <input class="form-control" name="image_alt_title[]" id="location-image_alt_title"  />
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
                        <button type="submit" class="btn btn-primary" id="form-button">KAYDET</button>
                    </div>
                    </form>
                </form>
            </div>
        </div>
    <script>
        document.getElementById('form-button').onclick = function () {
            this.disabled = true;
        }
    </script>
        @endsection
