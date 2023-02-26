<!DOCTYPE html>
<html>
<head>
    <title>{{$language->subject_birthday}}</title>
</head>
<body>
<table width="700" align="center" cellspacing="0" cellpadding="0"
       style="font-family:'Calibri','Tahoma',Geneva,sans-serif;color:#a12e93;text-align:center;font-weight:normal;background-color:#fafafa">
    <tbody>
    <tr>
        <td width="698">
            <a href="#" target="_blank">
                <img src="{{asset('public/assets/images/banner.jpg')}}" style="display:block;border-style:none"
                     class="CToWUd">
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <img width="700" src="{{asset('public/assets/images/birthday.jpg')}}"
                 style="display:block;border-style:none" class="CToWUd a6T" tabindex="0">
            <div class="a6S" dir="ltr" style="opacity: 0.01; left: 894px; top: 469px;">
                <div id=":13a" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                     aria-label=" adlı eki indir" data-tooltip-class="a1V" data-tooltip="İndir">
                    <div class="akn">
                        <div class="aSK J-J5-Ji aYr"></div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="font-family:'Calibri','Tahoma',Geneva,sans-serif;background-image:url('https://ci5.googleusercontent.com/proxy/x6bSUCIF52hXAJeidycnzSaCkSoNarovlVaE4rmn953HFJZ_pTHO78Q_rFlxcTt4x8km3AeZCzezy3g2_8nOLGV9l1XDKawYheW_ky4tD1NeUKuS7bpezpfJ19oC9vY=s0-d-e1-ft#http://kampanya.qnbfinansbank.com/images/enpara-dg-2021-text-bg-image_v1.jpg')">
            <p id="m_8359415329967510917text-area" style="color:#ab60a4;font-size:50px;letter-spacing:-1px;font-weight:bold;margin-bottom:0px;margin-top:0px;padding-top:30px;padding-bottom:30px">
                <?php if($customer->language == 1){ ?>
                Merhabalar
                <?php }else if($customer->language == 2){ ?>
                Hallo
                <?php }else if($customer->language == 3){ ?>
                Привет
                <?php }else if($customer->language == 4){ ?>
                Hello
                <?php }else { ?>
                Hello
                <?php } ?>
                <br> <?php echo $customer->fullname ?> !</p>
        </td>
    </tr>
    <tr>
        <td>
            <?php if($customer->language == 1){ ?>
             Rezervasyonunuza 6 Saat Kaldı
            <?php }else if($customer->language == 2){ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php }else if($customer->language == 3){ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php }else if($customer->language == 4){ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php }else if($customer->language == 5){ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php }else if($customer->language == 6){ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php }else{ ?>
                Rezervasyonunuza 6 Saat Kaldı
            <?php } ?>

        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" align="center"
                   style="padding-top:7px;padding-bottom:7px;font-family:Verdana,Geneva,sans-serif;font-size:8px;color:#000000">
                <tbody>
                <tr>
                    <td style="text-align:center" valign="top">
                        <p style="font-size:9px">
                            Saray Mah.Atatürk Bulvari. Denizolgun IshanıA Blok No:120 - Antalya Alanya 07410.<br/>
                            <b>+90 850 888 88 07 PBX</b> - <b>+905327368807</b> - <b>info@worldcarrental.com</b>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
