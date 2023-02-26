@extends('layouts.welcome')
@section('content')
    <?php $x = \App\Models\TextLanguage::getHeaderImage($data["id"]);?>
    <section class="header-blogdetail" style="background-image: url({{asset('storage/uploads/'.$x)}})">
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
                                <figure class="image-box"><a href="#" style="background: url('{{$data['text']->file}}') no-repeat center;" alt="{{$data['text']->title}}">
                                        @if($data["text"]->file == "no-image.png")
                                            <img src="http://via.placeholder.com/762x440" alt="{{$data["text"]->title}}">
                                        @else
                                        <!--<img src="{{$data["text"]->file}}" alt="{{$data["text"]->title}}">-->
                                        @endif
                                    </a>
                                    <div class="date-box">
                                        <span class="day">{{\Carbon\Carbon::parse($data["text"]->created_at)->format('d')}}</span>
                                        <span  class="month">{{\Carbon\Carbon::parse($data["text"]->created_at)->format('M')}}</span>
                                    </div>
                                </figure>
                                <div class="lower-content">
                                    {{--<h3>{{$data["text"]->title}}</h3>--}}
                                    <div class="text text-content">
                                        {!! $data["text"]->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
@endsection
