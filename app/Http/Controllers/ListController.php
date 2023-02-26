<?php

namespace App\Http\Controllers;


use App\Jobs\AccessReportJob;
use App\Models\Language;
use App\Repository\Data;
use App\Service\CurrencyService;
use App\Service\EkstraCalculate;
use App\Service\Search;
use App\Models\Camping;
use App\Models\Location;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Session;
use Redis;

class ListController extends Controller
{
    protected $language = 1;
    protected $searchData;
    protected $langId;
    protected $campaing;
    public $redis;
    public $outside_discount;
    public $outside_country;

    public function __construct()
    {
        $this->langId = Language::where("url", request()->segment(1))->first()->id;
        $this->campaing = new Camping();
        $this->redis = new Redis();
        $this->redis->connect('localhost',6379);

        $this->outside_country = $this->localCountry();

        if($this->outside_country != "TR")
        {
            $this->outside_discount = $this->staticData()['countryDiscount'];
        }else{
            $this->outside_discount = 0;
        }
        dispatch(new AccessReportJob('search'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->redis->flushAll();

        $data = $request->request->all();
        $this->redis->set($this->cacheResponseId(),json_encode($data));

        $this->redis->set("currency","EUR_EUR");
        Session::put(['currecyIcon' => "€"]);

        $data['static'] = $this->staticData();
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] =  Data::getNowTime();
        //$data["cars"] = Search::calculate($data,"EUR_EUR");

        $data["checkin"] = $request->cikis_tarihi_submit;
        $data["checkout"] = $request->donus_tarihi_submit;
        $data["pick_up_time"] = $request->cikis_saati_submit;
        $data["pick_down_time"] =$request->donus_saati_submit;
        $data["pick_up_main_id"] =  Search::getPickupMain($request->pick_up_location);
        $data["pick_up_name"] =  Search::getLocationName($request->pick_up_location) ?? "Bulunamadı";
        if(empty($request->is_active_select))
        {
            $data["is_active_select"] = "off";
            $data["return_location"] = array();
            $data["pick_up_location"] =$request->pick_up_location;
            $data["pick_down_location"] =$request->pick_up_location;
            $data["pick_drop_name"] =  Search::getLocationName($request->pick_up_location);
        }else{
            $end_location = $request->end_point=='' ? $request->pick_up_location:$request->end_point;
            $data["is_active_select"] = "on";
            $data["return_location"] = Search::getDropLocation($request->pick_up_location);
            $data["pick_up_location"] =$request->pick_up_location;
            $data["pick_down_location"] = $end_location;
            $data["pick_drop_main_id"] =  Search::getPickupMain($end_location);
            $data["pick_drop_name"] =  Search::getLocationName($end_location);
        }
        $data["category"] = Data::getCategorys();
        $data["currency"] = "€";
        $data["currencySTRING"] = $this->redis->get("currency");
        //$data["list"] = $this->get_list_cars();
        return view('view.lists',['data' => $data]);
    }

    public function get_list_cars($z,$currency)
    {
         $ekstracalculate = new EkstraCalculate();
         $currencyResponse = new CurrencyService($currency);
         $currencyData = $currencyResponse->getCurrency();

         $responseData = json_decode($this->redis->get($this->cacheResponseId()),true);
         $data = new Search($responseData,$currencyData,$this->outside_discount);
         $data = $data->index();
         $ekstra =  $ekstracalculate->ekstraAll($responseData,$currencyData);
         $ex = explode("_",$currency);
         $kur = $ex[1];
         if($kur =="EUR"){$currency = "€"; }else if($kur == "USD"){$currency = "$";}else if($kur == "TRY"){$currency = "₺";}else{$currency = "£";}
         Session::put(['currecyIcon' => $currency]);
        return view('view.listcar', ['data' => $data,'kur' => $kur,'responseData'=>$responseData,'ekstras'=> $ekstra,'currency' => $currency,'currencyData' => $currencyData,'langId'=>$this->langId]);
     }


    public function newlists(Request $request)
    {
        $this->redis->flushAll();

        $data = $request->request->all();
        $this->redis->set($this->cacheResponseId(),json_encode($data));

        $this->redis->set("currency","EUR_EUR");
        Session::put(['currecyIcon' => "€"]);

        $data['static'] = $this->staticData();
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] =  Data::getNowTime();
        //$data["cars"] = Search::calculate($data,"EUR_EUR");

        $data["checkin"] = $request->cikis_tarihi_submit;
        $data["checkout"] = $request->donus_tarihi_submit;
        $data["pick_up_time"] = $request->cikis_saati_submit;
        $data["pick_down_time"] =$request->donus_saati_submit;
        $data["pick_up_main_id"] =  Search::getPickupMain($request->pick_up_location);
        $data["pick_up_name"] =  Search::getLocationName($request->pick_up_location) ?? "Bulunamadı";
        if(empty($request->is_active_select))
        {
            $data["is_active_select"] = "off";
            $data["return_location"] = array();
            $data["pick_up_location"] =$request->pick_up_location;
            $data["pick_down_location"] =$request->pick_up_location;
            $data["pick_drop_name"] =  Search::getLocationName($request->pick_up_location);
        }else{
            $end_location = $request->end_point=='' ? $request->pick_up_location:$request->end_point;
            $data["is_active_select"] = "on";
            $data["return_location"] = Search::getDropLocation($request->pick_up_location);
            $data["pick_up_location"] =$request->pick_up_location;
            $data["pick_down_location"] = $end_location;
            $data["pick_drop_main_id"] =  Search::getPickupMain($end_location);
            $data["pick_drop_name"] =  Search::getLocationName($end_location);
        }
        $data["category"] = Data::getCategorys();
        $data["currency"] = "€";
        //$data["list"] = $this->get_list_cars();
        return view('view.newlists',['data' => $data]);
    }
}
