<?php namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Car;
use App\User;
use Haruncpi\LaravelUserActivity\Listeners\LockoutListener;
use Haruncpi\LaravelUserActivity\Models\Log;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    public function index()
    {
        return view('admin/auth/login');
    }

    public function login(Request $request)
    {
         $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required',
         //   'g-recaptcha-response' => 'required|recaptcha'
        ]);
        if ($validator->fails()) {
            return back()->withErrors([
                'email' => 'Tüm Alanları Doldurunuz.',
               // 'g-recaptcha-response' => 'Robot Olmadığınızı Doğrulayın',
            ]);
        }
        $i = Auth::guard('admin-web')->attempt(array("email" => $request->email,"password"=>$request->password,"is_status"=> 1));
        // $i = Admin::where("email",$request->email)->where("password",md5($request->password))->first();
        if($i)
        {
            $user = User::where('email',$request->email)->first();
            $user->is_active();
            Auth::guard('admin-web')->loginUsingId($user->id, TRUE);
            $request->session()->regenerate();
            $user->session_id = Session()->getId();

            $user->save();
            return redirect(route('admin.home'));
        }

        $user = User::where('email',$request->email)->first();
        if($user)
        {
            $user_id = $user->id;
        }else{
            $user_id = 0;
        }

        $data = [
            'ip'         => $_SERVER['HTTP_X_FORWARDED_FOR'],
            'user_agent' => $request->userAgent()
        ];
        $log = new Log();
        $log->log_date = date('Y-m-d H:i:s');
        $log->log_type = "login failed";
        $log->data =  json_encode($data);
        $log->user_id = $user_id ;
        $log->save();

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::find($request->id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->de_active();
        return redirect('/admin');
    }

}
