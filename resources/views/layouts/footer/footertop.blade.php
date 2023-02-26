
<section class="footers position-relative">
    <div class="auto-container">
        <div class="col-12">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="footers-logo"><img src="{{url('storage/'.$data['static']["logo"].'') }}" title="{{__('footer_logo_title')}}" alt="{{__('footer_logo_alt')}}" style="    width: 200px;"></div>
                    <div class="footers-info mt-3"><p>{{__('footer_value')}}</p></div>
                    <h5>{{__('newsletter')}}</h5>
                    <form id="newsletter_form" action="#">
                        <div class="form-group">
                            <input type="email" name="email" id="newsletter_input" class="form-control position-relative newspaper-input" placeholder="{{__('abonetext')}}" required/>
                            <button type="submit" id="newsletter_btn" style="background-color: #102a70; border-color: #102a70;" class="btn btn-primary position-absolute newspaper-btn">{{__('abone')}}</i> </button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-6">
                    <h5>{{__('services')}} </h5>
                    <ul class="list-unstyled">
                        @foreach($data["static"]["services"] as $itemd)
                            <li><a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}" title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-6">
                    <h5>{{__('informations')}} </h5>
                    <ul class="list-unstyled">
                        @foreach($data["static"]["terms"] as $itemd)
                            <li>
                                <a href="/{{app()->getLocale()}}/{{__('car_rental_articles')}}/{{$itemd->slug}}/{{$itemd->id}}"
                                   title="{{$itemd->title}}">{{$itemd->title}}</a></li>
                        @endforeach
                        <li><a href="/{{app()->getLocale()}}/{{__('contact_url')}}"
                               title="{{__('contact')}}">{{__('contact')}}</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <h5>{{__('footer_contact')}} </h5>
                    <ul class="list-unstyled">
                        <li><a href="#" title="Rent A Car"><i class="fa fa-map-marker mr-2"></i> {{$data['static']["address1"]}}</a></li>
                        <li><a href="tel:{{$data['static']["850"]}}" title="Rent A Car"><i class="fa fa-mobile mr-2"></i>{{$data['static']["850"]}}</a></li>
                        <li><a href="https://api.whatsapp.com/send?phone={{$data['static']["phone1"]}}&text={{__('whatsapptext')}}" title="{{__('rentacar')}}"><i class="fa fa-whatsapp mr-2"></i>{{$data['static']["phone1"]}}</a></li>
                        <li><a href="mailto:{{$data['static']["email"]}}" title="{{__('rentacar')}}"><i class="fa fa-envelope mr-2"></i>{{$data['static']["email"]}}</a></li>
                    </ul>
                    <div class="social-icons">
                        <a title="World Facebook" target="_blank" rel="nofollow" href="https://www.facebook.com/worldcarrentals/" data-toggle="tooltip" data-original-title="World Facebook" rel="nofollow" style="background-color:#3b5998 !important;">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a title="World Instagram" target="_blank" rel="nofollow" href="https://www.instagram.com/worldcarrentals" data-toggle="tooltip" rel="nofollow" data-original-title="World Instagram" style="background-color:#c32aa3 !important;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a title="World Car Youttube" target="_blank" rel="nofollow" href="https://www.youtube.com/channel/UCgRjflgcjAwdFol1RHaNHhQ" data-toggle="tooltip" rel="nofollow" data-original-title="World Youtube" style="background-color:#f21d1d  !important;">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @include('layouts.footer.footertab')
</section>
