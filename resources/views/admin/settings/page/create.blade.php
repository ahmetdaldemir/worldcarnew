@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Header Resim ve Yazı Ekleme</div>
                <form method="post" action="{{route('admin.admin.page.save')}}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="    margin: 20px 0;">

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($languages as $item)
                                                <li class="nav-item">
                                                    <a style="    padding: 0.3rem;"  class="nav-link @if($item->id == '1') active show @endif "   id="{{$item->id}}-tab" data-toggle="tab"
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
                                                        <input class="form-control" name="title[]" id="location-title"  placeholder="{{$item->title}}Başlık"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Function</label>
                                        <select id="function" name="function" class="form-control" required>
                                            <option value="">Seçim Yapınız</option>
                                            <option value="home">Anasayfa</option>
                                            <option value="contact">İletişim</option>
                                            <option value="campain">Kampanya</option>
                                            <option value="blog">Blog</option>
                                            <option value="bloglist">Blog Listesi</option>
                                            <option value="checkout">Checkout</option>
                                            <option value="comment">Yorumlar</option>
                                            <option value="destinations">Bölgeler</option>
                                            <option value="all_campain">Tüm Kampanalar</option>
                                            <option value="about_us">Kurumsal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Header Resim</label>
                                        <input class="form-control" type="file" name="image">
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

