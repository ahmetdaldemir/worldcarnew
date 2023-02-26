<a href="/{{app()->getLocale()}}/{{__("campain_url")}}/{{$val["slug"]}}/{{$val["id"]}}" class="vehicle-card ecw-slider__item col-lg-3 col-md-4 col-sm-6 col-xs-12">
<h3 class="ecw-title vehicle-card__title ecw-title--weight-bold ecw-title--color-standard-1">Fiat Egea</h3>
    <p class="ecw-text vehicle-card__description ecw-text--size-s ecw-text--weight-inherit ecw-text--color-standard-3">
        These range from compact and fuel-efficient city to eco-friendly model</p>
    <div class="vehicle-card__image-link">
        <div class="ecw-button vehicle-card__link ecw-button--size-medium ecw-button--variant-link"><span
                    class="ecw-text hover-underline ecw-text--size-s ecw-text--weight-bold ecw-text--color-highlight-3">See more</span>
        </div>
        <div class="vehicle-card__image"><img
                    data-src="{{asset("public/view/upload/site/vehicle/".$val["car_image"]."")}}"
                    src="{{asset("public/view/upload/site/vehicle/".$val["car_image"]."")}}"
                    alt="vehicle-type-car" class="ecw-image ls-is-cached lazyloaded"></div>
    </div>
</a>


<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  ">
    <div class="blog-item">
        <div class="blog-thumb">
            <a href="/{{app()->getLocale()}}/{{__("campain_url")}}/{{$val["slug"]}}/{{$val["id"]}}"
            class="card media-card">
            <img src="{{asset("public/view/images/background/bos_tasarim.jpeg")}}"
            alt="Alanya araç kiralama">
            </a>
        </div>
        <div style="      color: #ffffff;
    font-size: 18px;
    position: absolute;
    top: 68px;
    right: 163px;
    font-weight: 800;
    height: 80px;
    line-height: 3;
    width: 79px;
    text-align: center;
 ">10%
        </div>
        <div style="top: 37px;
    left: 113px;
    position: absolute;
    font-size: 15p;
    text-align: center;
    border-radius: 50px;">
            <div style="    color: #fff;
    font-size: 24px;
    font-weight: 600;">Fiat Egea
            </div>
            <div style="color: #fff;
    font-size: 27px;
    font-weight: 600;
    top: 2px;
    left: 105px;
    width: 100px;
    position: absolute;">{{$val["price"]}} €
            </div>
        </div>
        <div style="   text-align: right;
    color: #ffffff;
    font-size: 34px;
    position: absolute;
    top: 0;
    left: 34px;
    font-weight: 800;
    top: 94px;
    width: 85%;"><img style="width: 100%" src="{{asset("public/view/upload/site/vehicle/".$val["car_image"]."")}}"/>
        </div>
    </div>
</div>