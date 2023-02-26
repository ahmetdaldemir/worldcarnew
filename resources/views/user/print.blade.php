<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
<style>
body {
font-family: 'Roboto';
}

@media print {
body {
width: 21cm;
height: 29.7cm;


}
}
/* latin */
@font-face {
font-family: 'Gochi Hand';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/gochihand/v14/hES06XlsOjtJsgCkx1Pkfon_-w.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 300;
src: url(https://fonts.gstatic.com/s/lato/v22/S6u9w4BMUTPHh7USSwaPGR_p.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 300;
src: url(https://fonts.gstatic.com/s/lato/v22/S6u9w4BMUTPHh7USSwiPGQ.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/lato/v22/S6uyw4BMUTPHjxAwXjeu.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/lato/v22/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxC7mw9c.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRzS7mw9c.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxi7mw9c.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxy7mw9c.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRyS7m.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxC7mw9c.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRzS7mw9c.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxi7mw9c.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxy7mw9c.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRyS7m.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}  </style>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" onload="window.print();">
<table width="100%" style="border:1px solid #f1f1f1; background-color:#FFFFFF;">
    <tbody>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" width="100%" height="80px" style="background-color:#002655;">
                <tbody>
                <tr>
                    <td>
                        <div align="center"><img src="http://worldcarrental.com/img/logo.png" width="360" height="50"></div>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td width="15%"
                        style="vertical-align:top;padding:10px 10px 10px 10px; border-right:1px solid #f1f1f1;"><img
                            src="file:///C:/Users/ramaz/Desktop/print_files/100148.jpg" width="150" height="120"></td>
                    <td width="50%"
                        style="vertical-align:middle;padding:10px 10px 10px 10px; border-right:1px solid #f1f1f1;color:#002655;">
                        <b>Peugeot 301</b> Dizel
                    </td>
                    <td width="35%" style="vertical-align:top;padding:10px 10px 10px 10px; ">
                        <table>
                            <tbody>
                            <tr>
                                <td style="color:#002655;" font-size:14px;
                                "="">
                                <b><u>KİŞİSEL BİLGİLER</u></b>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>AHMET DALDEMMIR</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Musteri ID :</b> 8156
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Geldiginiz Ulke :</b> TR
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Cep Telefon :</b> 05555525252
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Email :</b> ahmetdaldemir@gmail.com
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td width="50%" style="color:#002655;" font-size:14px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <div
                        style="color:#002655;font-size:14px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px;">
                        <b><u>REZERVASYON DETAYLARI<u></u></u></b></div>
                    <u><u>
                        </u></u></td>
                    <td width="25%" style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <div
                        style="color:#002655;font-size:12px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px;">
                        <b>PNR No :</b> 10478
                    </div>
                    </td>
                    <td width="25%" style="color:#002655;" font-size:12px;
                    "="">
                    <div style="color:#002655;font-size:12px;padding:10px 10px 10px 10px;"><b>Toplam Kiralama Suresi
                            :</b> 21 gun
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>

                    <td style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <table width="100%" style="border-right:1px solid #f1f1f1;">

                        <tbody>
                        <tr>
                            <td>
                                <div style="color:#002655;font-size:13px;padding-left:10px;"><b><u>Alis
                                            Bilgileri</u></b></div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Tarih / Saat : </b>24
                                    Subat 2022 / 10:00
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Alış Yeri : </b>Antalya
                                    - Antalya Havalimani Dis Hatlar
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Geliş Uçuş Bilgileri /
                                        Otel Bilgileri : </b>,
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    </td>

                    <td style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <table>

                        <tbody>
                        <tr>
                            <td>
                                <div style="color:#002655;font-size:13px;padding-left:10px;"><b><u>Donus
                                            Bilgileri</u></b></div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Tarih / Saat : </b>17
                                    Mart 2022 / 10:00
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Dönüş Yeri : </b>Antalya
                                    - Antalya Havalimani Dis Hatlar
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Dönüş Uçuş Bilgileri /
                                        Otel Bilgileri : </b>,
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    </td>

                </tr>
                </tbody>
            </table>


            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>

                    <td style="vertical-align:top;padding-top:10px;padding-bottom:10px;">
                        <table width="100%">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Fiyatlara Dahil
                                            Olanlar</b></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Full Kasko</div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Gunluk 300km adil km
                                        kullanimi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Lastik Cam Far
                                        sigortasi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Hirsizlik Sigortasi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Havalimani Arac
                                        Teslimi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">K.D.V</div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                    <td style="padding-top:10px;padding-bottom:10px;">
                        <table width="100%" style="border-left:1px solid #f1f1f1;">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Ektralar</b></div>
                                </td>
                            </tr>

                            <tr>
                                <td width="50%">
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Bebek Koltuğu :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Çocuk Koltuğu :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Koltuk Yükseltici :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Navigasyon :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Mini Hasar Paketi :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Hızlı Geçiş Sistemi
                                        (HGS) :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Kış Lastiği :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Kar Zinciri :</div>
                                </td>
                                <td width="25%">
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                </td>
                                <td width="25%">
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                    <td style="vertical-align:top;padding-top:10px;padding-bottom:10px;">
                        <table width="100%" style="border-left:1px solid #f1f1f1;">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Ödeme Bilgileri</b>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Ödeme
                                            Şekli :</b> Arac Tesliminde Nakit Odeme
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Gunluk
                                            Ucret :</b> 127 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Kiralama
                                            Ucreti :</b> 2,672 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Ekstralar
                                            :</b> 0 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Yol
                                            Masrafi :</b> TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Genel
                                            Toplam : 2672 TL</b></div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                </tr>
                </tbody>
            </table>


            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td style="color:#002655;font-size:12px;padding-left:10px;padding-top:10px;">
                        <b>Lütfen Bilgileri Okuyunuz</b><br><br>
                        <b>Arac teslimatiniz veya Havalimaninda karsilanmaniz;</b> Arac Havalimani teslim rezervasyon
                        yapilmis ise WorldCar Rental Personeli Rezervasyonunuzda belirtmis oldugunuz Havaalanı
                        terminalin yolcu cikis kapisinda isminizin yazili oldugu bir Tabela ile sizi karsilayacaktır
                        Arac Otel teslimi Rezervasyon yapilmis ise Lütfen Resepsiyonda hazir bulununuz
                        .<br><br>
                        * Arac teslim zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi durumunda 7/24
                        asagidaki iletisim numaralarimizdan yardim isteyebilirsiniz.<br><br>
                        * Arac tesliminde WorldCar Rental a ait kiralama kontrati karsilikli olarak imzalanir.Kiralama
                        kontrati olmadan Arac teslimi edilmez.<br><br>
                        * Ödemenizi arac teslimi esnasinda Rezervasyonunuzda belirttiginiz ödeme sekli ile
                        yapabilirsiniz.Ödeme yapilmadan Arac teslim edilmez.<br><br>
                        * Rezervasyonunuz Onaylandi.<br><br>
                    </td>
                </tr>
                </tbody>
            </table>

            <table cellpadding="0" cellspacing="0" width="100%" height="50px"
                   style="background-color:#002655; color:#fdf7ac; font-size:14px;">
                <tbody>
                <tr>
                    <td align="center" style="padding-top:10px;padding-bottom:10px;">
                        WORLD CAR RENTAL<br>
                        +90 850 888 88 07 - +90 532 736 88 07<br>
                        info@worldcarrental.com - www.worldcarrental.com
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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
<style>
body {
font-family: 'Roboto';
}

@media print {
body {
width: 21cm;
height: 29.7cm;


}
}
/* latin */
@font-face {
font-family: 'Gochi Hand';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/gochihand/v14/hES06XlsOjtJsgCkx1Pkfon_-w.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 300;
src: url(https://fonts.gstatic.com/s/lato/v22/S6u9w4BMUTPHh7USSwaPGR_p.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 300;
src: url(https://fonts.gstatic.com/s/lato/v22/S6u9w4BMUTPHh7USSwiPGQ.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/lato/v22/S6uyw4BMUTPHjxAwXjeu.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Lato';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/lato/v22/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxC7mw9c.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRzS7mw9c.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxi7mw9c.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxy7mw9c.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRyS7m.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxC7mw9c.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRzS7mw9c.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxi7mw9c.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRxy7mw9c.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: italic;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUQjIg1_i6t8kCHKm459WxRyS7m.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 400;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
font-family: 'Montserrat';
font-style: normal;
font-weight: 700;
src: url(https://fonts.gstatic.com/s/montserrat/v23/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}  </style>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" onload="window.print();">
<table width="100%" style="border:1px solid #f1f1f1; background-color:#FFFFFF;">
    <tbody>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" width="100%" height="80px" style="background-color:#002655;">
                <tbody>
                <tr>
                    <td>
                        <div align="center"><img src="http://www.worldcarrental.com/img/logo.png" width="360" height="50"></div>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td width="15%"
                        style="vertical-align:top;padding:10px 10px 10px 10px; border-right:1px solid #f1f1f1;"><img
                            src="file:///C:/Users/ramaz/Desktop/print_files/100148.jpg" width="150" height="120"></td>
                    <td width="50%"
                        style="vertical-align:middle;padding:10px 10px 10px 10px; border-right:1px solid #f1f1f1;color:#002655;">
                        <b>Peugeot 301</b> Dizel
                    </td>
                    <td width="35%" style="vertical-align:top;padding:10px 10px 10px 10px; ">
                        <table>
                            <tbody>
                            <tr>
                                <td style="color:#002655;" font-size:14px;
                                "="">
                                <b><u>KİŞİSEL BİLGİLER</u></b>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>AHMET DALDEMMIR</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Musteri ID :</b> 8156
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Geldiginiz Ulke :</b> TR
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Cep Telefon :</b> 05555525252
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;color:#002655;&quot;">
                                    <b>Email :</b> ahmetdaldemir@gmail.com
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td width="50%" style="color:#002655;" font-size:14px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <div
                        style="color:#002655;font-size:14px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px;">
                        <b><u>REZERVASYON DETAYLARI<u></u></u></b></div>
                    <u><u>
                        </u></u></td>
                    <td width="25%" style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <div
                        style="color:#002655;font-size:12px;border-right:1px solid #f1f1f1;padding:10px 10px 10px 10px;">
                        <b>PNR No :</b> 10478
                    </div>
                    </td>
                    <td width="25%" style="color:#002655;" font-size:12px;
                    "="">
                    <div style="color:#002655;font-size:12px;padding:10px 10px 10px 10px;"><b>Toplam Kiralama Suresi
                            :</b> 21 gun
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>

                    <td style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <table width="100%" style="border-right:1px solid #f1f1f1;">

                        <tbody>
                        <tr>
                            <td>
                                <div style="color:#002655;font-size:13px;padding-left:10px;"><b><u>Alis
                                            Bilgileri</u></b></div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Tarih / Saat : </b>24
                                    Subat 2022 / 10:00
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Alış Yeri : </b>Antalya
                                    - Antalya Havalimani Dis Hatlar
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Geliş Uçuş Bilgileri /
                                        Otel Bilgileri : </b>,
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    </td>

                    <td style="color:#002655;" font-size:12px;="" border-right:1px="" solid="" #f1f1f1;
                    "="">
                    <table>

                        <tbody>
                        <tr>
                            <td>
                                <div style="color:#002655;font-size:13px;padding-left:10px;"><b><u>Donus
                                            Bilgileri</u></b></div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Tarih / Saat : </b>17
                                    Mart 2022 / 10:00
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Dönüş Yeri : </b>Antalya
                                    - Antalya Havalimani Dis Hatlar
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="color:#002655;font-size:12px;padding-left:10px;"><b>Dönüş Uçuş Bilgileri /
                                        Otel Bilgileri : </b>,
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    </td>

                </tr>
                </tbody>
            </table>


            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>

                    <td style="vertical-align:top;padding-top:10px;padding-bottom:10px;">
                        <table width="100%">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Fiyatlara Dahil
                                            Olanlar</b></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Full Kasko</div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Gunluk 300km adil km
                                        kullanimi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Lastik Cam Far
                                        sigortasi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Hirsizlik Sigortasi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Havalimani Arac
                                        Teslimi
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">K.D.V</div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                    <td style="padding-top:10px;padding-bottom:10px;">
                        <table width="100%" style="border-left:1px solid #f1f1f1;">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Ektralar</b></div>
                                </td>
                            </tr>

                            <tr>
                                <td width="50%">
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Bebek Koltuğu :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Çocuk Koltuğu :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Koltuk Yükseltici :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Navigasyon :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Mini Hasar Paketi :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Hızlı Geçiş Sistemi
                                        (HGS) :
                                    </div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Kış Lastiği :</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">Kar Zinciri :</div>
                                </td>
                                <td width="25%">
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                    <div
                                        style="color:#002655;font-size:12px;padding-left:10px;border-right:1px solid #f1f1f1;">
                                        0 TL
                                    </div>
                                </td>
                                <td width="25%">
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;">0 adet</div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                    <td style="vertical-align:top;padding-top:10px;padding-bottom:10px;">
                        <table width="100%" style="border-left:1px solid #f1f1f1;">

                            <tbody>
                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:13px;padding-left:10px;"><b>Ödeme Bilgileri</b>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Ödeme
                                            Şekli :</b> Arac Tesliminde Nakit Odeme
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Gunluk
                                            Ucret :</b> 127 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Kiralama
                                            Ucreti :</b> 2,672 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Ekstralar
                                            :</b> 0 TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Yol
                                            Masrafi :</b> TL
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="color:#002655;font-size:12px;padding-left:10px;padding-top:5px;"><b>Genel
                                            Toplam : 2672 TL</b></div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>

                </tr>
                </tbody>
            </table>


            <table width="100%" style="border:1px solid #f1f1f1;">
                <tbody>
                <tr>
                    <td style="color:#002655;font-size:12px;padding-left:10px;padding-top:10px;">
                        <b>Lütfen Bilgileri Okuyunuz</b><br><br>
                        <b>Arac teslimatiniz veya Havalimaninda karsilanmaniz;</b> Arac Havalimani teslim rezervasyon
                        yapilmis ise WorldCar Rental Personeli Rezervasyonunuzda belirtmis oldugunuz Havaalanı
                        terminalin yolcu cikis kapisinda isminizin yazili oldugu bir Tabela ile sizi karsilayacaktır
                        Arac Otel teslimi Rezervasyon yapilmis ise Lütfen Resepsiyonda hazir bulununuz
                        .<br><br>
                        * Arac teslim zamaninizda Personelimizin belirtilen yerde hazir bulunmamasi durumunda 7/24
                        asagidaki iletisim numaralarimizdan yardim isteyebilirsiniz.<br><br>
                        * Arac tesliminde WorldCar Rental a ait kiralama kontrati karsilikli olarak imzalanir.Kiralama
                        kontrati olmadan Arac teslimi edilmez.<br><br>
                        * Ödemenizi arac teslimi esnasinda Rezervasyonunuzda belirttiginiz ödeme sekli ile
                        yapabilirsiniz.Ödeme yapilmadan Arac teslim edilmez.<br><br>
                        * Rezervasyonunuz Onaylandi.<br><br>
                    </td>
                </tr>
                </tbody>
            </table>

            <table cellpadding="0" cellspacing="0" width="100%" height="50px"
                   style="background-color:#002655; color:#fdf7ac; font-size:14px;">
                <tbody>
                <tr>
                    <td align="center" style="padding-top:10px;padding-bottom:10px;">
                        WORLD CAR RENTAL<br>
                        +90 850 888 88 07 - +90 532 736 88 07<br>
                        info@worldcarrental.com - www.worldcarrental.com
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
