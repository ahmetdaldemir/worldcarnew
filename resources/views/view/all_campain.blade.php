@extends('layouts.welcome')
@section('title'){{__('all_campaigns')}} - @endsection
@section('content')
<section class="header-blogdetail" style="background-image: url('https://worldcarrental.com/storage/uploads/last-minute-offer-rental-worldcarrental.jpg')">
    <div class="container">
        <div class="text-center">
            <h4>{{__('all_campaigns')}}</h4>
        </div>
    </div>
</section>
<div class="row" style="margin: 50px 0">
<div class="auto-container">
    <div class="row">
        <?php foreach ($data["all_campain"] as $item){ ?>
            <div class="col-md-4">
                <a href="/{{app()->getLocale()}}/{{__("campain_url")}}/{{$item['slug']}}/{{$item['id_camping']}}" class="card media-card">
                    <figure class="card-img-wrapper">
                        <img src="{{asset('storage/uploads/'.$item['image'].'') }}" class="img-fluid card-img center"  alt="{{$item['title']}}">
                    </figure>
                    <div class="card-img-overlay">
                        <div class="card-content">
                            <h4 class="card-title">{{$item['title']}}</h4>
                            <p class="card-text"></p>
                        </div>
                        <span class="card-link">
                    <span>DETAYLI BİLGİ</span>
                    <i class="icon icon-arrow-right"></i>
                    </span>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<style>
figure.card-img-wrapper {margin: 0;}
.card-title {font-size: 150%;}
.card-img-overlay {padding: 10px;position: relative;text-align: right;display: block;}
a:hover .card-img-overlay {background:#fbfbfb;}
a:hover span.card-link {text-decoration: underline;}
figure.card-img-wrapper {text-align: center;border-bottom: 1px solid #e7e7e7;}
.card-img {max-width: 100%;height: 200px;text-align: center;}
</style>
@endsection

