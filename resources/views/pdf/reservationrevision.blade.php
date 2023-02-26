<?php
use App\Models\Brand;use App\Models\Currency;use App\Service\Search;

function private_str($str, $start, $end)
{
    $after = mb_substr($str, 0, $start, 'utf8');
    $repeat = str_repeat('*', $end);
    $before = mb_substr($str, ($start + $end), strlen($str), 'utf8');
    return $after . $repeat . $before;
}

$user_language_id = $reservation->id_language;

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>body {
            font-family: DejaVu Sans, sans-serif;
        }</style>
</head>
@if($user_language_id == 1)
    <?php
    $fiyatadahilhizmetler = "Fiyata Dahil Hizmetler";
    $odemebilgileri = "Ödeme Bilgileri";
    $odemesekli = "Ödeme Şekli ";
    $gunlukucret = "Günluk Ücret";
    $ekstraucreti = "Ekstralar Ücreti";
    $kiralamaucreti = "Kiralama Ücreti";
    $testlimucreti = "Drop Ücreti";
    $alisucreti = "Teslim Ücreti";
    $geneltoplam = "Genel Toplam";
    $kaskosigortasi = 'Kasko Sigortası';
    $farcamsigortasi = 'Far Cam Sigortası ';
    $hirsizliksigortasi = 'Hırsızlık Sigortası';
    $havalimanitransferi = '7/24 Havalimanı Teslim';
    $kdvdahil = 'KDV Dahil';
    $yolyardimi = '7/24 Yol Yardımı';
    $lutfenbilgileriokuyunuz = 'Lütfen Bilgileri Okuyunuz';


    $rezervasyondetaylari = "REZERVASYON BİLGİLERİ";
    $alisBilgileri = "ALIŞ BİLGİLERİ";
    $donusbilgileri = "DÖNÜŞ BİLGİLERİ";
    $alisyeri = "Alış Yeri";
    $donusyeri = "Dönüş Yeri";
    $tarihsaat = "Tarih/Saat";
    $musteriID = "Müşteri ID";
    $GeldiginizUlke = "Geldiğiniz Ülke";
    $CepTelefonu = "Cep Telefonu";
    $emailAdres = "E-mail Adres";
    $ToplamKiralamaSuresi = "Toplam Kiralama Süresi";
    $gun = "Gün";
    $adet = "Adet";

    $text1 = "Havalimanı Karşılanmanız ve Arac tesliminiz; Araç Havalimanı’nda teslim rezervasyon yapilmis ise, World Car Rental' Personeli, Rezervasyonunuzda belirtmis oldugunuz Havaalanı terminalin yolcu çıkıs kapısında isminizin yazili oldugu bir Tabela ile sizi karsilayacaktır. Araç tesliminiz Havalimanı Otoparkımızda veya kiralık Araç noktasında yapılacaktır.Arac Otel teslimi yapılmıssa, Bazı Hotel lerde Güvenlik nedeniyle Hotel e dısardan kişi veya Personel içeriye almamaktadırlar bu sebeb den dolayı Lütfen Hotel dısarisinda bulunan Giris Güvenlik kapisi yanında Rezervasyonunuzda belirttiginiz saatte hazir olunuz. Personelimiz Arac tesliminizi yapacaktır.";
    $text2 = "Arac teslim zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi durumunda 7/24 asagidaki iletisim numaralarimizdan yardim isteyebilirsiniz";
    $text3 = "Arac tesliminde WorldCar Rental a ait kiralama kontrati karsilikli olarak imzalanir.Kiralama kontrati olmadan Arac teslimi edilmez";
    $text4 = "Ödemenizi arac teslimi esnasinda Rezervasyonunuzda belirttiginiz ödeme sekli ile yapabilirsiniz.Ödeme yapilmadan Arac teslim edilmez";
    $text5 = "Bizi tercih ettiğiniz için teşekkür eder iyi yolculuklar dileriz.";

    ?>
@endif
@if($user_language_id == 2)
    <?php
    $fiyatadahilhizmetler = "Leistungen im Preis inbegriffen";
    $odemebilgileri = "Zahlungsinformationen";
    $odemesekli = "Zahlungsmethode ";
    $gunlukucret = "Tagespreis";
    $ekstraucreti = "Zusatzgebühr";
    $kiralamaucreti = "Mietpreis";
    $testlimucreti = "Überführungskosten";
    $alisucreti = "Liefergebühr";
    $geneltoplam = "Gesamtpreis";
    $kaskosigortasi = 'Kaskoversicherung';
    $farcamsigortasi = 'Glasreifenversicherung';
    $hirsizliksigortasi = 'Diebstahlversicherung';
    $havalimanitransferi = '24/7 Flughafen Lieferung ';
    $kdvdahil = 'Inkl. MwSt.';
    $yolyardimi = '24/7 Pannenhilfe';
    $lutfenbilgileriokuyunuz = 'Bitte lesen Sie folgende Informationen';

    $rezervasyondetaylari = "BUCHUNG DETAILS";
    $alisBilgileri = "Anmiet details";
    $donusbilgileri = "Rückgabe details";
    $alisyeri = "Anmiet Ort";
    $donusyeri = "Rückgabe Ort";
    $tarihsaat = "Datum/uhrzeit";
    $musteriID = "Kunden ID";
    $GeldiginizUlke = "Land";
    $CepTelefonu = "Handy nr";
    $emailAdres = "E-mail adresse";
    $ToplamKiralamaSuresi = "Mietdauer";
    $gun = "tag (e)";
    $adet = "Stk";


    $text1 = "Ihre Flughafenannahme und Fahrzeugübergabe:
Wenn das Fahrzeug für die Lieferung am Flughafen gebucht wurde, begrüßt Sie das Personal von World Car Rental mit einem Schild auf dem Ihr Name an der Passagierausgangstür des Flughafenterminals steht, welches Sie bei Ihrer Reservierung angegeben haben.
Ihr Fahrzeug wird auf unserem Flughafenparkplatz oder am Rental Vehicle Point abgegeben.";
    $text2 = "Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text3 = "Sollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text4 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne  unterschriebenen Vertrag ist nicht möglich. Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Vielen Dank für Ihre Präferenz für Ihre Mietwagenbedürfnisse.  Wir wünschen Ihnen gute Fahrt.";

    ?>
@endif
@if($user_language_id == 3)
    <?php
    $fiyatadahilhizmetler = "Услуги, включенные в стоимость";

    $odemebilgileri = "Платежная информация";
    $odemesekli = "способ оплаты ";
    $gunlukucret = "Ежедневная цена";
    $ekstraucreti = "Дополнительная плата";
    $kiralamaucreti = "стоимость аренды";
    $testlimucreti = "Плата в одну сторону";
    $alisucreti = "Плата за доставку";
    $geneltoplam = "Итоговая цена";
    $kaskosigortasi = 'Страхование';
    $farcamsigortasi = 'Страхование стекол шин';
    $hirsizliksigortasi = 'страхование от кражи';
    $havalimanitransferi = '24/7 доставка в аэропорт';
    $kdvdahil = 'НДС включен';
    $yolyardimi = 'помощь на дороге';
    $lutfenbilgileriokuyunuz = 'Пожалуста прочитайте информацию.';

    $rezervasyondetaylari = "ДЕТАЛИ БРОНИРОВАНИЯ";
    $alisBilgileri = "Место получения";
    $donusbilgileri = "Место возврата";
    $alisyeri = "место аренды";
    $donusyeri = "место возвращения";
    $tarihsaat = "Дата/время";
    $musteriID = "Клиент ID";
    $GeldiginizUlke = "Страна";
    $CepTelefonu = "Мобильный nr";
    $emailAdres = "Эл. почта";
    $ToplamKiralamaSuresi = "Срок аренды";
    $gun = "день";
    $adet = "кусок";

    $text1 = "Доставка автомобиля и привести в аэропорт
Если автомобиль забронирован в аэропорту сотрудники Worid Car Rental встретят вас  с табличкой с вашем именим у двери пассажирского выхода терминала аэропорта, который вы указали при бронировании.
Если автомобиль забронирован в отель, подождите рядом с дверью безопасности за пределами отеля. Это связено с тем, что большенству отелей запрещеновходить в целях безопасности, поэтому пожалуста присутствуйте на улице во время доставки автомобиля.";
    $text2 = "Если наши сотрудники не присутствуют в указонном месте во время доставки вашего автомобиля, вы можете запросить помощ по нашем контактным номерам 7/24.";
    $text3 = "При доставки автомобиля договор аренды Worid Car Rental подписывается взаимно. Транспортная средство не доставляеться без договора.";
    $text4 = "Вы можете произвести оплату с помощью формы оплаты, установленной в бронтровании во время доставки автомобиля.Автомобиль не доставляеться без оплаты.";
    $text5 = "Спасибо, что выбрали нашу компанию, Желаем вам хорошей и безопасной езды";
    ?>
@endif
@if($user_language_id == 4)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment Information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily price";
    $ekstraucreti = "Additional fee";
    $kiralamaucreti = "Rental price";
    $testlimucreti = "One way fee";
    $alisucreti = "Delivery fee";
    $geneltoplam = "Total price";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "Adet";

    $text1 = "How Meeting with us at Airport; When you come out from arrival passenger gate you will see our Personal with your name written on our company board.(World Car Rental-Transfer)He will delivery your Car at Airport on our park place. If your Reservation Home Delivery , You can have your car dropped off or picked up right at your doorstep, at your pick up time our Please Personal front of the your Home will be ready and he will delivery your Car there. If your Reservation Pick up or Drop-off at Hotel you can meet with our Personal outside Hotel entrance near the Security because some Hotels for Security from outside the People do not get inside the Hotel s, because of Security, We can delivery the Car Pick up or Drop-off outside the Hotel.";
    $text2 = "The Car delivery time on your reservation form if our personal is there not ready you can call 24/7 following our Office service number   .";
    $text3 = "Rent Car delivery with rent contract possible and mutually should be signed, you can not rent the car without contrat.";
    $text4 = "Your payment mentioned like above, the Car delivery you can pay with your mentioned option, without payment we cannot delivery car.";
    $text5 = "Thank you for choosing our Company.We wish you a good and safe drive.";
    ?>
@endif
@if($user_language_id == 5)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily wages";
    $ekstraucreti = "Extras Fee";
    $kiralamaucreti = "Rental Fee";
    $testlimucreti = "Drop Price";
    $alisucreti = "Up Price";
    $geneltoplam = "Grand total";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "Adet";

    $text1 = "Begrüßung und Mietwagenannahme am Flughafen: Sollte ihre Reservierung mit Annahme am Flughafen getätigt wurden, wird das World Car Rental Personal Sie zu angegebener Zeit mit einem Namensschild am Ausgang des Terminals in Empfang nehmen. Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text2 = "ollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text3 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne unterschriebenen Vertrag ist nicht möglich.";
    $text4 = "Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Thank you for choosing our Company.We wish you a good and safe drive.";

    ?>
@endif
@if($user_language_id == 6)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily wages";
    $ekstraucreti = "Extras Fee";
    $kiralamaucreti = "Rental Fee";
    $testlimucreti = "Drop Price";
    $alisucreti = "Up Price";
    $geneltoplam = "Grand total";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "Adet";

    $text1 = "Begrüßung und Mietwagenannahme am Flughafen: Sollte ihre Reservierung mit Annahme am Flughafen getätigt wurden, wird das World Car Rental Personal Sie zu angegebener Zeit mit einem Namensschild am Ausgang des Terminals in Empfang nehmen. Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text2 = "ollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text3 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne unterschriebenen Vertrag ist nicht möglich.";
    $text4 = "Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Thank you for choosing our Company.We wish you a good and safe drive.";

    ?>
@endif
@if($user_language_id == 7)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily wages";
    $ekstraucreti = "Extras Fee";
    $kiralamaucreti = "Rental Fee";
    $testlimucreti = "Drop Price";
    $alisucreti = "Up Price";
    $geneltoplam = "Grand total";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "Adet";

    $text1 = "Begrüßung und Mietwagenannahme am Flughafen: Sollte ihre Reservierung mit Annahme am Flughafen getätigt wurden, wird das World Car Rental Personal Sie zu angegebener Zeit mit einem Namensschild am Ausgang des Terminals in Empfang nehmen. Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text2 = "ollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text3 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne unterschriebenen Vertrag ist nicht möglich.";
    $text4 = "Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Thank you for choosing our Company.We wish you a good and safe drive.";

    ?>
@endif
@if($user_language_id == 8)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily wages";
    $ekstraucreti = "Extras Fee";
    $kiralamaucreti = "Rental Fee";
    $testlimucreti = "Drop Price";
    $alisucreti = "Up Price";
    $geneltoplam = "Grand total";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "İtem";
    $text1 = "Begrüßung und Mietwagenannahme am Flughafen: Sollte ihre Reservierung mit Annahme am Flughafen getätigt wurden, wird das World Car Rental Personal Sie zu angegebener Zeit mit einem Namensschild am Ausgang des Terminals in Empfang nehmen. Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text2 = "ollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text3 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne unterschriebenen Vertrag ist nicht möglich.";
    $text4 = "Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Thank you for choosing our Company.We wish you a good and safe drive.";

    ?>
@endif
@if($user_language_id == 9)
    <?php
    $fiyatadahilhizmetler = "Services Included in the Price";

    $odemebilgileri = "Payment information";
    $odemesekli = "Payment method ";
    $gunlukucret = "Daily wages";
    $ekstraucreti = "Extras Fee";
    $kiralamaucreti = "Rental Fee";
    $testlimucreti = "Drop Price";
    $alisucreti = "Up Price";
    $geneltoplam = "Grand total";
    $kaskosigortasi = 'Casco Insurance';
    $farcamsigortasi = 'Headlight Glass Insurance';
    $hirsizliksigortasi = 'Theft Insurance';
    $havalimanitransferi = '24/7 Airport Transfer';
    $kdvdahil = 'VAT included';
    $yolyardimi = '24/7 Roadside Assistance';
    $lutfenbilgileriokuyunuz = 'Please Read Information';

    $rezervasyondetaylari = "BOOKING DETAILS";
    $alisBilgileri = "Pick up details";
    $donusbilgileri = "Drop off details";
    $alisyeri = "Pick up location";
    $donusyeri = "Drop off location";
    $tarihsaat = "Date/time";
    $musteriID = "Customer ID";
    $GeldiginizUlke = "Country";
    $CepTelefonu = "Mobile nr";
    $emailAdres = "E-mail adress";
    $ToplamKiralamaSuresi = "Rental period";
    $gun = "day (s)";
    $adet = "Item";

    $text1 = "Begrüßung und Mietwagenannahme am Flughafen: Sollte ihre Reservierung mit Annahme am Flughafen getätigt wurden, wird das World Car Rental Personal Sie zu angegebener Zeit mit einem Namensschild am Ausgang des Terminals in Empfang nehmen. Sollte die Annahme an einem Hotel bebucht worden sein, begeben Sie sich bitte zu verabredeter Zeit zum Haupteingang vor dem Hotel. Aufgrund der Sicherheitsvorkehrungen ist es oft nicht gestattet, das Hotel zu betreten. Daher bitten wir Sie, vor dem Hotel zu erscheinen.";
    $text2 = "ollte sich unser Personal zu verabredeter Zeit nicht am Übergabeort befinden, können Sie 7/24 untenstehende Servicenummern anrufen. Wir werden Ihnen direkt behilflich sein.";
    $text3 = "Bei Fahrzeugübergabe wird der Mietvertrag von WorldCar Rental gegenseitig unterzeichnet. Eine Übergabe ohne unterschriebenen Vertrag ist nicht möglich.";
    $text4 = "Sie können Ihre Zahlung während der Fahrzeugübergabe mit der von Ihnen angegebenen Zahlungsart vornehmen. Eine Fahrzeugübergabe ohne Zahlung ist nicht möglich.";
    $text5 = "Bizi tercih ettiğiniz için teşekkür eder iyi yolculuklar dileriz.";
    ?>
@endif
<body style="color: #002655; background: #f1f3f4;">

<?php

$currency = Currency::find($reservation->id_currency)->right_icon;
?>
<style>
    .plate {
        display: block;
        width: 96px;
        border: 1px solid #008fff;
        border-radius: 2px;
        line-height: 23px;
        font-size: 10px;
        font-weight: 700 !important;
        color: #363636;
        text-align: center;
        position: relative;
        padding-left: 24px;
        background: #fff;
    }
    .plate span {
        position: absolute;
        left: 0;
        top: 0;
        width: 24px;
        background: #008fff;
        color: #fff;
    }
</style>
<div style="width:800px;height:1220px;margin:30px auto;background:#fff;">
    <table width="100%">
        <tbody>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" width="100%" height="80px">
                    <tbody>
                    <tr>
                        <td>
                            <div align="left">
                                <img
                                    src="data:image/png;base64,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"
                                    style="width:250px;    margin: 0 30px;">
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <strong style="font-size:20px">VOUCHER</strong></br>
                                <span style="font-size:13px"><b>PNR No :</b> {{$reservation->pnr}}</span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <?php

                $car = $reservation->reservationCarNew();
                $brand = Brand::where('id', $car['brand'])->first();
                $model = \App\Models\CarModel::where('id', $car['model'])->first();
                ?>
                <table width="100%" style="border:1px solid #f1f1f1">
                    <tbody>
                    <tr>
                        <td width="50%"
                            style="vertical-align:top;padding:10px 10px 10px 10px;border-right:1px solid #f1f1f1">
                            <div>
                                <?php if($car['image']){?>
                                <?php if($car['image'] != "NULL"){ ?>
                                <img
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/uploads/'.$image))) }}"
                                    width="200" style="width: 200px;">
                                <?php }else{ ?>
                                <img
                                    src="{{public_path('storage/custom/default_car.jpeg')}}"
                                    width="200" style="width: 200px;">
                                <?php } ?>

                                <?php }else{ ?>
                                    <img
                                        src="{{public_path('storage/custom/default_car.jpeg')}}"
                                        width="200" style="width: 200px;">
                                    <?php } ?>
                            </div>
                            <div style="text-align:center">
                                <span style="font-size: 15px;"> <b>{{$brand->brandname}} {{$model->modelname}}</b>  {{$car['fuel']}} {{$car['transmission']}}</span>
                            </div>
                            <div  style="text-align:center">
                                <?php if(!is_null($reservation->plate)){ ?>
                                <p class="plate"><span>TR</span> {{\App\Models\Plate::find($reservation->plate)->plate}}</p>
                                <?php } ?>
                            </div>
                        </td>
                        <td width="50%" style="vertical-align:top;padding:10px 10px 10px 10px">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="font-size:15px">
                                        <b>{{$reservation->reservationInformation->firstname}} {{$reservation->reservationInformation->lastname}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:15px">
                                        <b>{{$musteriID}} :</b> {{$reservation->customer->id}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:15px">
                                        <b>{{$GeldiginizUlke}}
                                            :</b> {{$reservation->reservationInformation->nationality}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:15px">
                                        <b>{{$CepTelefonu}}
                                            :</b> <?php echo private_str($reservation->reservationInformation->phone, 3, 11); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:15px">
                                        <b>{{$emailAdres}}
                                            :</b> <?php echo private_str($reservation->reservationInformation->email, 5, 11); ?>
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
                        <td width="50%">
                            <div style="font-size:14px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px">
                                <b style="font-size: 16px;"> <u><?=$rezervasyondetaylari?><u></u></u></b></div>
                        </td>
                        <td width="25%" style="color:#002655">
                            <div style="color:#002655;font-size:12px;padding:10px 10px 10px 10px">
                                <b>{{$ToplamKiralamaSuresi}}
                                    :</b> <?=$reservation->days?> <?=$gun?>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" style="border:1px solid #f1f1f1">
                    <tbody>
                    <tr>
                        <td style="width:50%">
                            <table width="100%" style="border-right:1px solid #f1f1f1">

                                <tbody>
                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:13px;padding-left:10px">
                                            <b><u>{{$alisBilgileri}}</u></b></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>{{$tarihsaat}}
                                                : </b><?=date('d-m-Y', strtotime($reservation->checkin))?>
                                            / <?=$reservation->checkin_time?></div>
                                    </td>
                                </tr>
                                <?php
                                $uplocation = Search::getLocationName($reservation->reservationInformation->up_location);
                                $mainuplocation = Search::getLocationParentName($reservation->reservationInformation->up_location);
                                ?>
                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>{{$alisyeri}}
                                                : </b><?=$mainuplocation?> - <?=$uplocation?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $reservationinformation = $reservation->reservationInformation->up_drop_information;
                                    if($reservationinformation)
                                    {
                                    $details = json_decode($reservationinformation, true);
                                    if($details['drop']['type'] != 'ofis')
                                    {

                                    ?>
                                    <span
                                        style="color:#000;font-weight: 700;">{{\App\Models\Location::getViewCenterId($reservation->reservationInformation->up_location ?? null)[0]->title ?? null}} </span>
                                    <span
                                        style="font-weight: 700;font-size:10px"> ( {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['up']['type'] ?? \App\Models\Reservation::TYPE_TRANSLATIONS['up']] !!}   {!! $details['up']['key'] !!} {!! $details['up']['value'] !!} )</span>

                                    <?php } ?>
                                    <?php } ?>
                                </tr>

                                </tbody>
                            </table>

                        </td>

                        <td style="width:50%">
                            <table>

                                <tbody>
                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:13px;padding-left:10px">
                                            <b><u>{{$donusbilgileri}}</u></b></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>{{$tarihsaat}}
                                                : </b><?=date('d-m-Y', strtotime($reservation->checkout))?>
                                            / <?=$reservation->checkout_time?></div>
                                    </td>
                                </tr>

                                <?php
                                $dropLocation = $reservation->reservationInformation->drop_location;
                                if ($reservation->reservationInformation->drop_location == null) {
                                    $dropLocation = $reservation->reservationInformation->up_location;
                                }

                                $maindownlocation = Search::getLocationParentName($dropLocation);
                                $downlocation = Search::getLocationName($dropLocation);
                                ?>
                                <tr>
                                    <td>
                                        <div style="color:#002655;font-size:12px;padding-left:10px"><b>{{$donusyeri}}
                                                : </b><?=$maindownlocation?> - <?=$downlocation?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <?php
                                    $reservationinformation = $reservation->reservationinformation->up_drop_information;
                                    if($reservationinformation)
                                    {
                                    $details = json_decode($reservationinformation, true);
                                    if($details['drop']['type'] != 'ofis')
                                    {
                                    ?>
                                    <span
                                        style="color:#000;font-weight: 700;">{{\App\Models\Location::getViewCenterId($reservation->reservationInformation->drop_location ?? null)[0]->title ?? null}} </span>
                                    <span
                                        style="font-weight: 700;font-size:10px"> ( {!! \App\Models\Reservation::TYPE_TRANSLATIONS[$details['drop']['type'] ?? \App\Models\Reservation::TYPE_TRANSLATIONS['up']] !!}   {!! $details['drop']['key'] !!} {!! $details['drop']['value'] !!} )</span>
                                    <?php } ?>
                                    <?php } ?>
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
                                        <div style="font-size:16px;padding-left:10px"><b>Ekstralar</b>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $reservationEkstras = $reservation->reservationEkstras;
                                foreach($reservationEkstras as $item){ ?>
                                <tr>
                                    <td width="60%">
                                        <div
                                            style="font-size:12px;padding-left:10px"> {{\App\Models\EkstraLanguage::getSelectLang($item->id_ekstra,'title',$user_language_id)}}
                                            :
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div style="font-size:12px;padding-left:10px">{{$item->item}} <?=$adet?>
                                            (<?php if ($item->item > 0) {
                                                echo '<img style="width:10px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>';
                                            } ?>)
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div
                                            style="font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1"> {{$item->price}} {{$currency}} </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </td>

                        <td style="vertical-align:top;padding-top:10px;padding-bottom:10px">
                            <table width="100%" style="border-left:1px solid #f1f1f1">

                                <tbody>
                                <tr>
                                    <td>
                                        <div style="font-size:16px;padding-left:10px">
                                            <b><?=$odemebilgileri?></b>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$odemesekli?> :</b> {{ $reservation->getPaymentMethod()}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$gunlukucret?> :</b> {{round($reservation->day_price)}} {{$currency}} </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$kiralamaucreti?> :</b> {{round($reservation->rent_price)}} {{$currency}}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$ekstraucreti?> :</b> {{round($reservation->ekstra_price)}} {{$currency}}
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$testlimucreti?> :</b> {{round($reservation->drop_price)}} {{$currency}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$alisucreti?> :</b> {{round($reservation->up_price)}} {{$currency}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="font-size:12px;padding-left:10px;padding-top:2px">
                                            <b><?=$geneltoplam?> : <span
                                                    style="text-decoration:line-through;">{{round($reservation->old_total_amount)}}  {{$currency}}</span> {{round($reservation->total_amount)}}  {{$currency}}
                                            </b></div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table
                    style="border-collapse:collapse;border-spacing:0;margin:10px 0;padding:0;text-align:left;vertical-align:top;width:100%">
                    <tbody>
                    <tr>
                        <td colspan="6" style="width:100%;font-size: 16px;text-align:center">
                            <b><?=$fiyatadahilhizmetler?></b></td>
                    </tr>
                    <tr>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$kaskosigortasi?> <img
                                style="width:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$farcamsigortasi?> <img
                                style="width:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$hirsizliksigortasi?> <img
                                style="width:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$havalimanitransferi?> <img
                                style="width:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$kdvdahil?> <img style="width:10px;"
                                                                                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                        <td style="width:auto;font-size: 12px;text-align:center"><?=$yolyardimi?> <img
                                style="width:10px;"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAAgElEQVRIie2UQQqAIBBF3yWKuv9JWkVYm1x0nFooIRWhpQPRPHCnPmb8IyiK8owamIBOWmqBFRikpBUwe+kCNCpV6X+kPTDiZi+WcE5t4tkdk3hBFimcW9Ym7H39pjHyYkG6kxdP75VcbGSO4ckSpFjCKkU/B3DVGb+KV6oo32QDDxpD3wtiIfoAAAAASUVORK5CYII="/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table width="100%" style="border:1px solid #f1f1f1">
                    <tbody>

                    <tr>
                        <td style="font-size:12px;padding-left:10px;padding-top:5px">
                            <b style="font-size: 16px;"><u><?=$lutfenbilgileriokuyunuz?></u></b><br>
                            <p><?=$text1?></p>
                            <p><?=$text2?></p>
                            <p><?=$text3?></p>
                            <p><?=$text4?></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <table
                style="border-collapse:collapse;border-spacing:0;margin:10px 0;padding:0;text-align:left;vertical-align:top;width:100%">
                <tbody>
                <tr>
                    <th style="margin:0;color:#717171;font-size:14px;font-weight:400;line-height:1.3;padding:0!important;text-align:left;">
                        <div style="margin-top:10px;text-align:center"><b><?=$text5?></b></div>
                    </th>
                </tr>
                <tr style="padding:0;text-align:left;vertical-align:top">
                    <th style="margin:0;font-size:14px;font-weight:400;line-height:1.1;padding:0;text-align:left">
                        <div style="font-size:12px;line-height:1.4;text-align:center"> WORLD SEY.
                            TUR.iNŞ.iTH.iHR.TiC.LTD.ŞTi . Copyright 2015 - <?=date('Y')?> </div>
                        <div style="margin-top:3px;text-align:center"><a href="#"
                                                                         style="margin:0;color:#8a8a8a;display:inline-block;font-size:12px;font-weight:400;line-height:1.4;padding:0;text-align:center;text-decoration:none"
                                                                         rel="noreferrer" target="_blank"> Saray Mah
                                Ataturk Cad Antalya - Alanya, 07400</a></div>
                    </th>
                </tr>

                <tr style="padding:0;text-align:left;vertical-align:top">
                    <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.2;margin:0;padding:0;text-align:left">
                        <div style="color:#198144;text-align:center">
                            <a
                                href="https://@worldcarrental.com"
                                style="margin:0;color:#198144;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.4;margin:0;padding:3px;text-align:left;text-decoration:underline"
                                rel="noreferrer" target="_blank">worldcarrental.com</a>
                            |
                            <a
                                href="mailto:info@worldcarrental.com"
                                style="margin:0;color:#198144;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.4;margin:0;padding:3px;text-align:left;text-decoration:underline"
                                rel="noreferrer" target="_blank">info@worldcarrental.com</a>
                        </div>
                        <div style="color:#198144;text-align:center">
                            <a href="tel:+908508888807"
                               style="margin:0;color:#198144;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.4;margin:0;padding:3px;text-align:left;text-decoration:underline"
                               rel="noreferrer" target="_blank">+90 850 888 88 07</a>

                            |

                            <a href="tel:+905327368807"
                               style="margin:0;color:#198144;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.4;margin:0;padding:3px;text-align:left;text-decoration:underline"
                               rel="noreferrer" target="_blank">+90 532 736 88 07</a>

                        </div>
                    </th>
                    <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0!important;text-align:left;width:0"></th>
                </tr>
                </tbody>
            </table>
        </tr>
        </tbody>

    </table>

</div>
</body>
</html>
