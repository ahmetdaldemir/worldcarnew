<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\User;
use Illuminate\Http\Request;
use  \DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::with('roles')->get();
        return view('admin.settings.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::all();
        return view('admin.settings.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $x = $user->syncRoles($request->roles);
        return redirect('admin/admin/user');

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
        $data['user'] = User::find($request->id);
        $data['roles'] = Role::all();
        return view('admin.settings.user.edit', $data);
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
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password == "") {
            $user->password = $request->password1;
        } else {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        DB::table('model_has_roles')
            ->where('model_id', $request->id)
            ->delete();

        $x = $user->syncRoles($request->roles);
        $message = "İşlem yapıldı";
        return redirect()->back()->withErrors(['msg' => $message]);;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $reservation  = Reservation::where('user_id',$request->id)->get();
        if($reservation)
        {
            $user->is_status = 0;
            $user->save();
            $message = "Kullanıcı Silinemez";
            return redirect()->back()->withErrors(['msg' => $message]);;

        }

        $user->delete();
        $message = "Kullanıcı Silindi";
        return redirect()->back()->withErrors(['msg' => $message]);;

    }


    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user_id'] = $user->id;
            $success['email'] = $user->email;
            $success['name'] = $user->name;
            return response()->json($success, 200);
        } else {
            return response()->json('Email veya şifre yanlış.', 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if ($user->save()) {
            return response()->json('Kullanıcı başarıyla eklendi.', 200);
        } else {
            return response()->json('Kullanıcı kaydı sırasında bir sorun oluştu.', 400);
        }
    }


    public function memberlogout(Request $request)
    {

        $userToLogout = User::find($request->id);
        session()->remove($userToLogout->session_id);
        session()->forget($userToLogout->session_id);
        $myFile = './storage/framework/sessions/' . $userToLogout->session_id;
        $y = File::delete($myFile);

        $userToLogout->session_id = NULL;
        $userToLogout->is_active = 0;
        $userToLogout->save();
        $userToLogout->de_active();
        return redirect('admin/home');
    }

    public function is_status(Request $request)
    {
        User::where("id", $request->id)->update(['is_status' => $request->is_status]);
        return redirect()->back();
    }
}
