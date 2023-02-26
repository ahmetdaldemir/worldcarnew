@extends('layouts.welcome')

@section('content')

    <?php
    $language = $reservation->id_language;
    if($language == 1)
    {

        $textnew1 ="Rezervasyon Onay işleminiz tamamlanmış olup, Aracınız Rezervasyonunuzda belirttiğiniz Tarih ve Lokasyonda hazır olacaktır. ";
        $textnew2 ="Araç Teslimi ile ilgili bilgiler Rezervasyon PDF Voucher’unda mevcuttur.";
        $textnew3 ="Rezervasyona ilişkin tüm sorularınızı veya değişiklik taleplerinizi  info@worldcarrental.com  e-mail adresimize e-mail gönderebilirsiniz veya Ofis tel: +90 850 888 88 07 | Whatsapp :+90 532 736 88 07 numaralarımızdan ";
        $textnew4 ="Müşteri Hizmetlerimizi arayarak destek alabilirsiniz.Araç Kiralama Ihtiyacınızda Tercihiniz için Teşekkür eder. Güvenli ve Iyi yolculuklar dileriz";
        $textnew5 = "Rezervasyona ilişkin tüm sorularınızı info@worldcarrental.com  e-mail adresimize e-mail gönderebilirsiniz veya Ofis tel: +90 850 888 88 07 | Whatsapp :+90 532 736 88 07 ";

        $text1 = "Teşekkür Ederiz !";
        $text2 = "Rezervasyon voucher bilgilerinizi";
        $text3 = "buradan";
        $text4 = "indirebilirsiniz";
        $text5 = "Rezervasyonunuz ile ilgli sorunuz var ise";
        $text6 = " adresinden mail gönderebilirsiniz. Veya ";
        $text7 = " nolu telefondan ulaşabilirsiniz";
    }else if($language == 2)
    {
        $text1 = "Wir Danken Ihnen !";
        $text2 = "Ihre Reservierungsgutschein-Informationen";


        $textnew1 ="Ihr Reservierungsbestätigungsprozess ist abgeschlossen und Ihr Fahrzeug steht an dem Datum und Ort bereit.";
        $textnew2 ="den Sie in Ihrer Reservierung angegeben haben.Informationen zur Fahrzeuglieferung, finden Sie im Anhang in der PDF-Datei.";
        $textnew3 ="Bürotelefon: +90 850 888 88 07 anrufen und Sie können Unterstützung erhalten, indem Sie unseren Kundendienst auf WhatsApp anrufen: +90 532 736 88 07.";
        $textnew4 ="Vielen Dank, daß Sie uns gewählt haben für ihren Urlaubsmietwagen.Wir wünschen Ihnen eine sichere und gute Fahrt…";
        $textnew5 = "Sie können eine E-Mail an unsere E-Mail-Adresse info@worldcarrental.com für alle Ihre Reservierungsfragen oder Bürotelefon senden: +90 850 888 88 07 | WhatsApp: +90 532 736 88 07";

    }else if($language == 3)
    {
        $textnew1 ="Процесс подтверждения бронирования завершен, и ваш автомобиль будет готов в указанную дату и место.";
        $textnew2 ="Для доставки автомобиля вы можете найти информацию в файле PDF.";
        $textnew3 ="Если у вас есть какие-либо вопросы или изменения в бронировании, вы можете связаться с нашей службой поддержки клиентов +90 850 888 88 07 - WhatsApp: +90 532 736 88 07.
Спасибо, что выбрали нас для бронирования.";
        $textnew4 ="Желаем вам безопасного и приятного путешествия...";

        $textnew5 = "Вы можете отправить электронное письмо на наш адрес электронной почты info@worldcarrental.com по всем вопросам бронирования или по телефону офиса: +90 850 888 88 07 | WhatsApp: +90 532 736 88 07";

        $text1 = "мы благодарим Вас !";
        $text2 = "Информация о вашем ваучере бронирования";
    }else if($language == 4)
    {

        $textnew1 ="Your reservation confirmation process is complete and your vehicle will be ready on the Date and Location ";
        $textnew2 ="For vehicle delivery you can find information in the PDF file..";
        $textnew3 ="If you have any questions or change for your reservation you can contact  our Customer support  +90 850 888 88 07 - WhatsApp : +90 532 736 88 07.
Thank you for choosing us for your reservation.";
        $textnew4 ="We wish you a safe and pleasant journey...";
        $textnew5 = "You can send an e-mail to our info@worldcarrental.com e-mail address for all your reservation questions or Office tel: +90 850 888 88 07 | Whatsapp :+90 532 736 88 07";


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
    <?php if($status == 'success'){  ?>
    <section id="sp-ks8a8s" class="sp-el-section " style="width: 100%; max-width: 100%; padding: 10px;">
        <div id="sp-vw3kvy" class="sp-el-row sm:sp-flex sp-justify-between sp-w-full  sp-m-auto"
             style="padding: 0px; width: auto; max-width: 800px;    margin: 0 auto;">
            <div id="sp-fvrva7" class="sp-el-col sp-p-4  sp-w-full" style="width: calc(100% - 0px); padding: 10px;">
                <h2 id="sp-oqbene" class="sp-css-target" style="font-size: 40px; text-align: center; padding: 10px; margin-top: 0px;"><?=$text1?></h2>
                <div id="sp-dx6tkp" class="sp-css-target sp-text-wrapper" style="font-size: 20px; padding: 10px; margin-top: 0px; text-align: center;">
                    <p>{{__('Dear')}}  <b><?=$reservation->customer->fullname?></b></p>
                </div>
                <figure id="sp-cvxloc" class="sp-image-wrapper"  style="margin-top: 0px; padding: 10px; text-align: center;"><span><img style="width: 70px" src="{{asset('public/view/images/4812-8IDTHM6XtE3jkJZl.png')}}" alt="worldcar rezervasyon komfirmasyon sayfası"></span></figure>
                <h3 id="sp-o40lpg" class="sp-css-target" style="font-size: 30px; text-align: center; padding: 10px; margin-top: 0px;">{{__('do_comfirm')}}.</h3>
                <div id="tiny-vue_73519880121617369304601" class="sp-css-target sp-text-wrapper mce-content-body html4-captions" style="font-size: 16px; padding: 10px; margin-top: 0px; text-align: left; position: relative;">
                     <p>{{$textnew1}}</p>
                     <p>{{$textnew2}}</p>
                     <p>{{$textnew3}}</p>
                     <p>{{$textnew4}}</p>
                </div>
            </div>
        </div>
    </section>
    <?php }else{ ?>
    <section id="sp-ks8a8s" class="sp-el-section " style="width: 100%; max-width: 100%; padding: 10px;">
        <div id="sp-vw3kvy" class="sp-el-row sm:sp-flex sp-justify-between sp-w-full  sp-m-auto"
             style="padding: 0px; width: auto; max-width: 530px;    margin: 0 auto;">
            <div id="sp-fvrva7" class="sp-el-col sp-p-4  sp-w-full" style="width: calc(100% - 0px); padding: 10px;">
                <h2 id="sp-oqbene" class="sp-css-target" style="font-size: 40px; text-align: center; padding: 10px; margin-top: 0px;">{{__('Üzgünüz')}} !</h2>
                <div id="sp-dx6tkp" class="sp-css-target sp-text-wrapper" style="font-size: 20px; padding: 10px; margin-top: 0px; text-align: center;">
                    <p>{{__('Sayın')}}  <b><?=$reservation->customer->fullname?></b></p>
                </div>
                <figure id="sp-cvxloc" class="sp-image-wrapper"  style="margin-top: 0px; padding: 10px; text-align: center;"><span><img style="width: 70px" src="{{asset('public/view/images/4812-8IDTHM6XtE3jkJZl.png')}}" alt="worldcar rezervasyon komfirmasyon sayfası"></span></figure>
                <h3 id="sp-o40lpg" class="sp-css-target" style="font-size: 30px; text-align: center; padding: 10px; margin-top: 0px;">{{__($message)}}</h3>
                <div id="tiny-vue_73519880121617369304601"
                     class="sp-css-target sp-text-wrapper mce-content-body html4-captions"
                     style="font-size: 16px; padding: 10px; margin-top: 0px; text-align: center; position: relative;">
                    {{$textnew5}}
                </div>
            </div>
        </div>
    </section>
    <?php } ?>


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
