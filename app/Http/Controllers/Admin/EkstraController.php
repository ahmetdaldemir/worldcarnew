<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EkstraRequest;
use App\Models\Currency;
use App\Models\Ekstra;
use App\Models\EkstraLanguage;
use App\Models\Language;
use App\Models\Reservation;
use App\Models\ReservationEkstra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekstras = Ekstra::all();
        return view('admin.defination.ekstras.index', ['ekstras' => $ekstras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['languages'] = Language::all();
        return view('admin.defination.ekstras.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $ekstra = new Ekstra();
        $ekstra->_token = $request->_token;
        $ekstra->input_name = $request->input_name ?? "default";
        $ekstra->price = $request->price;
        $ekstra->mandatoryInContract = $request->mandatoryInContract;
        $ekstra->itemOfCustom = $request->itemOfCustom;
        $ekstra->value = $request->value;
        $ekstra->type = $request->type;
        $ekstra->sellType = $request->sellType;
        $ekstra->status = $request->status ?? 1;
        $ekstra->image = $request->image;
        $ekstra->save();
        $id = $ekstra->id;
        $language = Language::all();
        $i = 0;
        foreach ($language as $val) {
            $EkstraLanguage = new EkstraLanguage();
            $EkstraLanguage->id_ekstra = $id;
            $EkstraLanguage->id_lang = $val->id;
            $EkstraLanguage->info = $val->info[$i];
            $EkstraLanguage->title = $request->title[$i];
            $EkstraLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
            $EkstraLanguage->save();
            $i++;
        }
        return redirect()->back();
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
        $ekstra = Ekstra::where('status',1)->get();
        foreach ($ekstra as $item) {
            $data[] = array(
                'id' => $item->id,
                'title' => EkstraLanguage::getSelectLang($item->id, 'title', 1),
                'price' => $item->price * $request[0],
                'value' => $item->value,
                'info' => $item->info,
                'mandatoryInContract' => $item->mandatoryInContract == "yes" ? false : true,
                'mandatoryInContractvalue' => $item->mandatoryInContract == "yes" ? 1 : 0,
                'sellType' => $item->sellType == 'daily' ? "Günlük" : "Kiralama Başı",
                'total_price' => $this->mandatoryInContract(1, $item->price, $item->mandatoryInContract, $request[0], $request[1], $item->sellType),
            );
        }
        return $data;
    }

    public function mandatoryInContract($item, $price, $mandatoryPrice, $currencyprice, $days, $sellType)
    {
        if ($mandatoryPrice == "yes") {
            if ($sellType == "daily") {
                return $price * $currencyprice * $days;
            } else {
                return $price * $currencyprice;
            }
        } else {
            return 0;
        }
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editlists($request)
    {
        $ekstra = Ekstra::where('status',1)->get();
        $reservation = Reservation::find($request);
        $currencyprice = Currency::find($reservation->id_currency);
        foreach ($ekstra as $item) {
            $current_ekstra = ReservationEkstra::where('id_reservation', $request)->where('id_ekstra', $item->id)->first();
            $data[] = array(
                'id' => $item->id,
                'title' => EkstraLanguage::getSelectLang($item->id, 'title', 1),
                'price' => $item->price * $currencyprice->exchange,
                'item_price' => $current_ekstra ? round($current_ekstra->price) : 0,
                'value' => $item->value,
                'info' => EkstraLanguage::getSelectLang($item->id, 'info', 1),
                'current_value' => $current_ekstra ?$current_ekstra->item : 0,
                'current_price' => $current_ekstra ? $current_ekstra->price * $currencyprice->exchange : 0,
                'current_day' => $current_ekstra ? $current_ekstra->day : 0,
                'current_total' =>  $current_ekstra ? $current_ekstra->price : 0,
                'sellType' => $item->sellType == 'daily' ? "Günlük" : "Kiralama Başı",
                'mandatoryInContract' => $item->mandatoryInContract,
                'total_price' => $this->mandatoryInContract(1, $item->price, $item->mandatoryInContract, $currencyprice->exchange, $reservation->days, $item->sellType),
            );
        }
        return $data;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data['ekstra'] = Ekstra::find($request->id);
        $data['languages'] = Language::all();
        $data['id'] = $request->id;
        return view('admin.defination.ekstras.edit', $data);
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
        $ekstracheck = EkstraLanguage::where('id_ekstra', $request->id)->get();
        $ekstra = Ekstra::find($request->id);
        $ekstra->_token = $request->_token;
        $ekstra->input_name = $request->input_name;
        $ekstra->price = $request->price;
        $ekstra->mandatoryInContract = $request->mandatoryInContract;
        $ekstra->itemOfCustom = $request->itemOfCustom;
        $ekstra->value = $request->value;
        $ekstra->type = $request->type;
        $ekstra->sellType = $request->sellType;
        $ekstra->image = $request->image;
        $ekstra->save();

        if ($ekstracheck == null) {
            $language = Language::all();
            $i = 0;
            foreach ($language as $val) {
                $EkstraLanguage = EkstraLanguage::where('id_lang', $val->id)->where('id_ekstra', $request->id)->first();
                $EkstraLanguage->title = $request->title[$i];
                $EkstraLanguage->info = $request->info[$i];
                $EkstraLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
                $EkstraLanguage->save();
                $i++;
            }
        } else {
            EkstraLanguage::where('id_ekstra', $request->id)->delete();
            $language = Language::all();
            $i = 0;
            foreach ($language as $val) {
                $EkstraLanguage = new EkstraLanguage();
                $EkstraLanguage->id_lang = $val->id;
                $EkstraLanguage->id_ekstra = $request->id;
                $EkstraLanguage->title = $request->title[$i];
                $EkstraLanguage->info = $request->info[$i];
                $EkstraLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
                $EkstraLanguage->save();
                $i++;
            }
        }
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

        $ekstra = Ekstra::find($request->id);
        $ekstra->delete();

        $ekstralanguage = EkstraLanguage::where('id_ekstra', $request->id);
        $ekstralanguage->delete();
        return redirect()->back();
    }

    public function status(Request $request)
    {
        $ekstra = Ekstra::find($request->id);
        $ekstra->status = $request->status;
        $ekstra->save();
        return redirect()->back();
    }


    public function mandatoryInContractStatus(Request $request)
    {
        $ekstra = Ekstra::find($request->id);
        $ekstra->mandatoryInContract = $request->mandatoryInContract;
        $ekstra->save();
        return redirect()->back();
    }

}
