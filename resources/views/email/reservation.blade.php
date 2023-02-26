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
                                                                    $sablonlar[0] = '/{email}/';
                                                                    $sablonlar[1] = '/{password}/';
                                                                    $sablonlar[2] = '/{fullname}/';
                                                                    $yeniler = array();
                                                                    $yeniler[0] = $email;
                                                                    $yeniler[1] = $password;
                                                                    $yeniler[2] = $fullname;
                                                                    echo preg_replace($sablonlar, $yeniler, $dizge);
                                                                    ?>
                                                                </th>
                                                            </tr>
                                                            </tbody>
                                                            <tbody>
                                                             <tr>
                                                              {{view('email.email_footer_thanks',["user_language_id" => $user_language_id])}}
                                                            </tr>
                                                            </th>
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
                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">

                        <tbody>
                        <tr>
                            <th style="margin:0;color:#717171;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.6;margin:0;padding:0!important;text-align:left;width:0"></th>
                        </tr>
                        </tbody>
                    </table>
                    {{view('email.mail_footer',["user_language_id" => $user_language_id])}}
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
