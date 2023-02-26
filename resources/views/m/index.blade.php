<?php use App\Models\Image; ?>
@extends('m.layouts.master')
@section('title')@endsection
@section('content')
    <div id="content">
        <!-- Content Wrap  -->
        <div class="content-wrap">
            <!-- slider -->
            <div class="img-hero">
                <?php foreach ($data['mobil_sliders'] as $slide){ ?>
                <div>
                    <img src="{{asset('storage/webp/'.$slide->images()->title.'') }}">
                </div>
                <?php } ?>
            </div>
            <!-- .slider -->

            <!-- section 1 -->
            <div class="home-icon">
                <div class="section-home">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-layout">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Alış & Dönüş</label>
                                                <label style="float: right;">Değiştir</label>
                                                <div class="field-group">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <select class="custom-select mr-sm-2 with-icon" id="country">
                                                        <option selected disabled>Şehir, Havalimanı, Araç Kiralama</option>
                                                        @foreach($data['center_location'] as $item)
                                                            @if($item->id_parent == 0)
                                                                <optgroup label="{{$item->title}}">
                                                                    @foreach($data['center_location'] as $val)
                                                                        @if($val->id_parent == $item->id)
                                                                            <option style="font-size: 15px;" value="  {{$val->id}}">  {{$val->title}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </optgroup>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div style="display: none" class="form-group col-md-12">
                                                <label>City</label>
                                                <div class="field-group">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <select class="custom-select mr-sm-2 with-icon" id="city">
                                                        <option selected disabled>Nerede Teslim Edilecek ?</option>
                                                        <option value="1">Yogyakarta</option>
                                                        <option value="2">Jakarta</option>
                                                        <option value="3">Bandung</option>
                                                        <option value="4">Surabaya</option>
                                                        <option value="4">Semarang</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>Alış Tarihi Saat</label>
                                                <label style="float: right;position: relative; left: -40px;">Dönüş Tarihi Saat</label>
                                                <div class="no-padding-right">
                                                    <div class=" field-group datepickerformobile" style="width: 48%;float: left">
                                                        <input readonly placeholder="Tarih" type="text" id="datestart" class="datepicker form-control with-icon date-start-class" style="height: 45px !important;">
                                                        <input readonly placeholder="Saat" type="text" class="form-control timepicker1 with-icon"  style="height: 45px !important;"/>
                                                        <ul id="sx-js-res-pu-time-list" class="ddlist-ul"></ul>
                                                    </div>
                                                    <div class=" field-group datepickerformobile" style="width: 48%;float: right">
                                                        <input readonly placeholder="Tarih" type="text" id="dateend" class="datepicker form-control with-icon date-end-class" style="height: 45px !important;">
                                                        <input readonly placeholder="Saat" type="text" class="form-control timepicker2 with-icon timeadded "  style="height: 45px !important;"/>
                                                        <ul id="sx-js-res-pu-time-list2" class="ddlist-ul2"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                 <div class="button">
                                                    <button type="submit" class="btn-block theme-button">Reserve Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .section 1 -->
            <style>
                #sx-js-res-pu-time-list, #sx-js-res-pu-time-list2 {
                    height: 300px !important;
                    overflow: auto;
                    width: 73px;
                    margin: 0;
                    padding: 0;
                    float: right;
                    background: #e5e5e5;
                    display: none;
                    top: 44px;
                    right: 0;
                    position: absolute;
                    z-index: 9;
                }

                input.timepicker1 {
                    padding: 0 !important;
                    width: 48%;
                    float: right;
                    text-align: center;
                }

                input.timepicker2 {
                    padding: 0 !important;
                    width: 48%;
                    float: right;
                    text-align: center;
                }

                #sx-js-res-pu-time-list > li, #sx-js-res-pu-time-list2 > li {
                    list-style: none;
                    color: #1f1c22;
                    border-bottom: 1px solid #fff;
                    font-size: 15px;
                    text-align: center;
                    padding: 3px;
                }

                #sx-js-res-pu-time-list > li:hover, #sx-js-res-pu-time-list2 > li:hover, #sx-js-res-pu-time-list > li:hover, #sx-js-res-pu-time-list2 > li:focus {
                    background: #ff7d19;
                    color: white;
                }

                #sx-js-res-pu-time-list > li:after, #sx-js-res-pu-time-list2 > li:after {
                    border-bottom: 1px solid #fff;
                }
            </style>
            @if($data["car_camping"])
            <div class="heading-section">
                <div class="sa-title popcat">Kampanya</div>
                <div class="heading-info">
                    Kampanya herkesin hakkı
                </div>
                <div class="clear"></div>
            </div>
            <div class="section-home available-car">
                <div class="default-carousel car-carousel">
                    <?php foreach ($data["car_camping"] as $val) { ?>
                    <div class="item">
                        <div class="acr-box">
                            <div class="acr-box-in">
                                <div class="acr-img">
                                    <img src="{{asset("storage/uploads/".$val["car_image"]."")}}" alt="{{$val['title']}}">
                                </div>
                                <div class="acr-content">
                                    <div class="ct-name">{{$val['car']}}</div>
                                    <div class="ct-cost"><span class="cprice"> {{$val["price"]}} € </span><span class="perday">rent per day</span>
                                    </div>

                                    <div class="ct-reserve">
                                        <a href="/" class="theme-button">
                                            Reserve Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="acr-bg">
                                <img src="{{ asset('public/m/img/bgcar.jpg')}}">
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>
            @endif
            <!-- section 3 -->
            @if($data["destinations"])

                <div class="heading-section">
                    <div class="sa-title popcat">Bölgeler
                    </div>
                    <div class="heading-info">
                        Unutulmak tatil, Unutulmaz bölgeler
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section-home vacation-destination">
                    <div class="default-carousel vs-carousel">

                        @foreach($data['destinations'] as $destination)
                            <div class="item">
                                <div class="vs-box">
                                    <div class="vsb-top">
                                        <div class="vsbt-img">
                                            <img src="{{asset('storage/'.$destination->image.'')}}"
                                                 alt="{{$destination->title}}">
                                        </div>
                                    </div>
                                    <div class="vsb-middle">
                                        <div class="vsbm-left">
                                            {{$destination->title}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        <!-- .section 3 -->
            <!-- section 4 -->
            @if($data["blogs"])

                <div class="heading-section">
                    <div class="sa-title popcat">Blog</div>
                    <div class="heading-info">
                        Daha hızlı, daha ucuz ve daha akıllı seyahat edin !
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section-home home-news">

                    <div class="home-news-wrap">
                        @foreach($data["blogs"] as $blog)
                            <?php
                            $image = Image::where('model', 'blogs')->where('model_id', $blog->id)->first();
                            ?>

                            <a href="/{{app()->getLocale()}}/{{__('blog')}}/{{$blog->slug}}/{{$blog->id}}">
                                <div class="news-item">
                                    <div class="news-content">
                                        <div class="hnw-img">
                                            <img src="{{asset('storage/webp/'.$image->title.'') }}"
                                                 alt="{{$blog->image_alt}}" title="{{$blog->image_alt_title}}">
                                        </div>
                                        <div class="hnw-desc">
                                            <div class="hnw-title">{{$blog->title}}</div>
                                            <div class="hnw-text">
                                                {!! \App\Repository\Data::wordRestriction($blog->short_description,85) !!}
                                                <span class="more">Devamını Oku</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class=" more-category">
                            <a href="#">
                                <div class="theme-button mcbutton">Tümünü Görüntüle</div>
                            </a>
                        </div>
                    </div>
                </div>
        @endif
        <!-- .section 4 -->

            <!-- SUBSCRIBE -->
            <div class="section-subscribe">
                <div class="subcontainer">
                    <div class="subrow">
                        <div class="subcol">
                            <div class="section-title">E Bülten Üyeliği</div>
                            <div class="mail-subscribe-box">
                                <form name="subsribe">
                                    <input class="form-control" name="user-email" placeholder="Enter email address"
                                           value="" type="email">
                                    <button type="submit" class="submitsub"><i class="fa fa-angle-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-subscribe">
                    <img src="{{ asset('public/m/img/image.jpg')}}" alt="banner">
                </div>
            </div>
            <!-- END SUBSCRIBE -->


        </div>
    </div>





@endsection
