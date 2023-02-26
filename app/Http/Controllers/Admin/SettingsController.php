<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Models\Language;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Settings;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::all();
        $currency = Currency::all();
        $language = Language::all();

        $data = array(
            'title' => Setting::where('key', "title")->orderBy("id", "desc")->limit(1)->get(),
            'keywords' => Setting::where('key', "keywords")->orderBy("id", "desc")->limit(1)->get(),
            'description' => Setting::where('key', "description")->orderBy("id", "desc")->limit(1)->get(),
            'currency_id' => Setting::where('key', "currency_id")->orderBy("id", "desc")->limit(1)->get(),
            'language_id' => Setting::where('key', "language_id")->orderBy("id", "desc")->limit(1)->get(),
            '850' => Setting::where('key', "850")->orderBy("id", "desc")->limit(1)->get(),
            'phone1' => Setting::where('key', "phone1")->orderBy("id", "desc")->limit(1)->get(),
            'phone2' => Setting::where('key', "phone2")->orderBy("id", "desc")->limit(1)->get(),
            'email' => Setting::where('key', "email")->orderBy("id", "desc")->limit(1)->get(),
            'address1' => Setting::where('key', "address1")->orderBy("id", "desc")->limit(1)->get(),
            'address2' => Setting::where('key', "address2")->orderBy("id", "desc")->limit(1)->get(),
            'address3' => Setting::where('key', "address3")->orderBy("id", "desc")->limit(1)->get(),
            'address4' => Setting::where('key', "address4")->orderBy("id", "desc")->limit(1)->get(),
            'car_km' => Setting::where('key', "car_km")->orderBy("id", "desc")->limit(1)->get(),
            'car_km_day' => Setting::where('key', "car_km_day")->orderBy("id", "desc")->limit(1)->get(),
            'license_age' => Setting::where('key', "license_age")->orderBy("id", "desc")->limit(1)->get(),
            'driver_age' => Setting::where('key', "driver_age")->orderBy("id", "desc")->limit(1)->get(),
            'header_advert' => Setting::where('key', "header_advert")->orderBy("id", "desc")->limit(1)->get(),
            'card_payment' => Setting::where('key', "card_payment")->orderBy("id", "desc")->limit(1)->get(),
            'reservation_time' => Setting::where('key', "reservation_time")->orderBy("id", "desc")->limit(1)->get(),
            'home_image' => Setting::where('key', "home_image")->orderBy("id", "desc")->limit(1)->get(),
            'cars_image' => Setting::where('key', "cars_image")->orderBy("id", "desc")->limit(1)->get(),
            'outside_price' => Setting::where('key', "outside_price")->orderBy("id", "desc")->limit(1)->get(),
        );
        return view('admin.settings.index', ['setting' => $setting, 'currency' => $currency, 'language' => $language, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        unset($request['logo']);
        unset($request['favicon']);
        unset($request['home_image']);
        unset($request['cars_image']);


        foreach ($request->all() as $key => $value) {
            Setting::where("key", $key)->delete();
            Setting::updateOrCreate([
                'key' => $key,
                'value' => $value
            ]);
        }
        if (isset($request->logo)) {
            Setting::where("key", "logo")->delete();

            $imageName =  $request->file('logo')->getClientOriginalName();
            $explode = explode(".",$imageName);
            $ext =  $request->file('logo')->getClientOriginalExtension();
            $imageName = "setting_".time().Str::slug($explode[0]).'.'.$ext;
            $filePath = $request->file('logo')->storeAs('public/setting', $imageName);
            $fixed_string = str_replace("public/", "", $filePath);

            Setting::updateOrCreate([
                'key' => 'logo',
                'value' => $fixed_string
            ]);
        }

        if (isset($request->favicon)) {
            Setting::where("key", "favicon")->delete();


            $imageName =  $request->file('favicon')->getClientOriginalName();
            $explode = explode(".",$imageName);
            $ext =  $request->file('favicon')->getClientOriginalExtension();
            $imageName = "setting_".time().Str::slug($explode[0]).'.'.$ext;
            $filePath = $request->file('favicon')->storeAs('public/setting', $imageName);
            $fixed_string = str_replace("public/", "", $filePath);


            Setting::updateOrCreate([
                'key' => 'favicon',
                'value' => $fixed_string
            ]);
        }


        if (isset($request->home_image)) {
            Setting::where("key", "home_image")->delete();

            $imageName =  $request->file('home_image')->getClientOriginalName();
            $explode = explode(".",$imageName);
            $ext =  $request->file('home_image')->getClientOriginalExtension();
            $imageName = "setting_".time().Str::slug($explode[0]).'.'.$ext;
            $filePath = $request->file('home_image')->storeAs('public/setting', $imageName);
            $fixed_string = str_replace("public/", "", $filePath);


            Setting::updateOrCreate([
                'key' => 'home_image',
                'value' => $fixed_string
            ]);
        }


        if (isset($request->cars_image)) {
            Setting::where("key", "cars_image")->delete();
            $imageName =  $request->file('cars_image')->getClientOriginalName();
            $explode = explode(".",$imageName);
            $ext =  $request->file('cars_image')->getClientOriginalExtension();
            $imageName = "setting_".time().Str::slug($explode[0]).'.'.$ext;
            $filePath = $request->file('cars_image')->storeAs('public/setting', $imageName);
            $fixed_string = str_replace("public/", "", $filePath);

            Setting::updateOrCreate([
                'key' => 'cars_image',
                'value' => $fixed_string
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }

    public function mailtest()
    {
        return view('admin.settings.mailtest');
    }

    public function mailtestsend(Request $request)
    {
        Mail::send([], [], function ($message) use ($request) {
            $message->to($request->email)
                ->subject($request->name." Test Yapıyor")
                ->setBody('Merhabalar , Mail adresi test edilmektedir');
        });
    }

    public function uploadtest(Request $request)
    {
        $random = rand(0,999);

        $image = $request->file('name');

        $input['imagename'] = time().'.webp';

        $filePath = storage_path('/app/thumbnails');
        $img = Image::make($image->path());
        $img->resize(50, 50, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$input['imagename']);

//        Webp::make($request->file('name'))->save(storage_path().'/app/webp/'.$random.'.webp', 50);
    }


}
