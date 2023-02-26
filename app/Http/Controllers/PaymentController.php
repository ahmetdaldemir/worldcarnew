<?php


namespace App\Http\Controllers;


use App\Service\PaymentService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public function testpayment()
    {
        return view('test');
    }

    public function odemeyap(Request $request)
    {
        $cardHolder = array(
            'name' => "Ahmet DALDEMİR",
            'cardnumber' => $request->cardnumber,
            'exp_date_mounth' => $request->exp_date_mounth,
            'exp_date_year' => $request->exp_date_year,
            'cvc' => $request->cvv,
            'price' => "1.00", //$requestdata['last_price'],
            'pnr' => 'I' . rand(11111, 99999),
        );

        $x = new PaymentService($cardHolder);
    }

    public function checkoutFail(Request $request)
    {
        dd($request);
    }

    public function checkoutSucces(Request $request)
    {


        $PostUrl = 'https://onlineodeme.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx'; //Dokümanda yer alan Prod VPOS URL i. Testlerinizi test ortamýnda gerçekleþtiriyorsanýz dokümandaki test URL ini kullanmalýsýnýz.
        $IsyeriNo = "000000000159616";
        $TerminalNo = "VP195680";
        $IsyeriSifre = "k5LKd04Y";
        $KartNo = $request["Pan"];

        $KartCvv = 311;
        $Tutar = $request["PurchAmount"];
        $SiparID = $request["VerifyEnrollmentRequestId"];
        $IslemTipi = "Sale";
        $TutarKodu = $request["PurchCurrency"];
        $ClientIp = "212.2.199.55"; // ödemeyi gerçekleþtiren kullanýcýnýn IP bilgisi alýnarak bu alanda gönderilmelidir.
//$Taksit     = $_POST["InstallmentCount"];
        $PosXML = 'prmstr=<VposRequest><MerchantId>' . $IsyeriNo . '</MerchantId><Password>' . $IsyeriSifre . '</Password><TerminalNo>' . $TerminalNo . '</TerminalNo><TransactionType>' . $IslemTipi . '</TransactionType><TransactionId>' . $SiparID . '</TransactionId>';
        $PosXML = $PosXML . '<CurrencyAmount>' . $Tutar . '</CurrencyAmount><CurrencyCode>' . $TutarKodu . '</CurrencyCode><Pan>' . $KartNo . '</Pan><Expiry>' . $request["Expiry"] . '</Expiry>';
        $PosXML = $PosXML . '<Cvv>' . $KartCvv . '</Cvv><TransactionDeviceSource>0</TransactionDeviceSource><ClientIp>' . $ClientIp . '</ClientIp></VposRequest>';

        echo '<h1>Vpos Request</h1>';
        echo $PostUrl . "<br>";
        echo '<textarea rows="15" cols="60">' . $PosXML . '</textarea>';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $PostUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $PosXML);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 59);
        curl_setopt($ch, curl . options, array("CURLOPT_SSLVERSION" => "CURL_SSLVERSION_TLSv1_1"));
// curl_setopt ($ch, CURLOPT_CAINFO, "c:/php/ext/cacert.pem");

        $result = curl_exec($ch);

// Check for errors and display the error message
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);

        echo '<h1>Vpos Response</h1>';
        echo '<textarea rows="15" cols="60">' . $result . '</textarea>';


        $token = csrf_token();

        $x = 'prmstr=< LKd04Y</Password><Terminal .  . ' </Expiry ><CurrencyAmount > ' . $ . '</CurrencyAmount ><CurrencyCode > ' . $request["PurchCurrency"] . '</CurrencyCode ><TransactionType > Sale</TransactionType ><CardHoldersName > Ahmet DALDEMİR </CardHoldersName ><Cvv > 582</Cvv ><ECI > ' . $request["Eci"] . '</ECI ><CAVV > ' . $request["Cavv"] . '</CAVV ><MpiTransactionId > ' . $request["VerifyEnrollmentRequestId"] . '</MpiTransactionId ><OrderId > ' . $request["VerifyEnrollmentRequestId"] . '</OrderId ><OrderDescription > Bu bir bilet satışı işlemidir </OrderDescription ><ClientIp > '.\request()->ip().'</ClientIp ><CustomItems ><Item name = "İsim" value = "İLYAS" /><Item name = "Soyisim" value = "KOVALAR" /><Item name = "Açıklama" value = "EĞİTİM ÜCRETİ" /></CustomItems ><TransactionDeviceSource > 0</TransactionDeviceSource ><DeviceType > 3</DeviceType ><Location > 1</Location ></VposRequest > ';
        $headers = array(
            "Content-Type: application/xml",
            "Accept: application/xml",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onlineodeme.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_SSLVERSION, "CURL_SSLVERSION_TLSv1_1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $x);
        curl_setopt($ch, CURLOPT_TIMEOUT, 59);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
         $resultXml = curl_exec($ch);
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);
        dd($resultXml);
    }


}
