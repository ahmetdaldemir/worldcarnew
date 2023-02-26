@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Header Resim ve Yazı Düzenleme</div>
                <form method="post" action="{{route('admin.admin.page.update')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="hidden" name="id" value="{{$page->id}}">
                    <div class="card-body">
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
                                                        <input class="form-control" name="title[]" id="location-title"  value="{{ \App\Models\PageLanguage::getSelectLang($id,"title",$item->id)}}"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="function">Function</label>
                                        <select id="function" name="function" class="form-control" required>
                                            <option value="">Seçim Yapınız</option>
                                            <option {{  ($page->function) == 'home' ? 'selected' : ''  }} value="home">Anasayfa</option>
                                            <option {{  ($page->function) == 'contact' ? 'selected' : '' }} value="contact">İletişim</option>
                                            <option {{  ($page->function) == 'campain' ? 'selected' : '' }} value="campain">Kampanya</option>
                                            <option {{  ($page->function) == 'blog' ? 'selected' : '' }} value="blog">Blog</option>
                                            <option {{  ($page->function) == 'bloglist' ? 'selected' : '' }} value="bloglist">Blog Listesi</option>
                                            <option {{  ($page->function) == 'checkout' ? 'selected' : '' }} value="checkout">Checkout</option>
                                            <option {{  ($page->function) == 'comment' ? 'selected' : '' }} value="comment">Yorumlar</option>
                                            <option {{  ($page->function) == 'destinations' ? 'selected' : '' }} value="destinations">Bölgeler</option>
                                            <option {{  ($page->function) == 'all_campain' ? 'selected' : '' }} value="all_campain">Tüm Kampanyalar</option>
                                            <option {{  ($page->function) == 'about_us' ? 'selected' : '' }} value="about_us">Kurumsal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Header Resim</label>
                                        <input class="form-control" type="file" name="image">
                                        <input class="form-control" type="hidden" name="image1" value="{{ \App\Models\PageLanguage::getImage($id)}}">
                                        <img src="{{ \App\Models\PageLanguage::getImage($id)}}"  style="width: 50px;  float: right;">
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
            </div>
        </div>
@endsection

