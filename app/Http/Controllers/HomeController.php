<?php

namespace App\Http\Controllers;

use App\Jobs\AccessReportJob;
use App\Jobs\SendEmailJob;
use App\Jobs\SiteMailJob;
use App\Mail\SiteSendMail;
use App\Models\Reservation;
use App\Models\ReservationSurvey;
use App\Models\Survey;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repository\Data;
use App\Models\Camping;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Ekstra;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\Language;
use App\Models\Exchange;
use App\Models\TransferZoneFee;
use App\Service\CurrencyService;
use App\Service\Search;
use App\Traits\AccessReportTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Redis;

class HomeController extends Controller
{

    protected $language = 1;
    protected $campaing;
    protected $uuid;

    public function __construct(CarRepositoryInterface $cars)
    {
//        $this->middleware('auth');
        $this->campaing = new Camping();
        $this->cars = $cars;

        dispatch(new AccessReportJob('normal'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['static'] = $this->staticData();
        $data["checkin"] = date('Y-m-d', strtotime(' + 1 days'));
        $data["checkout"] = date('Y-m-d', strtotime(' + 8 days'));
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(18, 'default');
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] = Data::getNowTime();
        $data["car"] = $this->cars->all();
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data["country"] = DB::table("countries")->get();
        return view('view.home', ['data' => $data]);
    }

    public function widget()
    {

        $data['static'] = $this->staticData();
        $data["checkin"] = date('Y-m-d', strtotime(' + 1 days'));
        $data["checkout"] = date('Y-m-d', strtotime(' + 8 days'));
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(18, 'default');
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] = Data::getNowTime();
        $data["car"] = $this->cars->all();
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data["country"] = DB::table("countries")->get();
        $data["language"] = Language::all();
        return view('view.widget', ['data' => $data]);
    }

    public function comfirm(Request $request)
    {
        if ($request->token == null) {
            $data['static'] = $this->staticData();
            return view('view.comfirmerror', ['data' => $data]);
        } else {
            $decode = base64_decode($request->token);
            $tokenParts = explode(".", $decode);
            $tokenHeader = base64_decode($tokenParts[0]);
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtHeader = json_decode($tokenHeader);
            $jwtPayload = json_decode($tokenPayload);
            $current_time = \Carbon\Carbon::now()->timestamp;
            $reservation = Reservation::find($jwtPayload->id_reservation);
            $data['static'] = $this->staticData();
            $data['reservation'] = $reservation;
            $key = "worldcar.com";
            $decode = JWT::decode($decode, $key, array('HS256'));

            $reservation->status = Reservation::RESERVATION_STATUS_COMFIRM;
            $reservation->comfirm_date = Carbon::now()->format('Y-m-d H:i:s');
            $reservation->save();
            return view('view.comfirm', ['data' => $data, 'reservation' => $reservation, 'status' => 'success']);

        }

//        if ($reservation->status == Reservation::RESERVATION_STATUS_WAIT) {
//            if ($current_time <= $jwtPayload->exp) {
//                $key = "worldcar.com";
//                $decode = JWT::decode($decode, $key, array('HS256'));
//
//                $reservation->status = Reservation::RESERVATION_STATUS_COMFIRM;
//                $reservation->comfirm_date = Carbon::now()->format('Y-m-d H:i:s');
//                $reservation->save();
//                return view('view.comfirm', ['data' => $data, 'reservation' => $reservation,'status' => 'success']);
//            } else {
//                return view('view.comfirm', ['data' => $data,'status' => 'failure', 'message' =>'Komfirme Süresi Doldu','reservation' => $reservation]);
//            }
//        } else {
//            return view('view.comfirm', ['data' => $data,'status' => 'success',  'message' =>'Daha önce komfirme işlemi yapıldı','reservation' => $reservation]); //TODO Bu alan status bilinçli olarak success yapıldı. Arayüzde daha önce comfirme yapıldı yazmasın diye
//        }
    }


    public function survey(Request $request)
    {
        $data['static'] = $this->staticData();

        if ($request->token == null) {
            return redirect()->to('/');
        } else {
            $decode = base64_decode($request->token);
            $tokenParts = explode(".", $decode);
            $tokenHeader = base64_decode($tokenParts[0]);
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtHeader = json_decode($tokenHeader);
            $jwtPayload = json_decode($tokenPayload);
            $reservationsurvey = ReservationSurvey::where('id_reservation', $jwtPayload->id_reservation)->count();
            if ($reservationsurvey != 0) {
                return redirect()->to('/');
            }
            $current_time = \Carbon\Carbon::now()->timestamp;
            $reservation = Reservation::find($jwtPayload->id_reservation);
            $survey = Survey::all();
            return view('view.survey', ['data' => $data, 'reservation' => $reservation, 'surveys' => $survey]);
        }

    }

    public function surveysave(Request $request)
    {
        $surveyanswer = new ReservationSurvey();
        $surveyanswer->id_reservation = base64_decode($request->id_reservation);
        $surveyanswer->answers = json_encode(serialize($request->receipt));
        $surveyanswer->save();
        return redirect()->to('/');
    }

    public function all_destination()
    {
        $data['static'] = $this->staticData();
        $data["all_destinations"] = Data::getDestinations();
        $data["destinationsImage"] = Data::getPageImage("destinations");

        return view('view.all_destination', ['data' => $data]);
    }

    public function all_comments()
    {

        $data['static'] = $this->staticData();
        $data["all_comments"] = Data::getComments();
        $data["commentImage"] = Data::getPageImage("commentImage");

        return view('view.all_comments', ['data' => $data]);
    }

    public function destination_detail($lang, $slug, $id)
    {
        $data['static'] = $this->staticData();
        $data["checkin"] = date("Y-m-d");
        $data["checkout"] = date('Y-m-d', strtotime(' + 7 days'));
        $data["center_location"] = Location::getViewCenter();
        $data["nowTime"] = Data::getNowTime();

        Session::put(['currecyIcon' => "€"]);

        $data['static'] = $this->staticData();
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] = Data::getNowTime();
        //$data["cars"] = Search::calculate($data,"EUR_EUR");

        $data["checkin"] = date('Y-m-d', strtotime(' + 1 days'));
        $data["checkout"] = date('Y-m-d', strtotime(' + 8 days'));
        $data["pick_up_time"] = (date("H") + 1) . ':00';
        $data["pick_down_time"] = (date("H") + 1) . ':00';
        $data["pick_up_main_id"] = Search::getPickupMain(9);
        $data["pick_up_name"] = Search::getLocationName(9);
        $data["category"] = Data::getCategorys();
        $data["is_active_select"] = "off";
        $data["return_location"] = array();
        $data["pick_up_location"] = 9;
        $data["pick_down_location"] = 9;
        $data["pick_drop_name"] = Search::getLocationName(9);
        $data["destination"] = Data::getDestinationsId($id);
        $data["destinations"] = Data::getSubDestinations($id);
        return view('view.destination_detail', ['data' => $data]);
    }

    public function info_destination($slug, $id)
    {
        $data['static'] = $this->staticData();
        $data["checkin"] = date("Y-m-d");
        $data["checkout"] = date('Y-m-d', strtotime(' + 7 days'));
        $data["destinations"] = Data::getDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts();
        $data["center_location"] = Location::getViewCenter();
        $data["nowTime"] = Data::getNowTime();
        return view('view.info_destination', ['data' => $data]);
    }

    public function blogDetail($lang, $slug, $id)
    {
        $data['static'] = $this->staticData();
        $data["checkin"] = date("Y-m-d");
        $data["checkout"] = date('Y-m-d', strtotime(' + 7 days'));
        $data["blog"] = Data::getBlog($id);
        $data["blogImage"] = Data::getPageImage("blog");
        $data["blogs"] = Data::getAllBlogs();
        $data["id"] = $id;
        if (!$data["blog"]) {
            return redirect()->to('/');
        }
        return view('view.blog_detail', ['data' => $data]);
    }

    public function all_blogs()
    {
        $data['static'] = $this->staticData();
        $data["all_blogs"] = Data::getAllBlogs();
        $data["blogAllImage"] = Data::getPageImage("bloglist");
        return view('view.all_blog', ['data' => $data]);
    }

    public function all_campain()
    {
        $data['static'] = $this->staticData();
        $data["all_campain"] = Data::getAllCampaings();
        $data["all_CampainImage"] = Data::getPageImage("all_campain");
        return view('view.all_campain', ['data' => $data]);
    }

    public function campainDetail($lang, $slug, $id)
    {
        $data['static'] = $this->staticData();
        $data["all_campain"] = Data::getCampaings($id);
        $data["center_location_pick_up"] = Location::getViewCenterInId($id);
        $data["checkin"] = date('Y-m-d', strtotime(' + 1 days'));
        $data["checkout"] = date('Y-m-d', strtotime(' + 8 days'));
        $data["ekstras"] = Ekstra::all();
        $data["id_campain"] = $id;
        $data["campainImage"] = Data::getPageImage("campain");
        $data['langId'] = Language::where("url", app()->getLocale())->first()->id;

        $currency = "EUR_EUR";
        $currencyResponse = new CurrencyService($currency);
        $data['currencyData'] = $currencyResponse->getCurrency();
        $data['currency'] = '€';

        $data["center_location"] = Location::getViewCenter();
        return view('view.campain_detail', ['data' => $data]);
    }

    public function police()
    {
        $data['static'] = $this->staticData();
        return view('view.texts', ['data' => $data]);
    }

    public function policedata()
    {
        $data['static'] = $this->staticData();
        $data["text"] = Data::getText(3);
        $data["id"] = 3;
        return view('view.police', ['data' => $data]);
    }

    public function useProcess()
    {
        $data['static'] = $this->staticData();
        return view('view.useProcess', ['data' => $data]);
    }

    public function texts($lang, $slug, $id)
    {
        $data['static'] = $this->staticData();
        $data["text"] = Data::getText($id);
        $data["texts"] = Data::getTextForCategoryAll($slug);
        $data["id"] = $id;
        $data['type'] = "page";
        return view('view.texts', ['data' => $data]);
    }

    public function contact()
    {
        $data['static'] = $this->staticData();
        $data["contactImage"] = Data::getPageImage("contact");
        return view('view.contact', ['data' => $data]);
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

    public function create_comment(Request $request)
    {

        $categopy = new Comment();
        $categopy->firstname = $request->firstname;
        $categopy->lastname = $request->lastname;
        $categopy->email = $request->email;
        $categopy->description = $request->description;
        $categopy->star = $request->star;
        $categopy->car = $request->car;
        $categopy->country = $request->country;
        $categopy->ip = Data::getClientIps();
        $categopy->save();
        return redirect()->back()->with('warning', __("Yorum Gönderildi"));

    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function staticPage($lang, $slug)
    {
        $data['static'] = $this->staticData();
        $data["text"] = Data::getTextSlug($slug);
        $data["category"] = Data::getTextForCategoryAll($slug);
        return view('view.staticPage', ['data' => $data]);
    }

    public function about($lang, $slug)
    {
        $data['static'] = $this->staticData();
        $data["text"] = Data::getAbout();

        $data["Image"] = Data::getPageImage("about_us");
        return view('view.about', ['data' => $data]);
    }

    public function getDropLocation(Request $request)
    {
        $language_id = 1;
        $location = array();
        $langId = Language::where("url", $request->langId)->first();
        if ($langId) {
            $language_id = $langId->id;
        }
        if ($request->id == 0) {
            $locations = Location::where("id_parent", 0)->orderBy('sort', "asc")->get();
            foreach ($locations as $item) {
                $locatiValue = LocationValue::where("id_location", $item->id)->where("id_lang", $language_id)->first();
                $location[] = array(
                    'id' => $item->id,
                    'title' => $locatiValue->title,
                    'id_parent' => $item->id_parent,
                    'type' => $locatiValue->type,
                    'parentList' => Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('locations.id_parent', $item->id)->where('location_values.id_lang', $language_id)->orderBy('locations.id', "asc")->get(),
                );

            }
        } else {
            $id_location = Location::find($request->id)->id_parent;
            $transferLocation = TransferZoneFee::where("id_location", $id_location)->where("status", 1)->orderBy('id_location_transfer_zone', 'asc')->get();
            foreach ($transferLocation as $item) {
                $locatiValue = LocationValue::where("id_location", $item->id_location_transfer_zone)->where("id_lang", $language_id)->first();
                $location[] = array(
                    'id' => $item->id_location_transfer_zone,
                    'title' => $locatiValue->title,
                    'id_parent' => Location::find($item->id_location_transfer_zone)->id_parent,
                    'type' => $locatiValue->type,
                    'parentList' => Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('locations.id_parent', $item->id_location_transfer_zone)->where('location_values.id_lang', $language_id)->orderBy('locations.id', "asc")->get(),
                );
            }
        }
        return $location;
    }


    public function mail_send(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        if ($validator->fails()) {
            return back()->withErrors([
                'email' => '*',
                'firstname' => '*',
                'lastname' => '*',
                'phone' => '*',
                'message' => '*',
                'g-recaptcha-response' => 'Robot Olmadığınızı Doğrulayın',
            ]);
        }
        $this->dispatch(new SiteSendMail($request));
        return redirect()->back()->withErrors(['msg' => trans('mail_send', [], request()->segment(1))]);
    }

    public function exchangeupdate()
    {
        $url = "http://api.exchangeratesapi.io/latest?access_key=5cff66816d3f2f7855f29fc646b042c0&from=EUR";
        $content = file_get_contents($url);
        $row = json_decode($content);
        $result = $row->rates;

        Exchange::where('sort', "EUR")->update(['exchange' => $result->EUR]);
        Exchange::where('sort', "USD")->update(['exchange' => $result->USD]);
        Exchange::where('sort', "TRY")->update(['exchange' => $result->TRY]);
        Exchange::where('sort', "DKK")->update(['exchange' => $result->DKK]);
        Exchange::where('sort', "NOK")->update(['exchange' => $result->NOK]);
        Exchange::where('sort', "GBP")->update(['exchange' => $result->GBP]);

        return redirect()->back();
    }

    public function getMounthReservation()
    {
        $result = CarbonPeriod::create('Y-01-01', '1 month', 'Y-12-01');

        foreach ($result as $dt) {
            echo $dt->format("m");
        }
    }


}
