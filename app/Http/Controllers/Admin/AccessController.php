<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AccessReport;

use \DB;
use Illuminate\Http\Request;

class AccessController extends Controller
{

    public function index()
    {
        $access = DB::table('access_reports')->where('type','search')->orderBy('id','desc')->simplePaginate(200);
        return view('admin.access.index', ['access' => $access]);
    }

    public function list(Request $request)
    {
        $accessfirst = DB::table('access_reports')->where('id',$request->id)->first();

        $access = DB::table('access_reports')->where('ip',$accessfirst->ip)->orderBy('id','desc')->get();
        return view('admin.access.list', ['access' => $access]);
    }


}
