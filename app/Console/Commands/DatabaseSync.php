<?php namespace App\Console\Commands;


use App\Models\Brand;
use App\Models\Car;
use App\Models\Currency as CurrencyModel;
use App\Models\Customer;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\ReservationInformation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use \DB;
use Teknomavi\Tcmb\Doviz;

class DatabaseSync extends Command
{

    protected $signature = 'database:sync';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        $x = DB::connection('mysql3')->table('musteri')->orderBy('MusID','desc')->get()->take(3000);
//        foreach ($x as $item) {
//
//            if ($item->Dil == 3) {
//                $lang = 2;
//            } else if ($item->Dil == 2) {
//                $lang = 4;
//            } else if ($item->Dil == 1) {
//                $lang = 1;
//            }
//            $user = Customer::firstOrCreate(
//                ['email' => $item->Email, 'phone' => $item->CepTel, 'firstname' => $item->Ad],
//                [
//                    'firstname' => $item->Ad,
//                    'lastname' => $item->SoyAd,
//                    'fullname' => $item->Ad . " " . $item->SoyAd,
//                    'email' => $item->Email,
//                    'phone' => $item->CepTel,
//                    'gender' => "men",
//                    'birthday' =>  date('Y-m-d',strtotime($item->DogTar)),
//                    'nationality' => $item->EvUlke,
//                    'password' => bcrypt("12345"),
//                    'birthpalace' => $item->DogYer,
//                    'language' => $lang,
//                    'oldId' => $item->MusID
//                ]
//            );
//        }


        $x = DB::connection('mysql3')->table('rezadd')->get();
        foreach ($x as $item) {
            $reservationtest = Reservation::where('oldId', $item->RezID)->first();
            if (empty($reservationtest)) {
                $reservation = new Reservation();
                $reservation->pnr = "PNR1" . $item->RezID;
                $reservation->phone2 = $this->getTel($item->MusID);
                $reservation->driver_license = 1;
                $reservation->id_language = 1;
                $reservation->nationality = "TÜRKİYE";
                $reservation->payment_method = "debit-cash";
                $reservation->total_amount = $item->ToplamFiyat;
                $reservation->id_currency = 1;
                $reservation->currency_price = "1.00";
                $reservation->sms_send = 1;
                $reservation->email_send = 1;
                $reservation->comfirm_date = $item->OnayDate;
                $reservation->car = $this->getCar($item->Arac);
                $reservation->day_price = $item->GunlukFiyat;
                $reservation->rent_price = $item->ToplamFiyat;
                $reservation->days = $item->KacGun;
                $reservation->status = "comfirm";
                $reservation->plate = $this->getPlate($item->CevapPlaka);
                $reservation->rest = $item->VerFiyat;
                $reservation->up_location = $this->getLocation($item->AlisSehir, $item->AlisYeri);
                $reservation->drop_location = $this->getLocation($item->DonusSehir, $item->DonusYeri);
                $reservation->reservation_source = "phone";
                $reservation->checkin = Carbon::parse($item->VerDate)->format('Y-m-d');
                $reservation->checkout = Carbon::parse($item->DonusDate)->format('Y-m-d');
                $reservation->checkin_time = Carbon::parse($item->VerDate)->format('H:i:s');
                $reservation->checkout_time = Carbon::parse($item->DonusDate)->format('H:i:s');
                $reservation->up_date = Carbon::parse($item->VerDate)->format('H:i:s');
                $reservation->drop_date = Carbon::parse($item->DonusDate)->format('H:i:s');
                $reservation->user_id = 1;
                $reservation->id_customer = $this->getCustomer($item->MusID);
                $reservation->login_customer = 1;
                $reservation->test = 1;
                $reservation->is_survey = 0;
                $reservation->is_notification = 0;
                $reservation->up_time = Carbon::now()->format("H:i:s");
                $reservation->drop_time = Carbon::now()->format("H:i:s");
                $reservation->it_made = "admin-web";
                $reservation->is_letter = 1;
                $reservation->oldId = $item->RezID;
                $reservation->save();
                $id = $reservation->id;


                $reservationinfo = new ReservationInformation();
                $reservationinfo->id_reservation = $id;
                $reservationinfo->checkin = Carbon::parse($item->VerDate)->format('Y-m-d');
                $reservationinfo->checkout = Carbon::parse($item->DonusDate)->format('Y-m-d');
                $reservationinfo->checkin_time = Carbon::parse($item->VerDate)->format('H:i:s');
                $reservationinfo->checkout_time = Carbon::parse($item->DonusDate)->format('H:i:s');
                $reservationinfo->days = $item->KacGun;
                $reservationinfo->up_location = $this->getLocation($item->AlisSehir, $item->AlisYeri);
                $reservationinfo->drop_location = $this->getLocation($item->DonusSehir, $item->DonusYeri);
                $reservationinfo->up_drop_information = null;
                $reservationinfo->save();
            }
        }
    }

    public function getLocation($city, $state)
    {
        $x = DB::connection('mysql3')->table('teslim_yerleri')->where("SehirID", $city)->where("YerId", $state)->first()->YerAdiTr ?? "Antalya Havalimanı Dış Hatlar";
        return LocationValue::where('id_lang', 1)->where('title', "LIKE", "%{$x}%")->first() ?? "31";
    }

    public function getCar($id)
    {
        $x = DB::connection('mysql3')->table('araclar')->where("AracID", $id)->first()->Marka ?? "Fiat";
        $brand = DB::connection('mysql')->table('brands')->where('brandname', "LIKE", "'%{$x}%'")->first()->id ?? "20";
        return DB::connection('mysql')->table('cars')->where('id', $brand)->first()->id ?? 2;
    }

    public function getPlate($plate)
    {
        $newplate = str_replace("-", "", $plate);
        $plates = Plate::where('plate', "LIKE", "%{$newplate}%")->first()->id ?? NULL;
        return $plates;
    }

    public function getTel($tel)
    {
        $x = DB::connection('mysql3')->table('musteri')->where("MusID", $tel)->first()->CepTel ?? "+900000000";
        return $x;
    }

    public function getCustomer($id)
    {
        $x = Customer::where('oldId', $id)->first()->id ?? 181;
        return $x;
    }

}
