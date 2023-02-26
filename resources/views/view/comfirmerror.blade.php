@extends('layouts.welcome')

@section('content')

    <?php
    $language = 1;
    if($language == 1)
    {
        $textnew5 = "Sorun oluştu info@worldcarrental.com  e-mail adresimize e-mail gönderebilirsiniz veya Ofis tel: +90 850 888 88 07 | Whatsapp :+90 532 736 88 07 ";

        $text1 = "Teşekkür Ederiz !";
        $text2 = "Rezervasyon voucher bilgilerinizi";

    }else if($language == 2)
    {
        $text1 = "Wir Danken Ihnen !";
        $text2 = "Ihre Reservierungsgutschein-Informationen";
       $textnew5 = "Problem aufgetreten E-Mail an unsere E-Mail-Adresse info@worldcarrental.com für alle Ihre Reservierungsfragen oder Bürotelefon senden: +90 850 888 88 07 | WhatsApp: +90 532 736 88 07";

    }else if($language == 3)
    {

        $textnew5 = "Возникла проблема электронное письмо на наш адрес электронной почты info@worldcarrental.com по всем вопросам бронирования или по телефону офиса: +90 850 888 88 07 | WhatsApp: +90 532 736 88 07";

        $text1 = "мы благодарим Вас !";
        $text2 = "Информация о вашем ваучере бронирования";
    }else if($language == 4)
    {

        $textnew5 = "Problem occurred send an e-mail to our info@worldcarrental.com e-mail address for all your reservation questions or Office tel: +90 850 888 88 07 | Whatsapp :+90 532 736 88 07";


        $text1 = "We Thank You !";
        $text2 = "Your reservation voucher information !";
    }



    ?>

    <section class="header-blogdetail">
        <div class="container" style="    height: 200px;">
            <div class=" pb-3  pr-2 pl-2">
                <div class="text-center mb-3">
                    <h1>{{__('reservation')}}</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="sp-ks8a8s" class="sp-el-section " style="width: 100%; max-width: 100%; padding: 10px;">
        <div id="sp-vw3kvy" class="sp-el-row sm:sp-flex sp-justify-between sp-w-full  sp-m-auto"
             style="padding: 0px; width: auto; max-width: 530px;    margin: 0 auto;">
            <div id="sp-fvrva7" class="sp-el-col sp-p-4  sp-w-full" style="width: calc(100% - 0px); padding: 10px;">
                <h2 id="sp-oqbene" class="sp-css-target" style="font-size: 40px; text-align: center; padding: 10px; margin-top: 0px;">{{__('Üzgünüz')}} !</h2>
                <div id="sp-dx6tkp" class="sp-css-target sp-text-wrapper" style="font-size: 20px; padding: 10px; margin-top: 0px; text-align: center;">
                    <p>{{__('Dear')}}  <b>Misafirimiz</b></p>
                </div>
                <figure id="sp-cvxloc" class="sp-image-wrapper"  style="margin-top: 0px; padding: 10px; text-align: center;"><span><img style="width: 70px" src="{{asset('public/view/images/4812-8IDTHM6XtE3jkJZl.png')}}" alt="worldcar rezervasyon komfirmasyon sayfası"></span></figure>
                <div id="tiny-vue_73519880121617369304601"
                     class="sp-css-target sp-text-wrapper mce-content-body html4-captions"
                     style="font-size: 16px; padding: 10px; margin-top: 0px; text-align: center; position: relative;">
                    {{$textnew5}}
                </div>
            </div>
        </div>
    </section>


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
</style>
