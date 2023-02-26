<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\Ekstra;
use App\Models\Language;
use App\Models\Location;
use App\Models\Reservation;
use App\Service\Reservation\TotalCalculate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Activitylog\Facades\LogBatch;
use Spatie\Activitylog\Models\Activity;
use Validator;

class CustomerController extends Controller
{

    public function __construct()
    {
        LogBatch::startBatch();

    }



    public function index(Request $request)
    {
        $customersa = [];
        LogBatch::startBatch();
        $customers = $this->search($request);
        if(!is_null($customers))
        {
            $customersa = $customers->paginate(20);
        }
        LogBatch::endBatch();

        return view('admin.defination.customers.index', ['customers' => $customersa]);

    }

    public function __destruct()
    {
        LogBatch::endBatch();
    }

    public function search(Request $request)
    {

        $x = [];
        if ($request->filled('phone')) {
            $customer = Customer::where('phone', trim($request->phone))->get();
            $collection = collect($customer);
            $x[] = $collection->implode('id', ', ');
        }

        if ($request->filled('email')) {
            $customer = Customer::where('email', $request->email)->get();
            $collection = collect($customer);
            $x[] = $collection->implode('id', ', ');
        }

        if ($request->filled('fullname')) {
            $customer = Customer::where('fullname', 'like', '%' . $request->fullname . '%')->get();
            $collection = collect($customer);
            $x[] = $collection->implode('id', ', ');
        }

        if ($request->filled('lastname')) {
            $customer = Customer::where('lastname', 'like', '%' . $request->fullname . '%')->get();
            $collection = collect($customer);
            $x[] = $collection->implode('id', ', ');
        }

        if (count($x) == 0) {
            $customer = Customer::all();
            $collection = collect($customer);
            $x[] = $collection->implode('id', ', ');
        }

        $fill = array_filter($x);
        if(empty($fill))
        {
            return null;
        }

        foreach ($fill as $item) {
            $xyz = explode(",", $item);
            foreach ($xyz as $i) {
                $a[] = $i;
            }
        }

        $customers = Customer::whereIn('id', $a)->orderBy('id','desc');

        return $customers;
    }


    public function get_note(Request $request)
    {
        $x = CustomerNote::where('id_customer', $request->id)->get();
        foreach ($x as $item) {
            $data[] = array(
                'id' => $item->id,
                'note' => $item->note,
                'user' => User::find($item->id_user)->name,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            );
        }
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        $language = Language::all();
        $data['cars'] = Car::all();
        $data['ekstras'] = Ekstra::where('status', "1")->get();
        $data['center_location_pick_up'] = Location::getViewCenter();
        $data['currency'] = Currency::all();
        return view('admin.defination.customers.create', ['country' => $country, 'languages' => $language,'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
        ],[
            'firstname.required'     =>  'İsim alanı Boş bırakılamaz',
            'lastname.required'      =>  'Soyisim alanı Boş bırakılamaz',
            'email.required'         =>  'Email alanı Boş bırakılamaz',
            'phone.required'         =>  'Telefon alanı Boş bırakılamaz',
            'birthday.required'      =>  'Doğum Tarihi alanı Boş bırakılamaz',
            'nationality.required'   =>  'Ülke Seçmek Zorunludur.',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }


        if ($request->password == null) {
            $password = bcrypt($request->password_new);
        } else {
            $password = $request->password;
        }
        $country = Country::where('country_name',$request->nationality)->first();
        $customer = new Customer();
        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname  = Str::upper($request->lastname);
        $customer->fullname  = Str::upper($request->firstname) . " " . Str::upper($request->lastname);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->phone1 = $request->phone1;
        $customer->phone_country = "+".$country->phone_code;
        $customer->gender = $request->gender;
        $customer->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $customer->nationality = $request->nationality;
        $customer->password = $password;
        $customer->identity_no = $request->identity_no;
        $customer->identity_type = $request->identity_type;
        $customer->birthpalace = $request->birthpalace;
        $customer->language = $request->language ?? 1;
        $customer->tax_office = $request->tax_office;
        $customer->tax = $request->tax;
        $customer->passport_palace = $request->passport_palace;
        $customer->passport_date = Carbon::parse($request->passport_date)->format('Y-m-d');
        $customer->home_address = $request->home_address;
        $customer->office_address = $request->office_address;
        $customer->status = 1;
        $customer->password =  bcrypt($request->password);
        $customer->save();


        $data = array(
            'customer_country' => $request->nationality,
            'customer_fullname' => $request->firstname . " " . $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        );

        return redirect()->back();
    }
    public function get_reservation_for_customer($id_customer)
    {
        return Reservation::where("id_customer", $id_customer)->count();
    }

    public function get_reservation_for_status($id_customer, $status)
    {
        return Reservation::where("id_customer", $id_customer)->where("status", $status)->count();
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $country = Country::all();
        $language = Language::all();
        $customer = Customer::find($request->id);
        $id = $request->id;
        return view('admin.defination.customers.edit', ['country' => $country, 'languages' => $language, 'customer' => $customer, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
        ],[
            'firstname.required'     =>  'İsim alanı Boş bırakılamaz',
            'lastname.required'      =>  'Soyisim alanı Boş bırakılamaz',
            'email.required'         =>  'Email alanı Boş bırakılamaz',
            'phone.required'         =>  'Telefon alanı Boş bırakılamaz',
            'birthday.required'      =>  'Doğum Tarihi alanı Boş bırakılamaz',
            'nationality.required'   =>  'Ülke Seçmek Zorunludur.',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }


        if ($request->has('password_new')) {
            $password = Hash::make($request->password_new);
        } else {
            $password = $request->password;
        }
        $country = Country::where('country_name',$request->nationality)->first();

        $customer = Customer::find($request->id);
        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname  = Str::upper($request->lastname);
        $customer->fullname  = Str::upper($request->firstname) . " " . Str::upper($request->lastname);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->phone1 = $request->phone1;
        if($country)
        {
            $customer->phone_country = "+".$country->phone_code;
        }else{
            $customer->phone_country = 0;
        }
        $customer->gender = $request->gender;
        $customer->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $customer->nationality = $request->nationality;
        $customer->password = $password;
        $customer->identity_no = $request->identity_no;
        $customer->birthpalace = $request->birthpalace;
        $customer->language = $request->language;
        $customer->tax_office = $request->tax_office;
        $customer->tax = $request->tax;
        $customer->identity_type = $request->identity_type;
        $customer->passport_palace = $request->passport_palace;
        $customer->passport_date =  Carbon::parse($request->passport_date)->format('Y-m-d');
        $customer->home_address = $request->home_address;
        $customer->office_address = $request->office_address;
        $customer->driving_licance_number = $request->driving_licance_number;
        $customer->driving_licance_class = $request->driving_licance_class;
        $customer->driving_licance_location = $request->driving_licance_location;
        $customer->driving_licance_date = $request->driving_licance_date;
        $customer->status = 1;
       if(!is_null($request->password))
       {
           $customer->password =  bcrypt($request->password);
       }

        $customer->save();

        $reservation = Reservation::where('id_customer',$request->id)->orderBy('id','desc')->first();
        if($reservation)
        {
            $reservation->id_language = $request->language;
            $reservation->save();

            $reservation->reservationInformation->firstname = Str::upper($request->firstname);
            $reservation->reservationInformation->lastname = Str::upper($request->lastname);
            $reservation->reservationInformation->email = $request->email;
            $reservation->reservationInformation->phone = $request->phone;
            $reservation->reservationInformation->nationality = $request->nationality;
            $reservation->reservationInformation->birthday = $request->birthday;
            $reservation->reservationInformation->driving_age = $request->driving_age;
            $reservation->reservationInformation->save();
        }




        $data = array(
            'customer_country' => $request->nationality,
            'customer_fullname' => $request->firstname . " " . $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->delete();
        return redirect()->to('admin/admin/customer');
    }

    public function save_api(Request $request)
    {

        $country = Country::where('country_name',$request->nationality)->first();
        $phone  = Helper::replacePhone($country,$request->phone);

        $rules = [
            'email' => 'required|unique:customers',
            'phone' => 'required',
        ];

        $customMessages = [
            'email' => ':Email Boş Geçilemez.',
            'phone' => 'TelefonBoş Olamaz',
        ];

        $this->validate($request, $rules, $customMessages);

        $customer = new Customer();
        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname  = Str::upper($request->lastname);
        $customer->fullname  = Str::upper($request->firstname) . " " . Str::upper($request->lastname);
        $customer->email = $request->email;
        $customer->phone = $phone;
        $customer->phone1 = $request->phone1;
        $customer->gender = $request->gender;
        $customer->phone_country = $country->phone_code;
        $customer->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $customer->nationality = $request->nationality;
        $customer->password = bcrypt($request->password);
        $customer->identity_no = $request->identity_no;
        $customer->birthpalace = $request->birthpalace;
        $customer->language = $request->language;
        $customer->tax_office = $request->tax_office;
        $customer->tax = $request->tax;
        $customer->identity_type = $request->identity_type;
        $customer->passport_palace = Str::upper($request->passport_palace);
        $customer->passport_date   = Carbon::parse($request->passport_date)->format('Y-m-d');
        $customer->home_address = $request->home_address;
        $customer->office_address = $request->office_address;
        $customer->driving_licance_number = $request->driving_licance_number;
        $customer->driving_licance_class = Str::upper($request->driving_licance_class);
        $customer->driving_licance_location = $request->driving_licance_location;
        $customer->driving_licance_date = $request->driving_licance_date;
        $customer->status = 1;
        $customer->save();



        $data = array(
            'id' => $customer->id,
            'firstname' => $customer->firstname,
            'lastname' => $customer->lastname,
            'email' => $customer->email,
            'fullname' => $customer->fullname,
            'phone' => $customer->phone_country." ".$customer->phone,
            'birthday' => Carbon::parse($customer->birthday)->format('d-m-Y'),
            'gender' => $customer->gender,
            'nationality' => $customer->nationality,
            'point' => $customer->point,
            'remaining_points' => $customer->remaining_points,
            'total_reservation' => $this->get_reservation_for_customer($customer->id),
            'cancel_reservation' => $this->get_reservation_for_status($customer->id, 'cancel'),
            'waiting_reservation' => $this->get_reservation_for_status($customer->id, 'waiting'),
            'comfirm_reservation' => $this->get_reservation_for_status($customer->id, 'comfirm'),
            'notes' => $customer->customernote()
        );

        return $data;
    }


    public function addsavenote(Request $request)
    {
        $customernote = new CustomerNote();
        $customernote->id_customer = $request->id;
        $customernote->note = $request->message;
        $customernote->id_user = Auth::user()->id;
        $customernote->save();

        $x = CustomerNote::where('id_customer', $request->id)->get();
        return response()->json($x);
    }

    public function reservations(Request $request)
    {
        $data['reservation'] = Reservation::whereNull('deleted_at')->where("id_customer", $request->id)->paginate(100);
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['customers'] = Customer::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['request'] = [];
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "Müşteri Rezervasyonları";
        $data['categorys'] = Category::all();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }
}
