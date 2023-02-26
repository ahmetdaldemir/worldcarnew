@extends('layouts.welcome')

@section('content')
    <section class="header-blogdetail">
        <div class="container" style="    height: 200px;">
            <div class=" pb-3  pr-2 pl-2">
                <div class="text-center mb-3">
                    <h1>{{__('Reservation')}}</h1>
                    <div class="bread-crumb-outer">
                        <ul class="bread-crumb clearfix">
                            <li><a href="/">{{__('Anasayfa')}}</a></li>
                            <li class="active">{{__('Reservation')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="auto-container mt-3">
            <div class="card pl-4 pl-md-5 pr-3">
                <div class="row">
                    <div class="left-side col-md-9">
                        <p class="pt-5 mb-0" style="font-size: 20px"><span>{{__('Sayın')}}</span> <b><?=$reservation['reservationInformation']->firstname?> <?=$reservation['reservationInformation']->lastname?></b></p>
                        <h7>{{__('front_booking')}}</h7>
                        <br /><br />
                        <a href="/" class="btn btn-success mb-md-5">{{__('Anasayfaya Dön')}}</a>
                    </div>
                    <div class="right-side col-md-3">
                        <img class="shoe-img pl-5 pl-md-0" style="width: 50%;margin: 21px 0 0 0;" src="{{asset('public/view/images/check.png')}}"></div>
                </div>
        </div>
    </div>
@endsection

<style>

    .header-blogdetail {
        background: url(https://worldcarrental.com/public/view/images/background/f2323f32f23f23f2.png) no-repeat #05070c8c 73% 80%;
        position: relative;
        padding: 104px 0px 00px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        text-align: center;
    }


    .header-blogdetail h1 {
        position: relative;
        font-size: 32px;
        font-weight: 500;
        color: #062d55;
        margin-bottom: 10px;
        line-height: 1.4em;
        text-transform: capitalize;
        font-family: 'Heebo', sans-serif;
    }

    .header-blogdetail .bread-crumb-outer {
        position: relative;
        display: inline-block;
        padding: 0px 0px;
        font-family: 'Heebo', sans-serif;
    }

    .header-blogdetail .bread-crumb-outer .bread-crumb li {
        position: relative;
        float: left;
        margin-right: 30px;
        color: #ffffff;
        line-height: 24px;
    }

    .header-blogdetail .bread-crumb-outer .bread-crumb li a {
        color: #ffffff;
    }

    .header-blogdetail .bread-crumb-outer .bread-crumb li:first-child:after {
        content: '/';
        position: absolute;
        right: -22px;
        width: 10px;
        line-height: 24px;
        font-size: 14px;
        color: #ffffff;
    }

    .header-blogdetail .bread-crumb-outer .bread-crumb li.active {
        color: #fff;
    }

    .header-blogdetail .bread-crumb-outer .bread-crumb li:last-child {
        margin-right: 0px;
    }

    .clearfix, clearfix:after {
        clear: both;

    }

    .clearfix, clearfix:after {
        display: table;
        content: " ";
    }

    .news-style-one .lower-content .text p {
        position: relative;
        margin-bottom: 20px;
    }
</style>
