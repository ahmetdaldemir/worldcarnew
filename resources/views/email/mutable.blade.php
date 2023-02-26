<?php
use App\Models\Ekstra;
?>
<strong>Sayin <span style="font-size: 25px"><?=$reservation->customer->fullname?></span>;</strong>
<br>
<br>
<strong style="color: red">ÖNEMLI NOT: REZERVASYONUNUZUN gecerli olmasi icin asagidaki Rezervasyon bilgilerinizi kontrol edip REZERVASYON ONAYINIZ ICIN LÜTFEN BU LINKE TIKLAYINIZ.</strong>
<br>
<br>
Rezervasyon talebiniz tarafimizdan incelenmistir ve kiralama icin konfirme edilmistir.
<br>
<br>
<strong>Not:Lutfen Bilgileri Okuyunuz.</strong>
<ul>
       <li> Karsilanmaniz veya Arac Teslimatiniz Arac Havalimaninda teslimi ile Rezervasyon yapilmis ise World Car Rental Personeli Rezervasyonunuzda belirtmis oldugunuz Havaalani Terminalinin Gelen yolcu Cikis kapisinda Isminizin yazili oldugu bir Tabela ile sizi karsilayacaktir.</li>
       <li> Arac Otel teslimi yapilmissa Bazi Hotel lerde Guvenlik nedeniyle Hotel e disaridan kisi veya Personel iceriye almamaktadirlar bu sebebden dolayi Lutfen Hotel disarisinda bulunan Giris Güvenlik kapisi yaninda Rezervasyonunuzda belirttiginiz Saatta hazir olunuz.</li>
       <li> Rezervasyonunuz Adres teslimi ise Personelimiz Arac Tesliminizi verdiginiz Adreste yapacaktir.</li>
       <li> Arac Teslim ve alma zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi durumunda 7/24 asagidaki iletisim numalarimizdan yardim isteyebilirsiniz.</li>
       <li> Araç tesliminde World Car Rental a ait kiralama kontrati karsilikli olarak imzalanir.</li>
       <li> Ödemenizi Arac teslim esnasinda Rezervasyonunuzda belirttiginiz ödeme sekli ile yapabilirsiniz. Odeme yapilmadan Arac teslim edilmez. </li>
</ul>
<strong>Saygilarimizla</strong>

<strong>World Car Rental</strong>
<br>
Murat Güler<br>
+90 242 511 66 64 Ofis (7/24)<br>
+90(532)715 73 89 Mobil Ofis<br>
info@worldrentalanya.com MSN&Mail<br>
<a href=http://www.worldrentalanya.com/ target=_blank>http://www.worldrentalanya.com</a>
<html>
<body>
<div style="width: 1172px;margin:0 auto">
    <table width="100%" style="border:1px solid #f1f1f1;background-color:#ffffff">
        <tbody>
        <tr>
            <td>

                <table cellpadding="0" cellspacing="0" width="100%" height="80px" style="background-color:#002655">
                    <tbody>
                    <tr>
                        <td>
                            <div align="center">
                                <img
                                    src="https://ci5.googleusercontent.com/proxy/BiGdKJiY8kR3hSAV1NCYBKqASprQSIu8eIsMiT8p8dVG23CUf5yol6kbcPH-x77sOYykrDaCcVbLJaEzJg=s0-d-e1-ft#http://www.worldcarrental.com/img/logo.png"
                                    width="360" height="50" class="CToWUd"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" style="border:1px solid #f1f1f1">
                    <tbody>
                    <tr>
                        <td width="15%"
                            style="vertical-align:top;padding:10px 10px 10px 10px;border-right:1px solid #f1f1f1"><img
                                src="{{ asset('storage/uploads/') }}/<?=$car['image']?>" width="100"
                                height="70" class="CToWUd"></td>
                        <td width="50%"
                            style="vertical-align:middle;padding:10px 10px 10px 10px;border-right:1px solid #f1f1f1;color:#002655">
                            <b><?=$car['name']?></b> <?=$car['fuel']?></td>
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
                                        <b><?=$fullname?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Musteri ID :</b> <?=$customer_id?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Geldiginiz Ulke :</b> <?=$nationality?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Cep Telefon :</b> <?=$phone?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Email :</b> <a href="mailto:<?=$email?>" target="_blank"><?=$email?></a>
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
                                <b>PNR No :</b> <?=$pnr?></div>
                        </td>
                        <td width="25%" style="color:#002655">
                            <div style="color:#002655;font-size:12px;padding:10px 10px 10px 10px"><b>Toplam Kiralama
                                    Suresi :</b> <?=$reservationInfo->days?> gun
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
                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b><u>Alis
                                                    Bilgileri</u></b></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Tarih / Saat
                                                : </b><?=$reservationInfo->checkin?>
                                            / <?=$reservationInfo->checkin_time?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Alış Yeri
                                                : </b><?=$mainuplocation?> - <?=$uplocation?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Geliş Uçuş
                                                Bilgileri / Otel Bilgileri : </b>Oz hotels incekum beach resort. Incekum
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
                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b><u>Donus
                                                    Bilgileri</u></b></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Tarih / Saat
                                                : </b><?=$reservationInfo->checkout?>
                                            / <?=$reservationInfo->checkout_time?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Dönüş Yeri
                                                : </b><?=$maindownlocation?> - <?=$downlocation?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>Dönüş Uçuş
                                                Bilgileri / Otel Bilgileri : </b>Antalya havalimani dis hatlari,
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
                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b>Ekstralar</b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="60%">
                                        <?php   foreach ($reservationEkstras as $item){ $ekstradata = Ekstra::find($item->id_ekstra);
                                        ?>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"> {{ $ekstradata->title  }} : </div>
                                        <?php } ?>
                                    </td>
                                    <td width="20%">
                                        <?php foreach ($reservationEkstras as $item){ ?>
                                        <div
                                            style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1"><?=$item->price?>
                                            TL
                                        </div>
                                        <?php } ?>

                                    </td>
                                    <td width="20%">
                                        <?php foreach ($reservationEkstras as $item){ ?>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><?=$item->item?>
                                            adet
                                        </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>

                        <td style="vertical-align:top;padding-top:10px;padding-bottom:10px">
                            <table width="100%" style="border-left:1px solid #f1f1f1">

                                <tbody>
                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:13px;padding-left:10px"><b>Ödeme Bilgileri</b></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Ödeme Şekli :</b> <?=$payment_type?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Gunluk Ucret :</b> 384 <?=$currency?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Kiralama
                                                Ucreti :</b> <?=$reservation->total_amount?> <?=$currency?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Ekstralar
                                                :</b>
                                            <?php $ekstratotal = 0;
                                            foreach ($reservationEkstras as $item){ ?>
                                             <?php $ekstratotal += $item->day * $item->price ?>
                                            <?php } ?>
                                            <?=$currency?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Yol Masrafi :</b> 404 <?=$currency?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px"><b>Genel
                                                Toplam : <?=$reservation->total_amount?> <?=$currency?></b></div>
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
                            <b>Arac teslimatiniz veya Havalimaninda karsilanmaniz;</b> Arac Havalimani teslim
                            rezervasyon yapilmis ise WorldCar Rental Personeli Rezervasyonunuzda belirtmis oldugunuz
                            Havaalanı terminalin yolcu cikis kapisinda isminizin yazili oldugu bir Tabela ile sizi
                            karsilayacaktır Arac Otel teslimi Rezervasyon yapilmis ise Lütfen Resepsiyonda hazir
                            bulununuz
                            .<br><br>
                            * Arac teslim zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi durumunda 7/24
                            asagidaki iletisim numaralarimizdan yardim isteyebilirsiniz.<br><br>
                            * Arac tesliminde WorldCar Rental a ait kiralama kontrati karsilikli olarak
                            imzalanir.Kiralama kontrati olmadan Arac teslimi edilmez.<br><br>
                            * Ödemenizi arac teslimi esnasinda Rezervasyonunuzda belirttiginiz ödeme sekli ile
                            yapabilirsiniz.Ödeme yapilmadan Arac teslim edilmez.<font color="#888888"><br><br>
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
                                <a href="mailto:info@worldcarrental.com" target="_blank">info@worldcarrental.com</a> -
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
</body>
</html>
