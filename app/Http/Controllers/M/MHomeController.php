<?php

namespace App\Http\Controllers\M;

use App\Http\Controllers\Controller;
use App\Jobs\AccessReportJob;
use App\Models\Camping;
use App\Models\Language;
use App\Models\Location;
use App\Models\MobilSlider;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repository\Data;

class MHomeController extends Controller
{
    public function __construct(CarRepositoryInterface $cars)
    {
 //     $this->middleware('auth');
        $this->campaing = new Camping();
        $this->cars = $cars;
        $this->setting = $cars;
        dispatch(new AccessReportJob('normal'));
     }
    public function lang($id)
    {
        if ($id != 1) {
            $lang = Language::where("id", $id)->first();
            session()->put('lang', $id);
            session()->put('title', $lang->short);
            session()->put('flag', $lang->flag);
            return redirect()->back();
        } else {
            session()->put('lang', 1);
            session()->put('title', "TR");
            session()->put('flag', "tr.png");
            return redirect()->back();
        }
    }
    public function index()
    {
        $data['static'] = $this->staticData();
        $data["checkin"] = date('Y-m-d', strtotime(' + 1 days'));
        $data["checkout"] = date('Y-m-d', strtotime(' + 8 days'));
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"]     = Data::getNowTime();
        $data["mobil_sliders"] = MobilSlider::all();
        $data["center_location"] = Location::getViewCenter();

        return view('m.index', ['data' => $data]);
    }

}
