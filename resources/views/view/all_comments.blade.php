@extends('layouts.welcome')
<link href="{{ asset('public/view/css/comment.css') }}" rel="stylesheet"/>

@section('title'){{__('all_comments')}} - @endsection

@section('content')
    <section class="header-blogdetail" style="background-image: url('https://worldcarrental.com/storage/uploads/texts_9_1623359105.png')">
        <div class="container">
            <div class="text-center">
                <h4>{{__('all_comments')}}</h4>
            </div>
        </div>
    </section>
    <div class="col-md-12" style="margin-top: 50px">
        <div class="auto-container">
            <div class="row">
                <div class="col-12">
                    <h2 id="toc-18" class="active">Our Customers Reviews</h2>
                </div>
            </div>
            <div class="iac-container">
                @foreach($data["all_comments"] as $item)
                    <div class="row iac-row">
                        <div class="col-3 col-md-1">
                            <div class="iac-table">
                                <div class="iac-cell">
                                    <div class="iac-avatar">{{$item->firstname[0] ?? 'N'}} {{$item->lastname[0] ?? 'N'}}</div>
                                </div>
							</div>
						</div>
                        <div class="col-9 col-md-2">
                            <div class="iac-table">
                                <div class="iac-cell">
                                    <div class="">{{$item->country}}</div>
                                    <div class="">{{$item->car}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="iac-info">
                            <span class="iac-rate">
                                <span itemprop="reviewRating">
                                    <meta itemprop="ratingValue" content="6.0">
                                    <meta itemprop="bestRating" content="10">
                                    <meta itemprop="worstRating" content="0">
                                </span>
                                <span class="iac-star filled"></span>
                                <span class="iac-star filled"></span>
                                <span class="iac-star filled"></span>
                                <span class="iac-star"></span>
                                <span class="iac-star"></span>
                            </span>
                                <span class="iac-date" itemprop="dateCreated">{{date("d-m-Y",strtotime($item->created_at))}}</span>
                                <div class="iac-text" itemprop="reviewBody">{!! $item->description!!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .iac-row {
            position: relative;
            padding: 10px 0 15px;
        }
        .iac-row:before {
            position: absolute;
            top: 0;
            left: 15px;
            content: '';
            display: block;
            width: calc(100% - 30px);
            border-top: solid 1px #d8d8d8;
        }
        .iac-row .col-2 {
            padding-right: 0;
        }
        .iac-table {
            display: table;
        }
        .iac-cell {
            display: table-cell;
            vertical-align: top;
        }
        .iac-avatar {
            height: 44px;
            width: 44px;
            color: #fff;
            font-size: 16px;
            line-height: 44px;
            text-align: center;
            border-radius: 44px;
            background-color: #002a68;
        }
        .iac-car, .iac-country {
            position: relative;
            margin-top: 4px;
            padding-left: 36px;
            font-size: 13px;
            line-height: 16px;
            color: #757575;
        }
        i.flag:not(.icon) {
            display: inline-block;
            width: 16px;
            height: 11px;
            line-height: 11px;
            vertical-align: baseline;
            margin: 0 8px 0 0;
            text-decoration: inherit;
            speak: none;
            font-smooth: antialiased;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .iac-car, .iac-country {
            position: relative;
            margin-top: 4px;
            padding-left: 36px;
            font-size: 13px;
            line-height: 16px;
            color: #757575;
        }
        .iac-car i {
            top: -3px;
        }
        .iac-car i, .iac-country i {
            position: absolute;
            left: 12px;
        }
    </style>
@endsection
