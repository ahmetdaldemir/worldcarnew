@extends('layouts.welcome')
@section('title'){{__('all_blogs')}} - @endsection

@section('content')
<section class="header-blogdetail" style="background-image: url('/storage/uploads/worldcarrental-blog.jpg')">
    <div class="container">{{--<?=$data['blogAllImage']?>--}}
        <div class="text-center">
            <h4>{{__('all_blogs')}}</h4>
        </div>
    </div>
</section>
<div class="col-md-12">
    <div class="auto-container" style="margin: 20px auto;">
        <div class="row">
            <?php  use App\Models\Image;foreach ($data["all_blogs"] as $item){ $image = Image::where('model','blogs')->where('model_id',$item->id)->first(); ?>
            <div class="col-md-3">
                <a href="blog/{{$item->slug}}/{{$item->id}}" class="card media-card">
                    <figure class="card-img-wrapper">
                        @if(!is_null($image))
                            <img src="{{asset('storage/webp/'.$image->title.'') }}" alt="{{$item->image_alt}}" title="{{$item->image_alt_title}}" class="img-fluid card-img center"  >
                        @endif
                    </figure>
                   <?php // Webp::make(asset('storage/'.$item->image.''))->save(asset('storage/'.$item->image.''), 90); ?>

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
figure.card-img-wrapper {margin: 0;}
.card-title {font-size: 125%;}
.card-img-overlay {padding: 10px;position: relative;text-align: right;display: block;}
a:hover .card-img-overlay {background:#fbfbfb;}
a:hover span.card-link {text-decoration: underline;}
figure.card-img-wrapper {text-align: center;border-bottom: 1px solid #e7e7e7;}
.card-img {max-width: 100%;text-align: center;}
.ucnokta {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 15px;
}
</style>
@endsection
