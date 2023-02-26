<html>
<style>

</style>
<body>
@csrf

@if($user_language_id == 1)
    <?php
    $text2 = "Şifremi Değiştir";
    ?>
@endif
@if($user_language_id == 2)
    <?php
    $text2 = "Ändere mein Passwort";
    ?>
@endif
@if($user_language_id == 3)
    <?php
    $text2 = "Изменить свой пароль";
    ?>
@endif
@if($user_language_id == 4)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
@if($user_language_id == 5)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
@if($user_language_id == 6)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
@if($user_language_id == 7)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
@if($user_language_id == 8)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
@if($user_language_id == 9)
    <?php
    $text2 = "Change My Password";
    ?>
@endif
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
                            <td height="20px"  style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:400;line-height:20px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                &nbsp;
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    {{view('email.mail_header')}}

                    <table class="CToWUdCENTER" align="center" style="margin:0 auto;background:#fff;border:1px solid #e8e8e8;border-collapse:collapse;border-spacing:0;border-top:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:700px">
                        <tbody>
                        <tr style="padding:0;text-align:left;vertical-align:top">
                            <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                <table align="center" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                    <tbody>
                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:30px 20px;text-align:left;vertical-align:top;word-wrap:break-word">
                                            <table style="border-collapse:collapse;border-spacing:0;display:table;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="margin:0 auto;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0 auto;padding:0;padding-bottom:0;padding-left:16px;padding-right:16px;text-align:left;width:564px">
                                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                                <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left">
                                                                    <?php
                                                                    $dizge = $template->template;
                                                                    $sablonlar = array();
                                                                    $sablonlar[0] = '/{token}/';
                                                                    $sablonlar[1] = '/{fullname}/';
                                                                    $yeniler = array();
                                                                    $yeniler[0] = $token;
                                                                    $yeniler[1] = $customer->fullname;
                                                                    echo preg_replace($sablonlar, $yeniler, $dizge);
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    <table
                                                                        style="margin:0 0 20px 0;border-collapse:collapse;border-spacing:0;margin:0 0 20px 0;padding:0;text-align:left;vertical-align:top;width:100%!important">
                                                                        <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                            <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                <table
                                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                                    <tbody>
                                                                                    <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                        <td style="margin:0;background:#198144;border:none;border-collapse:collapse!important;border-radius:5px;color:#fff;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                            <center
                                                                                                style="min-width:0;width:100%">
                                                                                                <a href="{{url('/'.app()->getLocale().'/resetpassword?token='.$token)}}"
                                                                                                   align="center"
                                                                                                   style="margin:0;border:0 solid #198144;border-radius:3px;color:#fff;display:inline-block;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:700;line-height:1.4;margin:0;padding:12px 16px 12px 16px;padding-left:0;padding-right:0;text-align:center;text-decoration:none;width:100%"
                                                                                                   rel="noreferrer"
                                                                                                   target="_blank"><?=$text2?></a>
                                                                                            </center>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0!important;text-align:left;vertical-align:top;width:0;word-wrap:break-word"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    <p><strong>Saygılarımızla,</strong></p>
                                                                    <p>World Car Rental</p>
                                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                        <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                            <td height="16px" style="margin:0;border-collapse:collapse!important;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:16px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
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
</div>

</body>
</html>
