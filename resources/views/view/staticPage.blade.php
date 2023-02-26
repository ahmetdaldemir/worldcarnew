@extends('layouts.welcome')

@section('content')
<section class="header-blogdetail">
    <div class="container">
        <div class="text-center">
            <h4>{{$data["text"]->title}}</h4>
        </div>
    </div>
</section>
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row ">
                <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <section class="col-12 news-section">
                        <div class="news-style-one">
                            <div class="inner-box">
                                <div class="lower-content">
                                    <div class="text text-content">
                                        {!! $data["text"]->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padd-left-40">
                    <aside class="sidebar">
                        <div class="sidebar-widget popular-posts">
                            <div class="widget-box">
                                <?php foreach ($data['category'] as $item){ ?>
                                <a href="/{{app()->getLocale()}}/{{__('kurumsal_url')}}/{{$item->slug}}">
                                    <article class="post">
                                        <figure class="post-thumb"><img src="{{asset('storage'.$item->file.'')}}" alt="{{$item->title}}"></figure>
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

    <style>
        .blog-card-list .blog-card + .blog-card {
            margin-top: 40px;
        }

        .sidebar-page-container {
            position: relative;
            padding: 0px;background: #F5F5F5
        }

        .sidebar-page-container .sidebar, .sidebar-page-container .content-side {
            margin-bottom: 30px !important;
        }

        .no-padding {
            padding: 0px;
        }

        .news-section {
            position: relative;
        }

        .news-style-one {
            position: relative;
            margin-bottom: 50px;
        }

        .news-style-one .inner-box {
            position: relative;
            display: block;
        }

        .news-style-one .image-box {
            position: relative;
            display: block;
            float: left;
            margin-right: 20px;
            width: 50%;
            margin-bottom: 20px;
        }

        .news-style-one .image-box img {
            position: relative;
            display: block;
            width: 54%;
            border-radius: 3px;
            float: left;
            margin-right: 12px;
        }

        .news-style-one .date-box {
            position: absolute;
            left: 20px;
            bottom: 20px;
            width: 50px;
            text-align: center;
            color: #ffffff;
            font-family: 'Heebo', sans-serif;
            background: #18ba60;
        }

        .news-style-one .date-box .day {
            display: block;
            font-size: 20px;
            font-weight: 700;
            line-height: 30px;
        }

        .news-style-one .date-box .month {
            display: block;
            font-size: 13px;
            font-weight: 500;
            line-height: 20px;
            background: #062d55;
        }

        .sidebar-page-container .sidebar, .sidebar-page-container .content-side {
            margin-bottom: 30px !important;
        }

        .sidebar .sidebar-widget {
            position: relative;
            margin-bottom: 40px;
        }

        .sidebar .sidebar-widget .widget-box {
            position: relative;
            padding: 25px 25px;
            border: 1px solid rgba(0, 0, 0, 0.10);
            border-radius: 3px;
        }

        .sidebar-title {
            position: relative;
            margin-bottom: 20px;
        }

        .sidebar-title h3 {
            position: relative;
            line-height: 1.3em;
            font-size: 18px;
            color: #222222;
            font-weight: 500;
            text-transform: capitalize;
        }

        .sidebar .list {
            position: relative;
        }

        .sidebar .list li {
            position: relative;
            line-height: 24px;
            margin-bottom: 10px;
        }

        .sidebar .list li a {
            position: relative;
            display: block;
            color: #777777;
            font-size: 14px;
            font-weight: 400;
            line-height: 24px;
            padding: 0px;
        }

        .pull-left {
            float: left !important;
        }

        .pull-right {
            float: right !important;
        }

        .sidebar .popular-posts .post {
            position: relative;
            font-size: 14px;
            color: #cccccc;
            padding: 0px 0px;
            padding-left: 80px;
            min-height: 60px;
            margin-bottom: 20px;
        }

        .sidebar .popular-posts .post .post-thumb {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 65px;
            border-radius: 3px;
            background: #333333;
        }

        .sidebar .popular-posts .post a, .sidebar .popular-posts .post a:hover {
            color: #18ba60;
        }

        .sidebar .popular-posts .post .post-thumb img {
            display: block;
            width: 100%;
            border-radius: 3px;
        }

        .sidebar .popular-posts .post h4 {
            font-size: 14px;
            margin: 0px;
            font-weight: 400;
            line-height: 20px;
            color: #222222;
        }

        .sidebar .popular-posts .post h4 a {
            color: #222222;
        }

        .sidebar .popular-posts .post-info {
            font-size: 13px;
            color: #18ba60;
        }

        .news-style-one .lower-content h3 {
            position: relative;
            font-size: 20px;
            color: #222222;
            font-weight: 500;
            margin-bottom: 5px;
        }
    </style>
@endsection

<style>
    .header-blogdetail {
        background: url(https://worldcarrental.com/public/view/images/background/blog.jpg) no-repeat #05070c8c 73% 80%;
        position: relative;
        padding: 104px 0px 00px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        text-align: center;
    }

    .header-blogdetail h4 {
        position: relative;
        font-size: 32px;
        font-weight: 500;
        color: #062d55;
        margin-bottom: 10px;
        line-height: 3.4em;
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

