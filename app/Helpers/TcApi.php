<?php


namespace App\Helpers;


use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Ekstra;
use App\Models\Location;
use App\Models\PeriodPrice;
use App\Models\Setting;
use DateTime;
use SoapClient;
use stdClass;

class TcApi
{
    public function __construct(string $name,string $lastname,int $birthDayYear, int $tc)
    {

        $adres = "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL";
        $baglanti = new SoapClient($adres);
        $gonder = new stdClass();
        $gonder->TCKimlikNo = $tc;
        $gonder->Ad =  $name;
        $gonder->Soyad = $lastname;
        $gonder->DogumYili = $birthDayYear;
        $sorgu = $baglanti->TCKimlikNoDogrula($gonder);
        return $sorgu->TCKimlikNoDogrulaResult;
    }

    public static function customPeople(string $name,string $lastname,int $birthDayYear,int $birthDayMounth,int $birthDayDay ,string $tc){
        $adres = "https://tckimlik.nvi.gov.tr/Service/KPSPublicYabanciDogrula.asmx?WSDL";
        $baglanti = new SoapClient($adres);
        $gonder = new stdClass();
        $gonder->KimlikNo = $tc;
        $gonder->Ad =  $name;
        $gonder->Soyad = $lastname;
        $gonder->DogumGun = $birthDayYear;
        $gonder->DogumAy = $birthDayMounth;
        $gonder->DogumYil = $birthDayDay;
        $sorgu = $baglanti->YabanciKimlikNoDogrula($gonder);
    }
}