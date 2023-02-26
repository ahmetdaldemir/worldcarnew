@extends('layouts.welcome')

@section('content')
<section class="header-blogdetail" style="background-image: url({{asset('storage/uploads/worldcarrental-blog.jpg')}})">
    <div class="container">
        <div class="text-center">
            <h1>{{$data["blog"]->title}}</h1>
        </div>
    </div>
</section>

<?php use App\Models\Image; $image = Image::where('model','blogs')->where('model_id',$data['id'])->first();  ?>
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row ">
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--News Section-->
                <section class="col-12 news-section">
                    <div class="news-style-one">
                        <div class="inner-box">
                            <figure class="image-box"><a href="#">
                                    <img  style="width: 100%" src="{{asset('storage/webp/'.$image->title.'')}}" alt="{{$data["blog"]->image_alt}}" title="{{$data["blog"]->image_alt_title}}"></a>
                                <div class="date-box"><span
                                        class="day">{{\Carbon\Carbon::parse($data["blog"]->created_at)->format('d')}}</span><span
                                        class="month">{{\Carbon\Carbon::parse($data["blog"]->created_at)->format('M')}}</span>
                                </div>
                            </figure>
                            <div class="lower-content">
                                <!-- h3>{{$data["blog"]->title}}</h3 -->
                                <div class="text text-content">
                                    {!! $data["blog"]->description !!}
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
                            <div class="sidebar-title"><h3>Bloglar</h3></div>
                            <?php foreach ($data["blogs"] as $item){ ?>
                          <?php  $image = Image::where('model','blogs')->where('model_id',$item->id)->first(); ?>
                            <a href="/{{app()->getLocale()}}/{{__('blog')}}/{{$item->slug}}/{{$item->id}}">
                                <article class="post">
                                    <figure class="post-thumb"><img src="{{asset('storage/webp/'.$image->title.'')}}" alt="{{$item->title}}">
                                    </figure>
                                    <h4>{{$item->title}}</h4>
                                    <div class="post-info">{{$item->created_at}} </div>
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
