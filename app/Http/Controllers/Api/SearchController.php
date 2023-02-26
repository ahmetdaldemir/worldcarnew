<?php namespace App\Http\Controllers\Api;

use App\Helpers\Search;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Reservation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    public function index(Request $request)
    {
       $data  = new \App\Service\Search($request,1,1);
       $reservation = $data->index();
         return response()->json(['data' => $reservation],200);

    }

    public function search(Request $request)
    {
        $data = [];
        $x = [];
        $a = [];
       $treeControl =  substr(Str::upper($request->searchText), 0, 3);
       if($treeControl == "PNR")
       {
          $reservations =  Reservation::where('pnr','like','%'.Str::upper($request->searchText))->get();
           $x[] = $reservations->implode('id_customer', ', ');
       }
        $customer = Customer::where("email", "like", Str::upper($request->searchText) . '%')
            ->orWhere("fullname", "like",  '%'.Str::upper($request->searchText).'%')
            ->orWhere("firstname", "like",  '%'.Str::upper($request->searchText).'%')
            ->orWhere("lastname", "like",  '%'.Str::upper($request->searchText).'%')
            ->orWhere("phone", $request->searchText)
            ->get();
        $x[] = $customer->implode('id', ', ');
        $fill = array_filter($x);

        if (!empty($fill)) {
            foreach ($fill as $item) {
                $xyz = explode(",", $item);
                foreach ($xyz as $i) {
                    $a[] = $i;
                }
            }

            $customer = Customer::whereIn('id', $a)->paginate(100);
            foreach ($customer as $item) {
                $data[] = array(
                    'id' => $item->id,
                    'firstname' => $item->firstname,
                    'lastname' => $item->lastname,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'birthday' => Carbon::parse($item->birthday)->format('d-m-Y'),
                    'gender' => $item->gender,
                    'nationality' => $item->nationality,
                    'point' => $item->point,
                    'remaining_points' => $item->remaining_points,
                    //'total_reservation'   => $this->get_reservation_for_customer($item->id),
                    //'cancel_reservation'  => $this->get_reservation_for_status($item->id, 'closed'),
                    //'waiting_reservation' => $this->get_reservation_for_status($item->id, 'waiting'),
                    //'comfirm_reservation' => $this->get_reservation_for_status($item->id, 'comfirm'),
                    //'complated_reservation' => $this->get_reservation_for_status($item->id, 'complated'),
                    //'notes' => $item->customernote()
                );
            }
        }

        return $data;
    }
}
