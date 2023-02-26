@extends('layouts.welcome')
@section('title')
    {{__('all_locations')}} -
@endsection
@section('content')
    <section class="header-blogdetail"
             style="background-image: url('https://worldcarrental.com/storage/uploads/pages_texts91623359105_1626005969.png')">
        <div class="container">
            <div class="text-center">
                <h4>{{__('all_locations')}}</h4>
            </div>
        </div>
    </section>
    <div class="col-md-12">
        <div class="auto-container" style="margin: 20px auto;">
            <div class="row">
                <?php foreach ($data["all_destinations"] as $item){ ?>
                <div class="col-md-3">
                    <a href="/{{app()->getLocale()}}/{{__('destination_url')}}/{{$item->slug}}/{{$item->id}}"
                       class="card media-card">
                        <figure class="card-img-wrapper">
                            @if($item->image == "")
                                <img src="{{asset('storage/webp/'.$item->resim.'') }}" class="img-fluid card-img center" alt="{{$item->title}}">
                            @else
                                <img src="{{asset('storage/'.$item->image.'') }}" class="img-fluid card-img center"  alt="{{$item->title}}">
                            @endif
                        </figure>
                        <div class="card-img-overlay">
                            <div class="card-content">
                                <h4 class="card-title ucnokta">{{$item->title}}</h4>
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
        figure.card-img-wrapper {
            margin: 0;
        }

        .card-title {
            font-size: 125%;
        }

        .card-img-overlay {
            padding: 10px;
            position: relative;
            text-align: right;
            display: block;
        }

        a:hover .card-img-overlay {
            background: #fbfbfb;
        }

        a:hover span.card-link {
            text-decoration: underline;
        }

        figure.card-img-wrapper {
            text-align: center;
            border-bottom: 1px solid #e7e7e7;
        }

        .card-img {
            max-width: 100%;
            text-align: center;
            height: 316px
        }

        .ucnokta {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 15px;
        }
    </style>
@endsection
