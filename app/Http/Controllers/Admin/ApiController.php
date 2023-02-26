<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Finance;
use App\Service\GetData;
use App\Service\Weather;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = new GetData();
    }


    public function droplocation(Request $request)
    {
        $data = $this->data->droplocation($request);
        return response()->json(array('success' => true, 'data' => $data), 200);
    }

    public function finance()
    {
        return $data = Finance::all();
        return response()->json(array('success' => true, 'data' => $data), 200);
    }

    public function weather(Request $request)
    {
        $datas = file_get_contents("https://www.cnnturk.com/api/weather?ids=".$request->name."");
        $datas = json_decode($datas, TRUE);
        $x = $datas[0]["Days"][0]["Temps"]["HighTemp"];
        $y = $datas[0]["Days"][0]["Temps"]["LowTemp"];
        return response()->json(array('success' => true, 'data' => array('min' => $y,'max' => $x)), 200);
    }

}
