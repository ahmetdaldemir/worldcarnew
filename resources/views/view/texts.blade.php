@extends('layouts.welcome')
@section('title'){{$data["text"] ? $data["text"]->meta_title : "World Car Rental"}} - @endsection
@section('content')
<?php $x = \App\Models\TextLanguage::getHeaderImage($data["id"]);?>


<section class="header-blogdetail" style="background-image: url({{asset('storage/'.$x)}})">
    <div class="container">
        <div class="text-center">
            <h1>{{$data["text"]->title}}</h1>
        </div>
    </div>
</section>
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row ">
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--News Section-->
                <section class="col-12 news-section">
                    <div class="news-style-one">
                        <div class="inner-box">
                            <!-- figure class="image-box"><a href="#" style="background: url('{{$data['text']->file}}') no-repeat center;" alt="{{$data['text']->title}}">
                                <img src="{{$data["text"]->file}}" alt="{{$data["text"]->title}}">
                                </a>
                            </figure -->
                            <div class="lower-content">
                                {{--<h3>{{$data["text"]->title}}</h3>--}}
                                <div class="text text-content" style="text-align:left">
                                    {!! $data["text"]->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padd-left-40">
                <aside class="sidebar">
                    <div class="sidebar-widget popular-posts">
                        <div class="widget-box">
                            <div class="sidebar-title"><h3>{{__('informations')}}</h3></div>
                            <?php foreach ($data["texts"] as $item){ ?>
                            <a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$item->slug}}/{{$item->id}}">
                                <article class="post">
                                    <figure class="post-thumb"><img src="{{asset('storage/'.$item->file)}}" alt="{{$item->title}}">
                                    </figure>
                                    <h4>{{$item->title}}</h4>
                                    <div class="post-info">{{date('d-m-Y H:i',strtotime($item->created_at))}} </div>
                                </article>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
