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

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row ">
                <div style="width: 1172px;margin:0 auto">
                    <table width="100%" style="border:1px solid #f1f1f1;background-color:#ffffff">
                        <tbody>
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" width="100%" height="80px"
                                       style="background-color:#002655">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div style="color: #fff;font-size: 40px;font-weight: 500;" align="center">
                                                {{__('REZERVASYON BİLGİLERİ')}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" style="border:1px solid #f1f1f1">
                                    <tbody>
                                    <tr>
                                        <td width="15%"
                                            style="vertical-align:top;padding:10px 10px 10px 10px;border-right:1px solid #f1f1f1">
                                            <img src="https://ci5.googleusercontent.com/proxy/SJ1dtSh0HfHoBDV0rpC33ED4vSz7FS0_n3OvXMdgj-kyrMPST0XCW5Bt9fieKP3qveYcetTysMQYId19wbo7jeXPt3rxuOk=s0-d-e1-ft#http://www.worldcarrental.com/images/cars/100094.jpg"
                                                width="100" height="70" class="CToWUd"></td>
                                        <td width="50%"
                                            style="vertical-align:middle;padding:10px 10px 10px 10px;border-right:1px solid #f1f1f1;color:#002655">
                                            <b><?=$reservation['car']?></b> Dizel
                                        </td>
                                        <td width="35%" style="vertical-align:top;padding:10px 10px 10px 10px">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td style="color:#002655">
                                                        <b><u>KİŞİSEL BİLGİLER</u></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b><?=$reservation['customerInfo']->firstname ?? "Bulunamadı"?> <?=$reservation['customerInfo']->lastname ?? "Bulunamadı"?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Musteri ID :</b>
                                                        MU<?=$reservation['customerInfo']->id ?? "Bulunamadı"?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Geldiginiz Ulke :</b> <?=$reservation['nationality']?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Cep Telefon
                                                            :</b> <?=$reservation['customerInfo']->phone ?? "Bulunamadı"?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Email :</b> <a
                                                            href="mailto:<?=$reservation['customerInfo']->email ?? 0 ?>"
                                                            target="_blank"><?=$reservation['customerInfo']->email ?? "Bulunamadı"?></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table width="100%" style="border:1px solid #f1f1f1">
                                    <tbody>
                                    <tr>
                                        <td width="50%" style="color:#002655">
                                            <div
                                                style="color:#002655;font-size:14px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px">
                                                <b><u>REZERVASYON DETAYLARI<u></u></u></b></div>
                                        </td>
                                        <td width="25%" style="color:#002655">
                                            <div
                                                style="color:#002655;font-size:12px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px">
                                                <b>PNR No :</b> <?=$reservation['pnrNo']?>
                                            </div>
                                        </td>
                                        <td width="25%" style="color:#002655">
                                            <div style="color:#002655;font-size:12px;padding:10px 10px 10px 10px"><b>Toplam
                                                    Kiralama
                                                    Suresi
{{--                                                    :</b> <?=$reservation['reservationInformation']->days ?? "Bulunamadı"?>--}}
                                                gun
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table width="100%" style="border:1px solid #f1f1f1">
                                    <tbody>
                                    <tr>

                                        <td style="color:#002655">
                                            <table width="100%" style="border-right:1px solid #f1f1f1">

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:13px;padding-left:10px">
                                                            <b><u>Alis Bilgileri</u></b></div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
{{--                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Tarih--}}
{{--                                                                / Saat--}}
{{--                                                                : </b> <?=$reservation['reservationInformation']->checkin ?? "Bulunamadı"?>--}}
{{--                                                            / <?=$reservation['reservationInformation']->checkin_time ?? "Bulunamadı"?>--}}
{{--                                                        </div>--}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
{{--                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Alış--}}
{{--                                                                Yeri--}}
{{--                                                                : </b> <?=$reservation['reservationInformation']->up_location ?? ''?>--}}
{{--                                                            - Alanya Otel Teslimi--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Geliş
                                                                Uçuş
                                                                Bilgileri / Otel Bilgileri : </b>Oz hotels incekum beach
                                                            resort. Incekum
                                                            Mevkii, yeni cami Karsisi, 07470 Alanya,
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </td>

                                        <td style="color:#002655">
                                            <table>

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:13px;padding-left:10px">
                                                            <b><u>Donus
                                                                    Bilgileri</u></b></div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
{{--                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Tarih--}}
{{--                                                                / Saat--}}
{{--                                                                : </b> <?=$reservation['reservationInformation']->checkout ?? ''?>--}}
{{--                                                            / <?=$reservation['reservationInformation']->checkout_time ?? ''?>--}}
{{--                                                        </div>--}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
{{--                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Dönüş--}}
{{--                                                                Yeri--}}
{{--                                                                : </b> <?=$reservation['reservationInformation']->drop_location ?? ''?>--}}
{{--                                                            - Antalya Havalimani Dis Hatlar--}}
{{--                                                        </div>--}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Dönüş
                                                                Uçuş
                                                                Bilgileri / Otel Bilgileri : </b>Antalya havalimani dis
                                                            hatlari,
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </td>

                                    </tr>
                                    </tbody>
                                </table>


                                <table width="100%" style="border:1px solid #f1f1f1">
                                    <tbody>
                                    <tr>


                                        <td style="padding-top:10px;padding-bottom:10px">
                                            <table width="100%" style="border-left:1px solid #f1f1f1">

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b>Ektralar</b>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php if(isset($reservation['reservationEkstra'])){ ?>
                                                    <?php foreach ($reservation['reservationEkstra'] as $ekstra){ ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?=$ekstra->day?></td>
                                                            <td><?=$ekstra->price?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td style="padding-top:10px;padding-bottom:10px">
                                            <table width="100%" style="border-left:1px solid #f1f1f1">

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b>Fiyata Dahil Hizmetler</b></div>
                                                    </td>
                                                </tr>
                                                <tr><td>Full Kasko</td> </tr>
                                                     <tr><td>Cam Lastik Far Sigortası</td> </tr>
                                                     <tr><td>Hırsızlık Sigortası</td> </tr>
                                                     <tr><td>7/24 Havalimanı Teslimi</td> </tr>
                                                     <tr><td>KDV Dahil</td> </tr>
                                                     <tr><td>7/24 Yol Hizmeti</td> </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td style="vertical-align:top;padding-top:10px;padding-bottom:10px">
                                            <table width="100%" style="border-left:1px solid #f1f1f1">

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b>Ödeme
                                                                Bilgileri</b></div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Ödeme
                                                                Şekli :</b> Arac Tesliminde Nakit Odeme
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Gunluk
                                                                Ucret :</b> 384 TL
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Kiralama
                                                                Ucreti :</b> 1,153 TL
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Ekstralar
                                                                :</b> 0 TL
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Yol
                                                                Masrafi :</b> 404 TL
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div
                                                            style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px">
                                                            <b>Genel
                                                                Toplam : 1557 TL</b></div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>


                                <font color="#888888">
                                </font><font color="#888888">
                                </font>
                                <table width="100%" style="border:1px solid #f1f1f1">
                                    <tbody>
                                    <tr>
                                        <td style="color:#002655;font-size:12px;padding-left:10px;padding-top:10px">
                                            <b>Lütfen Bilgileri Okuyunuz</b><br><br>
                                            <b>Arac teslimatiniz veya Havalimaninda karsilanmaniz;</b> Arac Havalimani
                                            teslim
                                            rezervasyon yapilmis ise WorldCar Rental Personeli Rezervasyonunuzda
                                            belirtmis oldugunuz
                                            Havaalanı terminalin yolcu cikis kapisinda isminizin yazili oldugu bir
                                            Tabela ile sizi
                                            karsilayacaktır Arac Otel teslimi Rezervasyon yapilmis ise Lütfen
                                            Resepsiyonda hazir
                                            bulununuz
                                            .<br><br>
                                            * Arac teslim zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi
                                            durumunda 7/24
                                            asagidaki iletisim numaralarimizdan yardim isteyebilirsiniz.<br><br>
                                            * Arac tesliminde WorldCar Rental a ait kiralama kontrati karsilikli olarak
                                            imzalanir.Kiralama kontrati olmadan Arac teslimi edilmez.<br><br>
                                            * Ödemenizi arac teslimi esnasinda Rezervasyonunuzda belirttiginiz ödeme
                                            sekli ile
                                            yapabilirsiniz.Ödeme yapilmadan Arac teslim edilmez.<font
                                                color="#888888"><br><br>
                                            </font></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <font color="#888888">

                                    <table cellpadding="0" cellspacing="0" width="100%" height="50px"
                                           style="background-color:#002655;color:#fdf7ac;font-size:14px">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="padding-top:10px;padding-bottom:10px">
                                                WORLD CAR RENTAL<br>
                                                +90 850 888 88 07 - +90 532 736 88 07<br>
                                                <a href="mailto:info@worldcarrental.com" target="_blank">info@worldcarrental.com</a>
                                                -
                                                <a href="http://www.worldcarrental.com" target="_blank"
                                                   data-saferedirecturl="https://www.google.com/url?q=http://www.worldcarrental.com&amp;source=gmail&amp;ust=1624863182637000&amp;usg=AFQjCNGCp8YylKHnasFfc56W9GV1wGxEvg">www.worldcarrental.com</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </font></td>
                        </tr>
                        </tbody>
                    </table>
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
            padding: 30px 0px 0px;
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
            width: 100%;
            border-radius: 3px;
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
        background: url(https://worldcarrental.com/public/view/images/background/f2323f32f23f23f2.png) no-repeat #05070c8c 73% 80%;
        position: relative;
        padding: 104px 0px 00px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        text-align: center;
    }

    .header-blogdetail:before {
        content: '';
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        position: absolute;
        background: rgba(0, 0, 0, 0.80);
    }

    .header-blogdetail h1 {
        position: relative;
        font-size: 32px;
        font-weight: 500;
        color: #ffffff;
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

