<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\Campain;
use Illuminate\Http\Request;

class CalculateController extends Controller
{

    public function handle(Request $request)
    {
        $calculate =  Campain::calculate($request);
        return $calculate;
    }
}
