<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Console\Command;
use SimpleXMLElement;
use SoapClient;
use SoapHeader;
use stdClass;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $customers = Customer::all();
        foreach ($customers as $customer)
        {
          $x = strstr($customer->phone_country,'+');
          if($x == false)
          {
             $customer->phone_country = '+'.$customer->phone_country;
             $customer->save();
          }

        }

 //  $customers = Customer::all();
 //  foreach ($customers as $customer)
 //  {
 //      $country = Country::where('country_name',$customer->nationality)->first();
 //      if(is_null($customer->phone_country))
 //      {
 //          $customer->phone_country = $country->phone_code ?? NULL;
 //          $customer->save();
 //      }
 //  }

       //$xml = "<Invoices><Invoice><ProfileID>TICARIFATURA</ProfileID><UUID>f4d56ffc-cfc7-4081-b1fe-2d850b28d4fd</UUID><IssueDate>2021-10-19</IssueDate><IssueTime>11:11:00</IssueTime><InvoiceTypeCode>SATIS</InvoiceTypeCode><Note>Fatura Notu</Note><DocumentCurrencyCode>TRY</DocumentCurrencyCode><OrderReference><ID>111111111</ID><IssueDate>2020-01-21</IssueDate></OrderReference><DespatchDocumentReference><ID>222222222</ID><IssueDate>2020-01-21</IssueDate></DespatchDocumentReference><AccountingCustomerParty><Party><PartyIdentification><ID>11111111111</ID></PartyIdentification><PartyName><Name>1Engin Ersoy</Name></PartyName><PostalAddress><BuildingName>Kışla Mah. Milli Egemenlik Cad.</BuildingName><CitySubdivisionName>Muratpaşa</CitySubdivisionName><CityName>Antalya</CityName><Country><IdentificationCode>TR</IdentificationCode><Name>TÜRKİYE</Name></Country></PostalAddress><Contact><Mail>enginersoy07@gmail.com</Mail><Phone>05359668395</Phone></Contact><Person><FirstName>Engin</FirstName><FamilyName>Ersoy</FamilyName></Person></Party></AccountingCustomerParty><PaymentMeans><PaymentMeansCode>10</PaymentMeansCode><PaymentChannelCode>In cash</PaymentChannelCode><PayeeFinancialAccount><ID>TR111234567891234567891234</ID></PayeeFinancialAccount></PaymentMeans><PaymentTerms><PaymentDueDate>2020-01-21</PaymentDueDate></PaymentTerms><AllowanceCharge><ChargeIndicator>false</ChargeIndicator><Amount>100</Amount></AllowanceCharge><InvoiceLines><InvoiceLine><Note>Satır Notu</Note><InvoicedQuantity>1</InvoicedQuantity><AllowanceCharge><MultiplierFactorNumeric>10</MultiplierFactorNumeric></AllowanceCharge><TaxTotal><TaxSubtotal><Percent>8</Percent><TaxCategory><TaxScheme><Name>KATMA DEĞER VERGİSİ</Name><TaxTypeCode>0015</TaxTypeCode></TaxScheme></TaxCategory></TaxSubtotal></TaxTotal><Item><Name>BİLNEX MUHASEBE PROGRAMI</Name><SellersItemIdentification><ID>1000</ID></SellersItemIdentification></Item><Price><PriceAmount>1000</PriceAmount></Price></InvoiceLine></InvoiceLines></Invoice></Invoices>";
       //$xml = htmlspecialchars($xml, ENT_XML1, 'UTF-8');
       // //        $user = DB::table('users')->where('id', $user)->first();
       // // $xml = json_encode($xml);
       //$soapUrl = "https://ebilnex.bilnex.com.tr/WebService/Invoices.asmx?WSDL";

       //$stream_context = [
       //    'http' => [
       //        'header'        => 'authType: 2WAYSSL',
       //        'content_type'  => 'text/xml;charset=utf-8',
       //    ]
       //];

       //$baglantix = new SoapClient("https://ebilnex.bilnex.com.tr/WebService/Invoices.asmx?WSDL", ['stream_context' => stream_context_create($stream_context)]);
       //$gonderx = new stdClass();
       //$gonderx->Token = "3230512384";
       //$gonderx->SupplierTaxNumber = "3230512384";
       //$gonderx->BranchCode = "1";
       //$gonderx->Xml = $xml;
       //$gonderx->Ubl = "0";
       //$gonderx->CustomerPK = "enginersoy07@gmail.com";
       //$gonderx->CustomerCode = "11111111111";
       //$nsorgux = $baglantix->addInvoices($gonderx);
       //print_r($nsorgux);
    }
}
