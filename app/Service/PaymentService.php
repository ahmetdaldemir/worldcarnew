<?php


namespace App\Service;

use App\Contracts\Payment;
use DOMDocument;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;


class PaymentService
{

    public function __construct($data)
    {
        $mpiServiceUrl = "https://3dsecure.vakifbank.com.tr/MPIAPI/MPI_Enrollment.aspx";
        $krediKartiNumarasi = $data['cardnumber'];
        $sonKullanmaTarihi = $data['exp_date_year'].$data['exp_date_mounth'];
        $kartTipi = "200";
        $tutar = '1.00';
        $paraKodu = "949";
        $taksitSayisi = "";
        $islemNumarasi = $data['pnr'];
        $uyeIsyeriNumarasi = "000000000159616";
        $uyeIsYeriSifresi = "k5LKd04Y";
        $SuccessURL = "https://worldcarrental.com/checkoutSucces";
        $FailureURL = "https://worldcarrental.com/checkoutFail";
        $ekVeri = "";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $mpiServiceUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            'x-csrf-token: ' . csrf_token(),
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type" => "application/x-www-form-urlencoded"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "Pan=$krediKartiNumarasi&ExpiryDate=$sonKullanmaTarihi&PurchaseAmount=$tutar&Currency=$paraKodu&BrandName=$kartTipi&VerifyEnrollmentRequestId=$islemNumarasi&SessionInfo=$ekVeri&MerchantId=$uyeIsyeriNumarasi&MerchantPassword=$uyeIsYeriSifresi&SuccessUrl=$SuccessURL&FailureUrl=$FailureURL&InstallmentCount=$taksitSayisi");

        // Ýþlem isteði MPI'a gönderiliyor
        $resultXml = curl_exec($ch);
        curl_close($ch);
        // Sonuç XML'i yorumlanýp döndürülüyor
        $result = $this->sonuc($resultXml);
print_r($result);

        if ($result["Status"] == "Y") {
            print('<form method="post" name="downloadForm" action="' . $result['ACSUrl'] . '" id="three_d_form" style="display: none">');
            print(csrf_token());
            print('<input type="hidden" name="PaReq" value="' . $result['PaReq'] . '">');
            print('<input type="hidden" name="TermUrl" value="' . $result['TermUrl'] . '" >');
            print('<input type="hidden" name="MD" value="' . $result['MerchantData'] . '" >');
            print('<input type="submit" value="Gonder" style="display:none"/>');
            print('</form>');
            print('<script>document.getElementById("three_d_form").submit();</script>');
        }
    }

    public function sonuc($result)
    {
        $resultDocument = new DOMDocument();
        $resultDocument->loadXML($result);

        //Status Bilgisi okunuyor
        $statusNode = $resultDocument->getElementsByTagName("Status")->item(0);
        $status = "";
        if ($statusNode != null)
            $status = $statusNode->nodeValue;

        //PAReq Bilgisi okunuyor
        $PAReqNode = $resultDocument->getElementsByTagName("PaReq")->item(0);
        $PaReq = "";
        if ($PAReqNode != null)
            $PaReq = $PAReqNode->nodeValue;

        //ACSUrl Bilgisi okunuyor
        $ACSUrlNode = $resultDocument->getElementsByTagName("ACSUrl")->item(0);
        $ACSUrl = "";
        if ($ACSUrlNode != null)
            $ACSUrl = $ACSUrlNode->nodeValue;

        //Term Url Bilgisi okunuyor
        $TermUrlNode = $resultDocument->getElementsByTagName("TermUrl")->item(0);
        $TermUrl = "";
        if ($TermUrlNode != null)
            $TermUrl = $TermUrlNode->nodeValue;

        //MD Bilgisi okunuyor
        $MDNode = $resultDocument->getElementsByTagName("MD")->item(0);
        $MD = "";
        if ($MDNode != null)
            $MD = $MDNode->nodeValue;

        //MessageErrorCode Bilgisi okunuyor
        $messageErrorCodeNode = $resultDocument->getElementsByTagName("MessageErrorCode")->item(0);
        $messageErrorCode = "";
        if ($messageErrorCodeNode != null)
            $messageErrorCode = $messageErrorCodeNode->nodeValue;

        // Sonuç dizisi oluþturuluyor
        $result = array
        (
            "Status" => $status,
            "PaReq" => $PaReq,
            "ACSUrl" => $ACSUrl,
            "TermUrl" => $TermUrl,
            "MerchantData" => $MD,
            "MessageErrorCode" => $messageErrorCode
        );
        return $result;

    }
}
