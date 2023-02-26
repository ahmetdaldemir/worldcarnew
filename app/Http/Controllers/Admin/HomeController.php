<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Repositories\Transfer\TransferRepositoryInterface;
use App\Service\AnalyticsService;
use App\Service\Care;
use App\Service\Dashboard\Comeback;
use App\Service\Dashboard\Comment;
use App\Service\Dashboard\Log;
use App\Service\Dashboard\Notification;
use App\Service\Dashboard\Out;
use App\Service\Dashboard\Transfer;
use App\Traits\BrowserDetect;
use Carbon\Carbon;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use \DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->transfer =  new Transfer();
        $this->comment = new Comment();
        $this->out = new Out();
        $this->comeback = new Comeback();
        $this->notifications = new Notification();
        $this->log = new Log();
        //$this->analytics = new AnalyticsService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['transfers'] =  "";
        $data['log'] = "";
        $data['notification'] = $this->notifications;
        $data['comment'] = "";
        $data['out'] = "";
        $data['comeback'] = "";
        $data['totalUp'] = $this->comeback->totalUp();
        $data['mounthcount'] = $this->comeback->totalMountReservation();
        $data['daycount'] = $this->comeback->totalDayReservation();
        $data['totalreservation'] = $this->comeback->totalReservation();
        $data['totalday'] = $this->comeback->totalDay();
        $data['totalDrop'] = $this->out->totalDrop();
       // $data['analytics'] = $this->analytics;
        return view('admin.home', $data);
    }


    public function getTodayReservation()
    {
        $reservation = [];
        $date = Carbon::now()->subDays(7);
        $reservation[] = Reservation::where('checkin', '>=', $date)->get();
        $reservation[] = Reservation::where('checkout', '>=', $date)->get();
        return $reservation;
    }
}
