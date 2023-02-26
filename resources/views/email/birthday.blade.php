
<html>
<style>

</style>
<body>
@csrf
<div style="margin:0;box-sizing:border-box;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;min-width:100%;padding:0;text-align:left;width:100%">
    <span style="color:#f5f5f5;display:none!important;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden"></span>
    <table style=" margin:0 auto;background:#f5f5f5;border-collapse:collapse;border-spacing:0;color:#717171;
        font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
        <tbody>
        <tr style="padding:0;text-align:left;vertical-align:top">
            <td align="center" valign="top"
                style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                <center style="min-width:700px;width:100%">
                    <table
                        style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">

                        <tbody>
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td height="20px"
                                style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:20px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                &nbsp;
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    {{view('email.mail_header')}}
{{--                    url('https://www.worldcarrental.com/view/birthday.png'),--}}
                    <table align="center"
                           style="background: url('https://www.worldcarrental.com/view/images/birthday_background.png');    border: 1px solid #e8e8e8;
    border-collapse: collapse;
    border-spacing: 0;
    border-top: 0;    height: 475px;
    float: none;
    margin: 0 auto;
    padding: 0;
    text-align: center;
    vertical-align: top;
    background-size: cover;
    width: 700px;
    background-position: 0 100%;">
                        <tbody>
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table align="center"
                                       style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:30px 20px;text-align:left;vertical-align:top;word-wrap:break-word">
                                            <table
                                                style="border-collapse:collapse;border-spacing:0;display:table;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="margin:0 auto;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0 auto;padding:0;padding-bottom:0;padding-left:16px;padding-right:16px;text-align:left;width:564px">

                                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                                <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left">
                                                                    <h4 style="margin:0;margin-bottom:10px;color:inherit;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:1.4;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">
                                                                            <?php if($user_language_id == 1){ ?>
                                                                            İyi ki doğdunuz
                                                                            <?php }else if($user_language_id == 2){ ?>
                                                                            Alles Gute zum Geburtstag
                                                                            <?php }else if($user_language_id == 3){ ?>
                                                                            С днем ​​рождения
                                                                            <?php }else if($user_language_id == 4){ ?>
                                                                            Happy Birthday
                                                                            <?php }else if($user_language_id == 5){ ?>
                                                                            Tillykke med fødselsdagen
                                                                            <?php }else if($user_language_id == 6){ ?>
                                                                            Hyvää syntymäpäivää
                                                                            <?php }else if($user_language_id == 7){ ?>
                                                                            Gratulerer med dagen
                                                                            <?php }else if($user_language_id == 8){ ?>
                                                                            Grattis på födelsedagen
                                                                            <?php }else if($user_language_id == 9){ ?>
                                                                            Hyvää syntymäpäivää
                                                                            <?php } ?>
                                                                            <br><?php echo $fullname ?> !
                                                                    </h4>

                                                                    <p style="color: #666666;">
                                                                        <?php if($user_language_id == 1){ ?>
                                                                        WorldCar Ailesi olarak, Doğum Gününüzü Kutlar, Sağlik, Mutluluk dolu nice yıllar Dileriz...
                                                                        <?php }else if($user_language_id == 2){ ?>
                                                                        Als WorldCar Family gratulieren wir Ihnen zu Ihrem Geburtstag und wünschen Ihnen noch viele Jahre Gesundheit und Glück.
                                                                        <?php }else if($user_language_id == 3){ ?>
                                                                        Как семья WorldCar, мы поздравляем вас с днем ​​рождения и желаем вам еще долгих лет здоровья и счастья.
                                                                        <?php }else if($user_language_id == 4){ ?>
                                                                        As the WorldCar Family, we congratulate you on your birthday and wish you many more years of health and happiness.
                                                                        <?php }else if($user_language_id == 5){ ?>
                                                                        Som WorldCar-familien ønsker vi dig tillykke med din fødselsdag og ønsker dig mange flere år med sundhed og lykke.
                                                                        <?php }else if($user_language_id == 6){ ?>
                                                                        Als WorldCar Family feliciteren wij u met uw verjaardag en wensen u nog vele jaren van gezondheid en geluk.
                                                                        <?php }else{ ?>
                                                                        As the WorldCar Family, we congratulate you on your birthday and wish you many more years of health and happiness.
                                                                        <?php } ?></p>
                                                                </th>
                                                            </tr>

                                                            <tr>
                                                                <th>
                                                                    <br/>
                                                                    @if($user_language_id == 1)
                                                                        <p style="line-height: 0;">Saygılarımızla</p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 2)
                                                                        <p style="line-height: 0;">Beste Grüße</p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 3)
                                                                        <p style="line-height: 0;">С наилучшими пожеланиями</p>
                                                                        <p style="line-height:2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 4)
                                                                        <p style="line-height: 0;">Best regards</p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 5)
                                                                        <p style="line-height: 0;">Best regards</p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif

                                                                    @if($user_language_id == 6)
                                                                        <p style="line-height: 0;">
                                                                            Best regards
                                                                        </p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 7)
                                                                        <p style="line-height: 0;">
                                                                            Best regards
                                                                        </p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 8)
                                                                        <p style="line-height: 0;">
                                                                            Best regards
                                                                        </p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif
                                                                    @if($user_language_id == 9)
                                                                        <p style="line-height: 0;">
                                                                            Best regards
                                                                        </p>
                                                                        <p style="line-height: 2;margin-top: 5px;">World Car Rental</p>
                                                                    @endif

                                                                    <table
                                                                        style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                        <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                            <td height="16px"
                                                                                style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:16px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </th>
                                                                <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    {{view('email.mail_footer',['user_language_id' => $user_language_id])}}
                </center>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="yj6qo"></div>
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0" class="adL">&nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    </div>
</div>

</body>
</html>

