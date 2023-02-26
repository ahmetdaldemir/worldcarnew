@extends('layouts.welcome')
@section('title'){{__('contact')}} - @endsection

@section('content')
<section class="header-blogdetail" style="background-image: url({{asset('/storage/uploads/<?=$data["contactImage"]?>')}})">
    <div class="container">
        <div class="text-center">
            <h4>{{__('contact')}}</h4>
        </div>
    </div>
</section>
<div class="auto-container margin_60">
    <div class="row">
        <div class="col-md-8 col-sm-8 box_style_1">
            <div class="form_title">
                <h6 style="color: #002a68;"><strong><i class="icon-pencil"></i></strong>{{ __('contact_form') }}</h6>
                <p>
                    <br>{{ __('contact_text') }}<br>
                </p>
            </div>
            <div class="form_title">
                @if($errors->any())
                    <div class="alert alert-primary" role="alert">
                        {{$errors->first()}}
                    </div>
                 @endif
            </div>

            <div class="step">
                <form method="post" action="/mail-send">
                    @csrf
                <div id="message-contact"></div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>{{ __('adiniz') }}</label>
                            <input type="text" class="form-control" name="firstname" value="" placeholder="{{ __('adiniz') }}" required="" style="width: 95%;    float: left;">
                            @error('firstname')
                            <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 3;">
                               <strong>*</strong>
                             </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>{{ __('soyadiniz') }}</label>
                            <input type="text" class="form-control" name="lastname" value="" placeholder="{{ __('soyadiniz') }}" required="" style="width: 95%;    float: left;">
                            @error('lastname')
                            <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 3;">
                               <strong>*</strong>
                             </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>{{ __('E-Mail Address') }}</label>
                            <input type="email" name="email"   value="" class="form-control" placeholder="{{ __('please_mail') }}"  style="width: 95%;    float: left;">
                            @error('email')
                             <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 3;">
                               <strong>*</strong>
                             </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>{{ __('mobile') }}</label>
                            <input type="text" name="phone" value="" class="form-control" placeholder="{{ __('please_mobile') }}" required=""  style="width: 95%;    float: left;">
                            @error('phone')
                            <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 3;">
                               <strong>*</strong>
                             </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('message') }}</label>
                            <textarea rows="5" name="message" class="form-control" placeholder="{{ __('please_message') }}" style="height:200px;"></textarea>
                            @error('message')
                            <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 3;">
                               <strong>*</strong>
                             </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                            <div style="float: left;line-height: 5;" class="form-group g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"> </div>
                        @endif
                        @error('g-recaptcha-response')
                        <span role="alert" style="float: right;font-weight: 900; color: #f00;line-height: 5;">
                           <strong>*</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <button style="    font-size: 18px;
    padding: 5px;
    font-weight: 600;    float: right;    width: 50%;" type="submit" class="bnt btn-success" >{{ __('gonder') }}</button>
                    </div>
                </div>
                </form>
            </div>
            <div id="map_wrapper" style="margin: 30px 0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25521.531827410712!2d30.78335553955078!3d36.909686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14c384791cdbbb27%3A0xa1bcd82155abd285!2sWorld%20Car%20Rental%20%7C%20Antalya%20Airport%20%7C%20Alanya%20%7C%20Gazipasa%20Havalimani%20%7C%20Rent%20A%20Car%20I%20Arac%20Kiralama!5e0!3m2!1str!2str!4v1623359315646!5m2!1str!2str" style="width:100%;border: none" height="375" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
             </div>
        </div>
        <!-- End col-md-8 -->
        <div class="col-md-4 col-sm-4">
            <div class="box_style_1" style="height: 1060px;">
                <span class="tape"></span>
                <h6 style="color: #002a68;"><i class="fas fa-map-marker-alt"></i> {{ __('ofis_1') }} <span><i class="icon-location pull-right"></i></span></h5>
                <p>
                    Saray Mah.Atatürk Bulvari. Denizolgun Ishanı<br>A Blok No:120 - Antalya Alanya 07410.						</p>
                <hr>

                <h6 style="color: #002a68;"><i class="fas fa-map-marker-alt"></i> {{ __('ofis_2') }} <span><i class="icon-location pull-right"></i></span></h6>
                <p>
                    Excursion Travel Agency<br>
                    Saray Mah. Atatürk Bulvari Alaattinoglu Apt
                    No:66/B Antalya Alanya 07410
                </p>
                <hr>

                <h6 style="color: #002a68;"><i class="fas fa-plane-departure"></i> {{ __('ofis_3') }} <span><i class="icon-flight pull-right"></i></span></h6>
                <p>
                    Antalya Havalimanı Yolu Güzelyurt Mah. Lara Cad No:218  Aksu-Antalya
                </p>
                <hr>

                <h6 style="color: #002a68;"><i class="fas fa-plane-departure"></i> {{ __('ofis_4') }} <span><i class="icon-flight pull-right"></i></span></h6>
                <p>
                    Antalya Alanya Gazipasa Havalimanı Yolu No:212 Alanya Gazipasa
                </p>
                <hr>

                <h6 style="color: #002a68;"><i class="fas fa-phone-volume"></i> {{ __('ofis_call') }} <span><i class="icon-help pull-right"></i></span></h6>
                <p>
                    {{ __('ofis_call_text') }}<br><br>
                </p>
                <div style="text-align: left; margin: 20px 0;  text-align: center;">
                    <i style="  font-size: 30px;  color: #002a68;" class="fas fa-headset"></i>
                    <h5 style="    color: #002a68;">{{ __('help_ccenter') }}</h5>
                    <div style="    text-align: left;      margin: 20px 0 80px 0;text-align: left;">
                    <a href="tel://00908508888807" class="phone" style="font-weight: 600;font-size: 17px;color: #002a68;"><i class="fas fa-phone-volume"></i>  +90 850 888 88 07</a><br>
                    <a href="tel://00908508888807" class="phone" style="font-weight: 600;font-size: 17px;color: #002a68;"><i class="fab fa-whatsapp"></i>  +90 532 736 88 07</a><br>
                    <a href="mail:info@worldcarrental.com" class="phone" style="font-weight: 600;font-size: 17px;color: #002a68;"><i class="fas fa-envelope-open-text"></i>  info@worldcarrental.com</a><br>
                    </div>
                        <small style=" font-weight: 600;   font-size: 18px;">{{ __('help_text') }}</small>
                </div>

            </div>

        </div>
        <!-- End col-md-4 -->
    </div>
    <!-- End row -->
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
    ul#contact-info{
        margin: 0;
    }
    ul#contact-info li{
        list-style: none;
    }
    .box_style_1 {
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border: 1px solid #ddd;
        margin-bottom: 25px;
        padding: 30px 30px 0 30px;
        position: relative;
        color: #666;
    }
    .tape {
        position: absolute;
        left: 0;
        top: -20px;
        height: 45px;
        width: 100%;
        background: url(../img/tape.png) no-repeat center top;
        display: block;
    }
    .box_style_4, .box_style_2 {
        background: #fff;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin-bottom: 15px;
        padding: 20px;
        position: relative;
        text-align: center;
        border: 1px solid #ddd;
    }
    .box_style_4:before {
        border-bottom: 10px solid #ccc;
        margin-bottom: 0;
    }
    .box_style_4:after, .box_style_4:before {
        content: "";
        position: absolute;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        bottom: 100%;
        left: 50%;
        margin-left: -10px;
    }
    .box_style_2 i, .box_style_4 i {
        font-size: 52px;
        margin-top: 10px;
        display: inline-block;
    }
    .box_style_2 a.phone, .box_style_4 a.phone {
        font-size: 22px;
        display: block;
        margin-bottom: 20px;
        font-weight: 700;
        color: #000;
    }
</style>
@endsection
