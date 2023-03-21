<?php
use App\Models\Image;use Illuminate\Support\Facades\Session;use Symfony\Component\Console\Input\Input;
?>
@extends('layouts.welcome')
@section('title')@endsection
<link href="{{ asset('public/view/css/home.css')}}" rel="stylesheet"/>
<link href="{{ asset('public/view/lib/slider/carousel.css')}}" rel="stylesheet"/>
@section('content')
    <section class="header-home header-blogdetail">
        <img alt="worldcarRentall" src="{{asset('storage/'.$data['static']['home_image']) }}"/>
        <div class="header-home-title">
            <div class="container">
                <div class="text-center">
                    <h2>{{$data['homeText']}}</h2>
                </div>
            </div>
        </div>
    </section>
    <div class="search-form-box1">
        <div class="auto-container">
            <div class="col-12 search-form-inner">
            <!--<h4 class="title s-animate-1 d-block d-xl-none">{{__('home_banner1')}}<span>{{__('home_banner2')}} </span></h4>-->
                <form name="searchFormName" method="get" id="searchForm" class="form-area"
                      onsubmit="return validateForm()" action="{{ route('lists', app()->getLocale()) }}">
                    <div class="row" style="width:100%;margin: 0;">
                        <div class="col-12 col-md-5">
                            <div class="loc" id="pick_up_location_div">
                                <div class="flex d-none d-lg-flex">
                                    <span class="greenLabel greenLabelText tex1"> {{__("Alış / Dönüş Yeri")}} </span>
                                    <span class="greenLabel greenLabelText tex2"
                                          style="display:none"> {{__("pick_up_location")}} </span>
                                    <span style="margin: 0 156px 0 0;display: none;"
                                          class="greenLabel greenLabelTextNEW">{{__("drop_off_location")}} </span>
                                </div>
                                <div class="input-grupla">
                                    <div class="kc-search kc-single">
                                        <div class="flex-title">
                                            <div class="desc">{{__("pick_up_location")}}</div>
                                        </div>
                                        <div class="kc-search-block kc-dropdown kc-search-point kc-search-start-point">
                                            <input type="hidden" name="pick_up_location" id="pick-up-location" required="required"/>
                                            <div class="kc-value" data-placeholder="{{__("pick_up_select")}}">{{__("pick_up_select")}} </div>
                                            <div class="kc-dropdown-items kc-fade-to-scale kc-dropdown-items-city"
                                                 id="item-city-list">
                                                <div class="kc-mobile-header">
                                                    <div class="kc-title">{{__("pick_up_select")}}</div>
                                                    <div class="kc-close"><i class="fa fa-times"></i></div>
                                                </div>
                                                <ul class="kc-options">
                                                    @foreach($data['center_location'] as $item)
                                                        @if($item->id_parent == 0)
                                                            <li class="kc-group" id="up_{{$item->id}}">
                                                                <div class="kc-heading" id="up_{{$item->id}}"><i
                                                                        class="fas fa-map-marker-alt"></i>{{$item->title}}
                                                                </div>
                                                                <input type="hidden" class="parentMenuBytn"
                                                                       id="btn-{{$item->id}}">
                                                                <ul class="menu_parent" id="menu_parent0">
                                                                    @foreach($data['center_location'] as $val)
                                                                        @if($val->id_parent == $item->id)
                                                                            <li id="selectOne" data-id="{{$val->id}}"
                                                                                name="selectOne"
                                                                                data-value="{{$val->id}}">
                                                                                <button type="button">
                                                                                    @if($val->type=='hotel')
                                                                                        <i style="margin: 2px 10px 0 0;"
                                                                                           class="fas fa-hotel icon-large"></i>
                                                                                    @elseif($val->type == 'airport')
                                                                                        <i style="margin: 2px 10px 0 0;"
                                                                                           class="fas fa-plane-departure icon-large"></i>
                                                                                    @elseif($val->type == 'center')
                                                                                        <i style="margin: 2px 10px 0 0;"
                                                                                           class="fas fa-map-marker-alt icon-large"></i>
                                                                                    @elseif($val->type == 'address')
                                                                                        <i style="margin: 2px 10px 0 0;"
                                                                                           class="fas fa-map-marker-alt icon-large"></i>
                                                                                    @endif
                                                                                    {{$val->title}}
                                                                                </button>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="flex-title kc-d">
                                            <div class="desc">{{__("drop_off_location")}}</div>
                                        </div>
                                        <div class="kc-search-block kc-dropdown kc-search-point kc-search-end-point">
                                            <div class="kc-value kc-value-down" data-placeholder="{{__("drop_off_location_select")}}">{{__("drop_off_location_select")}}</div>
                                            <input type="hidden" id="end_point" name="end_point">
                                            <div class="kc-dropdown-items kc-fade-to-scale">
                                                <div class="kc-mobile-header">
                                                    <div class="kc-title" style="display:none">{{__("drop_off_location")}}</div>
                                                    <div class="kc-close"><i class="fa fa-times"></i></div>
                                                </div>
                                                <ul class="kc-options" id="kc-options-parent"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" ">
                                    <input type="checkbox" name="is_active_select" id="is_active_select" class="form-control" style=" width:15px;height:15px;margin: 10px 0 0 0;float: left;">
                                    <label class="returnBox" for="is_active_select"> {{__('Farklı lokasyona arabayı bırakacağım')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 loc">
                            <div class="row">
                                <div class="d-none d-lg-block">
                                    <div class="flex">
                                        <span class="greenLabel">{{__('Çıkış Tarihi / Saat')}}</span>
                                        <span class="redLabel">{{__('Dönüş Tarihi / Saat')}}</span>
                                    </div>
                                </div>
                                <div class="col-12 carSearch">
                                    <div class="row">
                                        <div class="col-12 col-md-6 fa fa-calendar-alt">
                                            <div class="row">
                                                <div class="desc">{{__('pick_up_date')}}</div>
                                                <div id="cikis_timer" class="picktimer fa fa-sort-down">
                                                    <input id="from" class="flatpickr-input" type="hidden" name="cikis_tarihi_submit" value="<?=$data['checkin']?>">
                                                    <input type="hidden" id="t1" name="cikis_saati_submit" value="{{date("H")+1}}:00">
                                                    <div class="date" onclick="openCalendar()"><?=date('d', strtotime($data['checkin']))?></div>
                                                    <div class="date-detail">
                                                        <span class="month uppercase" onclick="openCalendar()"><?php echo \App\Helpers\Search::getMounthName($data['checkin'], 1) ?></span>
                                                        <span class="day" onclick="openCalendar()"><?php echo \App\Helpers\Search::getMounthName($data['checkin'], 3) ?></span>
                                                    </div>
                                                    <div class="date-detail timer fa fa-clock t1">
                                                        <span class="time"><b>{{date("H")+1}}</b>:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 fa fa-calendar-alt">
                                            <div class="row">
                                                <div class="desc">{{__('drop_off_date')}}</div>
                                                <div id="donus_timer" class="droptimer fa fa-sort-down">
                                                    <input id="to" class="flatpickr-input" type="hidden"
                                                           name="donus_tarihi_submit" value="<?=$data['checkout']?>">
                                                    <input type="hidden" id="t2" name="donus_saati_submit"
                                                           value="{{date("H")+1}}:00">
                                                    <div class="date"
                                                         onclick="openCalendar2()"><?=date('d', strtotime($data['checkout']))?></div>
                                                    <div class="date-detail">
                                                        <span class="month uppercase"
                                                              onclick="openCalendar2()"><?php echo \App\Helpers\Search::getMounthName($data['checkout'], 1) ?></span>
                                                        <span class="day"
                                                              onclick="openCalendar2()"><?php echo \App\Helpers\Search::getMounthName($data['checkout'], 3) ?></span>
                                                    </div>
                                                    <div class="date-detail timer fa fa-clock t2">
                                                        <span class="time"><b>{{date("H")+1}}</b>:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 loc">
                            <div class="row">
                                <button type="submit" class="btn btn-secondary">{{__('car_search')}} <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="section-padding how-work-area">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="section-title text-center" style="color: #545454;"><span>{{__('farkimiz')}}</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-none d-lg-block">
                    <div class="icons-section">
                        <div class="single-icon">
                            <img src="{{asset('public/view/icon/guvenilir_arac_kiralama.svg')}}"
                                 style="width: 75%;margin: 6px 0;" alt="{{__('reliable_car_rental')}}">
                        </div>
                        <div class="single-icon">
                            <img src="{{asset('public/view/icon/7_24_service.svg')}}" style="width: 75%;margin: 6px 0;"
                                 alt="{{__('7_24_service')}}">
                        </div>
                        <div class="single-icon">
                            <img src="{{asset('public/view/icon/hersey_dahil_fiyatlar.svg')}}"
                                 style="width: 75%;margin: 6px 0;" alt="{{__('reliable_car_rental')}}">
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="single-icon text-center m-b-10 d-block d-lg-none col-3 col-sm-12">
                            <img src="{{asset('public/view/icon/guvenilir_arac_kiralama.svg')}}"
                                 alt="{{__('reliable_car_rental')}}">
                        </div>
                        <div class="how-work-text col-9 col-sm-12">
                            <h3>{{__('reliable_car_rental')}}</h3>
                            <p>{{__('reliable_car_rental_value')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="single-icon text-center m-b-10 d-block d-lg-none col-3 col-sm-12">
                            <img src="{{asset('public/view/icon/7_24_service.svg')}}" alt="{{__('7_24_service')}}">
                        </div>
                        <div class="how-work-text col-9 col-sm-12">
                            <h3>{{__('7_24_service')}}</h3>
                            <p>{{__('7_24_service_value')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="single-icon text-center m-b-10 d-block d-lg-none col-3 col-sm-12">
                            <img src="{{asset('public/view/icon/hersey_dahil_fiyatlar.svg')}}"
                                 alt="{{__('all_inclusive_prices')}}">
                        </div>
                        <div class="how-work-text col-9 col-sm-12">
                            <h3>{{__('all_inclusive_prices')}}</h3>
                            <p>{{__('all_inclusive_prices_value')}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id="homeShowcase">
        @if($data["car_camping"])
            <div class="auto-container" style="margin-top: 10px;margin-bottom: 10px">
                <div class="row">
                    <div class="text-center col-md-12">
                        <h2 class="col-12 font-weight-bold"
                            style="font-size: 1.5rem;">{{__('dont_miss_last_minute_deals')}}</h2>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                    <div class="top-content col-12">
                        <div class="slider col-12">
                            <div class="flexslider carousel">
                                <ul class="slides">
                                    <?php foreach ($data["car_camping"] as $val) { ?>
                                    <li>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 style="font-size: 18px;" class="card-title">{{$val['title']}}</h5>
                                                <a title="uygun fiyata yaz dönemi araç kiralama"
                                                   href="/{{app()->getLocale()}}/{{__("campain_url")}}/{{$val["slug"]}}/{{$val["id"]}}">
                                                    <img class="card-img-top"
                                                         src="{{asset("storage/uploads/".$val["car_image"]."")}}"
                                                         alt="{{$val['title']}}">
                                                </a>
                                                <h5 class="card-title">{{$val["car"]}}</h5>
                                                <span class="text-success">{{$val["price"]}} €</span>
                                                <p class="card-text">{{$val["day"]}} {{__('dayLimit')}}</p>
                                                <div>
                                                    @foreach($val['attributes'] as $item)
                                                        <span class="btn btn-light btn-sm">{{$item}}</span>
                                                    @endforeach
                                                </div>
                                                <a title="Araç kiralama yaparken mini hasar sigortasına dikkat edilmelidir."
                                                   href="/{{app()->getLocale()}}/{{__("campain_url")}}/{{$val["slug"]}}/{{$val["id"]}}"
                                                   class="btn btn-reser mt-3 fadee">{{__('book')}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 text-center mt-4">
                            <a href="/{{app()->getLocale()}}/{{__('all_campain_url')}}" alt="{{__("campain_title")}}"
                               title="{{__("campain_title")}}" class="allButton">
                                <h4><u>{{__('all_campaigns')}}</u></h4>
                            </a>
                        </div>
                    </div>
                </div>
        @endif
    </section>
    @if($data["destinations"])
        <section class="section-location">
            <div class="blog-gray-bg">
                <div class="auto-container">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 style="  text-align: center;  font-size: 1.9rem !important;">{{__('popular')}}
                                {{__('locations')}}</h2>
                            <p>{{__("popular_locations_value")}}</p>
                        </div>
                    </div>
                    <div class="locations">
                        <div class="col-12">
                            <div class="row">
                                @foreach($data["destinations"] as $item)
                                    <div class="col-6 col-sm-4 col-md-3 col-lg-3 member-deals__list is--dealsunder199">
                                        <a title="{!! $item->title !!}" href="/{{app()->getLocale()}}/{{__('destination_url')}}/{{$item->slug}}/{{$item->id}}">
                                            <div class="member-deals__wrapper active">
                                                <div class="member-deals__wrapper-item">
                                                    <div class="LazyLoad is-visible member-deals__img-wrapper">
                                                        <img src="{{asset('storage/webp/'.\App\Models\Destination::getimages($item->id)->title.'')}}"  class="img-fluid card-img" style="height: 100%" alt="{{$item->title}}">
                                                    </div>
                                                    <h3 class="h3_whs-nowrap" itemprop="name">{{$item->title}}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                <div class="col-md-12 text-center mt-4">
                                    <a title="Tüm Lokasyon"  href="/{{app()->getLocale()}}/{{__('all_locations_url')}}"
                                       title="{{__('all_locations_url')}}" class="allButton">
                                        <h4><u>{{__("all_locations")}}</u></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
      @if($data["blogs"])
        <section class="section-blog">
            <div class="">
                <div class="auto-container">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 style="font-size: 1.5rem !important;color: #545454;padding-top: 15px;"
                                class="title">{{__("blog_title")}}</h2>
                            <p>{{__("blogs_value")}}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach($data["blogs"] as $blog)
                                <?php $image = Image::where('model','blogs')->where('model_id',$blog->id)->first(); ?>
                                <div class="news-style-one col-12 col-sm-4 col-md-3 col-lg-3">
                                    <div class="inner-box wow fadeIn animated" data-wow-delay="0ms"  data-wow-duration="1500ms">
                                        <figure class="image-box">
                                            <a title="{{__('blog_link_title')}}"  href="/{{app()->getLocale()}}/{{__('blog')}}/{{$blog->slug}}/{{$blog->id}}">
                                                <img style="height: 190px;" src="{{asset('storage/webp/'.$image->title.'') }}" alt="{{$blog->image_alt}}" title="{{$blog->image_alt_title}}">
                                            </a>
                                            <div class="date-box">
                                                <span class="day">{{\Carbon\Carbon::parse($blog->created_at)->format('d')}}</span>
                                                <span class="month">{{\Carbon\Carbon::parse($blog->created_at)->format('M')}}</span>
                                            </div>
                                        </figure>
                                        <div class="lower-content">
                                            <h3>
                                                <a title="{{$blog->title}}" href="/{{app()->getLocale()}}/{{__('blog')}}/{{$blog->slug}}/{{$blog->id}}">{{$blog->title}}</a>
                                            </h3>
                                            <!--div class="text">{!! $blog->short_description !!}</div-->
                                            <a title="Antalya Havalimanı Rent A Car, Arac Kiralama Alanya, Gazipasa Airport Rent A Car" href="/{{app()->getLocale()}}/{{__('blog')}}/{{$blog->slug}}/{{$blog->id}}" class="btn btn-primary">{{__('more_as')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-4">
                        <a href="{{ route(__('blogs'), [app()->getLocale()])}}" title="{{__("all_blogs")}}"
                           class="allButton">
                            <h4><u>{{__("all_blogs")}}</u></h4>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="section-blog">
        <div class="blog-gray-bg">
            <div class="auto-container">
                <div class="col-12">
                    <h2 style="text-align:center;">{{__('comment_title')}}</h2>
                    <p style="text-align:center;" id="toc-18" class="active">{{__('comment_value')}}</p>
                </div>
                @if (\Session::has('warning'))
                    <div class="alert alert-warning">
                        <ul>
                            <li>{!! \Session::get('warning') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="col-12">
                    <div class="row customer-reviews">
                        <?php foreach ($data["comments"] as $item) { ?>
                        <div class="col-12 col-sm-4">
                            <div class="widget-review">
                                <div class="row">
                                    <div class="col-6 widget-stars">
                                        <div class="stars stars--5">
                                            @for($i=1; $i <= $item->star; $i++)
                                                <i style="color:#f9af00" class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div
                                        class="col-6 date secondary-text text-right"> {{date("d-m-Y", strtotime($item->created_at))}}</div>
                                </div>
                                <a href="{{ route(__('comments_url'), [app()->getLocale()])}}" target="_blank"
                                   title="Kişiden kişiye araç kiralama">
                                    <div
                                        class="text">{!! strip_tags(\App\Repository\Data::wordRestriction($item->description,355)) !!}</div>
                                </a>
                                <a href="{{ route(__('comments_url'), [app()->getLocale()])}}" target="_blank"
                                   title="Uzun dönem araç kiralama">
                                    <div class="name secondary-text">
                                        <div class="iac-cell">
                                            <div class="iac-avatar"
                                                 itemprop="author">{{$item->firstname[0] ?? 'N'}} {{$item->lastname[0] ?? 'N'}}</div>
                                            <span
                                                style="float: right;line-height: 3; margin-left: 15px;font-size: 14px;">{{$item->country}} {{$item->car}} / {{$item->city}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="btn-group">
                            <a href="{{ route(__('comments_url'), [app()->getLocale()])}}"
                               title="{{__("all_comments")}}"
                               class="btn btn-primary">{{__("all_comments")}}</a>
                            <a title="araç kiralama için bizi değerlendirin" data-toggle="modal"
                               data-target="#modalComment" class="btn btn-secondary">{{__("createcomment")}}</a>
                        </div>
                    </div>
                </div>

                <div class="modal" id="modalComment" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{__('Görüş Bildir')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="./create_comment">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">{{__('Email Adresi')}}:</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                               id="email">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="pwd">{{__('İsim')}}:</label>
                                                <input type="text" class="form-control" name="firstname">
                                            </div>
                                            <div class="col">
                                                <label for="pwd">{{__('Soyisim')}}:</label>
                                                <input type="text" class="form-control" name="lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">{{__('Puan')}}:</label>
                                        <select class="form-control" name="star">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class=" ">
                                            <label for="pwd">{{__('Ülke')}}:</label>
                                            <select class="form-control" name="country" id="country">
                                                @foreach($data['country'] as $item)
                                                    <option
                                                        value="{{$item->country_name}}">{{$item->country_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" ">
                                            <label for="pwd">{{__('The City You Rented')}}:</label>
                                            <select class="form-control" name="city" id="city">
                                                <?php foreach($data['center_location'] as $item){ ?>
                                                @if($item->id_parent == 0)
                                                    <option value="<?=$item->title?>"><?=$item->title?></option>
                                                @endif
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class=" ">
                                            <label for="pwd">{{__('Araç')}}:</label>
                                            <select class="form-control" name="car">
                                                @foreach($data['car'] as $item)
                                                    @php

                                                        $marka = $item->brandfunction->brandname ?? "Belirtilmedi";
                                                        $model = $item->modelfunction->modelname ?? "Belirtilmedi";
                                                    @endphp
                                                    <option value="{{$marka}},{{$model}}">

                                                        {{$marka}} | {{$model}}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">{{__('Yorum')}}:</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="form-group form-check">
                                        {{--                                        <div class="captcha" style="width: 74%;">--}}
                                        {{--                                            <span>{!! captcha_img() !!}</span>--}}
                                        {{--                                            <input type="text" name="captcha" style="height: 38px">--}}
                                        {{--                                            <button type="button" class="btn btn-danger" class="reload" id="reload">&#x21bb;</button>--}}
                                        {{--                                        </div>--}}
                                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                                            <div class="form-group g-recaptcha"
                                                 data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('Kaydet')}}</button>
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{__('Kapat')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-blog">
        <div class="blog-gray-bg more-text">
            <div class="auto-container" style="border-top: 1px solid #cfcfcf;padding-top: 20px!important">
                <div class="col-12">
                    <h2>{!! __('newtext1') !!}</h2>
                    <p>{!! __('newtext2') !!}</p>
                    <h2>{{__('newtext3')}}</h2>
                    <p class="morehide">{!! __('newtext4') !!}</p>
                    <button class="more" onclick="more()">{{__('homeTextBtn')}}</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        function validateForm() {
            var x = document.forms["searchFormName"]["pick_up_location"].value;
            if (x == "") {
                swal.fire({
                    icon: 'error',
                    title: 'Hata...',
                    text: '{{__("error_location")}}'
                    //footer: '<a href="">Why do I have this issue?</a>'
                })
                /*swal({
                    title: "HATA!",
                    text: "Lütfen Alış Yeri Seçiniz ",
                    confirmButtonColor : "#f9af00",
                    confirmButtonText : "KAPAT",
                    imageUrl: 'public/view/images/357a0293a2f587555ef6434d2f3a3f86-AjaxSpinner.gif'
                });*/
                return false;
            }
        }
    </script>
@endsection
