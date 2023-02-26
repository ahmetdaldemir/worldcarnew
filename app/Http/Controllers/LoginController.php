<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\EmailTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Auth\Guard;


class LoginController extends Controller
{


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function login(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $remember_me = $request->has('remember') ? true : false;
        if (Auth::guard('web')->attempt($credentials, $remember_me)) {
            $finduser = Customer::find(Auth::guard('web')->id());
            Auth::guard('web')->login($finduser, $remember_me);
            return response()->json(['success' => true], 200);
        }
        return response()->json(['success' => false, 'message' => "Hatalı Kullanıcı Adı ve Şifre"], 200);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = Customer::where('email', $user->email)->first();
            $arrayname = explode(" ", $user->name);

            if ($finduser) {
                Auth::guard('web')->login($finduser,TRUE);
                $finduser->google_id = $user->id;
                $finduser->save();
            } else {
                $newUser = Customer::create([
                    'fullname' => $user->name,
                    'firstname' => $arrayname[0],
                    'lastname' => $arrayname[1],
                    'email' => $user->email,
                    'nationality' => "TR",
                    'google_id' => $user->id,
                    'password' => Hash::make('123456')
                ]);
                Auth::guard("web")->login($newUser,TRUE);
            }
            return redirect('/');

        } catch (GuzzleHttp\Exception\ClientException $e) {
            dd($e->response);
        }
    }


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = Customer::where('google_id', $user->id)->where('email', $user->email)->first();
            $arrayname = explode(" ", $user->name);
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                $newUser = Customer::create([
                    'fullname' => $user->name,
                    'firstname' => $arrayname[0],
                    'lastname' => $arrayname[1],
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('123456dummy')
                ]);
                Auth::login($newUser);
                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgetpassword(Request $request)
    {


        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $customer = Customer::where('email', $request->email)->first();
        $language = $customer->language ?? 1;
        $template = EmailTemplate::where('email_template_id', 8)->where('language_id', $language)->first();
        Mail::send('email.forgetPassword', ['token' => $token, 'customer' => $customer, 'template' => $template, 'user_language_id' => $language], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function resetpassword(Request $request)
    {
        $data['static'] = $this->staticData();
        $data['email'] = DB::table('password_resets')->where('token', $request->token)->first();
        $data['customer'] = Customer::where('email', $data['email']->email)->first();
        $data['token'] =$request->token;
        return view('auth.passwords.reset',  ['data' => $data]);
    }

    public function passwordupdate(Request $request)
    {
        if($request->password != $request->password_confirmation)
        {
            return redirect()->back()->withErrors(['msg' => "Şifreler Eşleşmiyor"]);
        }else{
             $password = bcrypt($request->password);
             $customer =  Customer::find($request->id);
             $customer->password =  $password;
             $customer->save();
            return redirect()->back()->withErrors(['msg' => "Güncelleme Başarılıdır"]);
        }
    }
}
