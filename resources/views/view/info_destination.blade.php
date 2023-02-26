@extends('layouts.welcome')
{{--    <link href="{{ asset('public/view/lib/slider/carousel-slider.css') }}" rel="stylesheet"/>--}}

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6 col-md-4 rentline">
            <div style="width: 85%;margin:0 auto">
                <form name="searchFormName" method="get" action="lists" onsubmit="return validateForm()" >
                    @csrf
                    <div class="body-row">
                        <span class="input-desc">Alış Yeri</span>
                        <div class="form-control-wrapper">
                            <input type="hidden" name="pick_up_location" id="pick-up-location" value="0" />
                            <nav  id="up">
                                <label for="btn" id="pick-up-text" class="button"> <i  style="color: #ccc7d1;    margin: 0 6px 0 -14px;" class="fas fa-map-marker-alt"></i>  Alış Şehri Seçiniz
                                    <span class="fas fa-caret-down"></span>
                                </label>
                                <input type="checkbox" id="btn">
                                <ul class="menu" id="menu0">
                                    @foreach($data['center_location'] as $item)
                                        @if($item->id_parent == 0)
                                            <li data-id="{{$item->id}}">
                                                <i style="color: #ccc7d1; margin: 2px 10px 0 0;    float: left; line-height: 1;" class="fas fa-map-marker-alt"></i>
                                                <label for="btn-{{$item->id}}"  class="second"> {{$item->title}}
                                                    <span class="fas fa-caret-down"></span>
                                                </label>
                                                <input type="checkbox" class="parentMenuBytn" id="btn-{{$item->id}}">
                                                <ul class="menu_parent" id="menu_parent0">
                                                    @foreach($data['center_location'] as $val)
                                                        @if($val->id_parent == $item->id)
                                                            <li data-id="{{$val->id}}" ><a href="#">
                                                                    @if($val->type=='hotel')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-hotel icon-large"></i>
                                                                    @elseif($val->type == 'airport')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-plane-departure icon-large"></i>
                                                                    @elseif($val->type == 'center')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-map-marker-alt icon-large"></i>
                                                                    @endif
                                                                    {{$val->title}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>

                                        @endif
                                    @endforeach

                                </ul>
                            </nav>
                            <div class="office-list-wrapper scrollable-content" style="display: none;">
                                <div data-toggle="scrollableContent" data-height="" class="office-list" tabindex="3" style="overflow: hidden; outline: none;"></div>
                                <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr" style="width: 10px; z-index: 3; background: rgb(225, 222, 217); cursor: default; position: absolute; top: 0px; left: -10px; height: 0px; display: none;">
                                    <div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 10px; height: 0px; background-color: rgb(212, 0, 42); border: none; background-clip: padding-box; border-radius: 0px;"></div>
                                </div>
                            </div>
                        </div>
                        <span class="input-desc type2">Alış Tarihi</span>
                        <div id="calendar123">
                            <input type="hidden" id="pick-up" name="pick_up" value="{{$data["checkin"]}} "/>
                            <span class="day"></span>
                            <div class="date-detail">
                                <span class="dayName"></span>
                                <span class="dayMounth"></span>
                            </div>
                        </div>
                        <div class="hour">
                            <input id="pick-up-time" name="pick_up_time"  class="hour"  value="{{date("H:i")}}" type="text" style="    font-size: 34px;font-weight: 600; text-align: center;width: 94%;position: absolute;    border: 0;background: #222222" autocomplete="off" >
                        </div>
                    </div>
                    <div class="body-row">
                        <span class="input-desc">Dönüş Yeri </span>
                        <div class="form-control-wrapper">
                            <input type="hidden" name="pick_down_location" id="pick-down-location" value="0" />

                            <nav  id="downNav">
                                <label for="btn" id="pick-down-text" class="button">  <i style="color: #ccc7d1;    margin: 0 6px 0 -14px;" class="fas fa-map-marker-alt"></i>  Dönüş Şehri Seçiniz
                                    <span class="fas fa-caret-down"></span>
                                </label>
                                <input type="checkbox" id="btn">
                                <ul class="menu" id="menu1">
                                    @foreach($data['center_location'] as $item)
                                        @if($item->id_parent == 0)
                                            <li data-id="{{$item->id}}" >
                                                <i style="color: #ccc7d1; margin: 2px 10px 0 0;    float: left; line-height: 1;" class="fas fa-map-marker-alt"></i>
                                                <label for="btn-{{$item->id}}"  class="second"> {{$item->title}}
                                                    <span class="fas fa-caret-down"></span>
                                                </label>
                                                <input type="checkbox"   id="btn-{{$item->id}}">
                                                <ul class="menu_parent" id="menu_parent1">
                                                    @foreach($data['center_location'] as $val)
                                                        @if($val->id_parent == $item->id)
                                                            <li data-id="{{$val->id}}" ><a href="#">
                                                                    @if($val->type=='hotel')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-hotel icon-large"></i>
                                                                    @elseif($val->type == 'airport')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-plane-departure icon-large"></i>
                                                                    @elseif($val->type == 'center')
                                                                        <i style="    margin: 2px 10px 0 0;" class="fas fa-map-marker-alt icon-large"></i>
                                                                    @endif
                                                                    {{$val->title}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>

                                        @endif
                                    @endforeach

                                </ul>
                            </nav>

                            <div class="office-list-wrapper scrollable-content" style="display: none;">
                                <div data-toggle="scrollableContent" data-height="" class="office-list" tabindex="3"  style="overflow: hidden; outline: none;"></div>
                                <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr"
                                     style="width: 10px; z-index: 3; background: rgb(225, 222, 217); cursor: default; position: absolute; top: 0px; left: -10px; height: 0px; display: none;">
                                    <div class="nicescroll-cursors"
                                         style="position: relative; top: 0px; float: right; width: 10px; height: 0px; background-color: rgb(212, 0, 42); border: none; background-clip: padding-box; border-radius: 0px;"></div>
                                </div>
                            </div>
                        </div>
                        <span class="input-desc type2">Dönüş Tarihi</span>
                        <div id="calendar124">
                            <input type="hidden" name="pick_down" id="pick-down" value="{{$data["checkout"]}} "/>
                            <span class="day"></span>
                            <div class="date-detail">
                                <span class="dayName"></span>
                                <span class="dayMounth"></span>
                            </div>
                        </div>
                        <div class="hour-step2">
                            <input id="pick-down-time" name="pick_down_time" class="hour" value="{{date("H:i")}}" type="text" style="    font-size: 34px;font-weight: 600; text-align: center;width: 94%;position: absolute;    border: 0;background: #222222" autocomplete="off" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rounded">
                        <span>KİRALA</span> <i class="fa fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row" style="margin: 50px 0">
        <div class="container">
            <div class="blog-card-list">
                <div class="blog-card">
                    <div class="row">
                        <div class="col-md-6 col-24">
                            <img class="img-fluid"
                                 src="https://www.avis.com.tr/Avis/media/Avis/blog/istanbul-avrupa/1.jpg?ext=.jpg"
                                 alt="İstanbul Avrupa Yakası’nda bir gün">
                        </div>
                        <div class="col-md-6 col-24">
                            <h3 class="default">İstanbul Avrupa Yakası’nda bir gün</h3>
                            <div class="card-content">
                                <p></p>
                                <p>Kalabalık, heyecan, hareket ve güzellik bakımından eşi benzeri olmayan bir
                                    şehirdesiniz. Bu şehrin de kalbinin attığı yerde, Taksim’desiniz. Avrupa Yakası’nın
                                    görülmesi gereken yerlerini ve Avrupa Yakası’ndaki lezzet duraklarını gözden
                                    geçirerek rotanızı belirleyebilirsiniz. Bize göre Taksim’den başlayacak bir macera
                                    Boğaz turu ya da tarihî yarımada keşfi ile devam etmeli. Elbette İstanbul’da
                                    maceranın sonu olmadığını hatırlatmaya gerek yok. Daha hızlı bir keşif için
                                    İstanbul’u bilenlere Avrupa Yakası’nda görülmesi gereken yerler nerelerdir? İstanbul
                                    Avrupa Yakası’nda nerede ne yenir gibi sorular sorduk, aldığımız yanıtları
                                    paylaşıyoruz.</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="row">
                        <div class="col-md-6 col-24">
                            <img class="img-fluid"
                                 src="https://www.avis.com.tr/Avis/media/Avis/blog/istanbul-avrupa/1.jpg?ext=.jpg"
                                 alt="İstanbul Avrupa Yakası’nda bir gün">
                        </div>
                        <div class="col-md-6 col-24">
                            <h3 class="default">İstanbul Avrupa Yakası’nda bir gün</h3>
                            <div class="card-content">
                                <p></p>
                                <p>Kalabalık, heyecan, hareket ve güzellik bakımından eşi benzeri olmayan bir
                                    şehirdesiniz. Bu şehrin de kalbinin attığı yerde, Taksim’desiniz. Avrupa Yakası’nın
                                    görülmesi gereken yerlerini ve Avrupa Yakası’ndaki lezzet duraklarını gözden
                                    geçirerek rotanızı belirleyebilirsiniz. Bize göre Taksim’den başlayacak bir macera
                                    Boğaz turu ya da tarihî yarımada keşfi ile devam etmeli. Elbette İstanbul’da
                                    maceranın sonu olmadığını hatırlatmaya gerek yok. Daha hızlı bir keşif için
                                    İstanbul’u bilenlere Avrupa Yakası’nda görülmesi gereken yerler nerelerdir? İstanbul
                                    Avrupa Yakası’nda nerede ne yenir gibi sorular sorduk, aldığımız yanıtları
                                    paylaşıyoruz.</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<style>
    .blog-card-list .blog-card+.blog-card {
        margin-top: 40px;
    }
</style>
@endsection
