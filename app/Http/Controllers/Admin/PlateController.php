<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Plate;
use App\Models\PlateDocument;
use App\Models\Reservation;
use App\Models\ReservationInformation;
use App\Models\ReservationPlate;
use App\Repositories\Plate\PlateRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PlateController extends Controller
{

    private $plateRepository;

    public function __construct(PlateRepositoryInterface $plateRepository)
    {
        $this->plateRepository = $plateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $plates = Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->with(['car' => function ($q){
//            $q->orderBy('id');
//        }])->get();
        $plates =   Plate::get()->sortBy(function($query){
            return $query->car->brand;
        })->all();
         return view('admin.plate.index', ['plates' => $plates]);
    }

    public function archive()
    {
        $plates = Plate::where("status", Plate::PLATE_STATUS_ARCHIVE)->get();
        return view('admin.plate.archive', ['plates' => $plates]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::all();
        return view('admin.plate.create', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Car $model
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function save(Request $request)
    {
        $attributes = Helper::replaceSpace($request->plate);

        $plates = Plate::where("plate", $attributes)->get();
        if ($plates->count() == 0) {
            $plate = new Plate();
            $plate->id_car = $request->id_car;
            $plate->plate = Str::upper(Helper::replaceSpace($request->plate), "UTF-8");
            $plate->registry = $request->registry;
            $plate->km = $request->km;
            $plate->oil_km = $request->oil_km;
            $plate->status = Plate::PLATE_STATUS_FREE;
            $plate->description = $request->description;
            $plate->document_number = $request->document_number;
            $plate->save();
            $last_query_id = $plate->id;

            $array = $request->type;
            $plate_document = [];
            $i = 0;
            foreach ($array as $value) {
                $plate_document[] = array(
                    'type' => $value,
                    'id_plate' => $last_query_id,
                    'insurance_company' => $request->insurance_company[$i],
                    'insurance_start' => $request->insurance_start[$i],
                    'insurance_finish' => $request->insurance_finish[$i],
                );
                $i++;
            }
            (new \App\Models\PlateDocument)->save($plate_document);
        }

        return redirect('admin/admin/plates');
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
        $cars = Car::all();
        $plates = Plate::find($request->id);

        return view('admin.plate.edit', ['cars' => $cars, 'plates' => $plates]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $plates = $this->plateRepository->all();
        foreach ($plates as $plate) {
            $data[] = array(
                'id' => $plate->id,
                'plate' => $plate->plate,
                'status' => $plate->status,
                'car' => $plate->car->brandfunction->brandname . " " . $plate->car->modelfunction->modelname,
                'data' => $plate->getDropData($plate->id),
            );
        }
        return $data;
    }

    public function getAvaiblePlate(Request $request)
    {
        $reservartion = Reservation::find($request->id);
        $reservationInformation = ReservationInformation::where('id_reservation',$request->id)->first();
        $plates = $this->plateRepository->getAvaibleAll($reservartion);
        foreach ($plates as $key => $value) {
            $carmodel =  CarModel::find($key);
            $data[] = array(
                'plate' => $value,
                'model' => $carmodel,
                'car' =>  Brand::find($carmodel->brandid)->brandname ?? "Bulunamadı ",
             );
        }
        return $data;
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
        $plate = Plate::find($request->id);
        $plate->id_car = $request->id_car;
        $plate->plate = mb_strtoupper(trim($request->plate), "UTF-8");
        $plate->registry = $request->registry;
        $plate->km = $request->km;
        $plate->oil_km = $request->oil_km;
        $plate->description = $request->description;
        $plate->document_number = $request->document_number;
        $plate->save();

        PlateDocument::where('id_plate', $request->id)->delete();

        $array = $request->type;

        $i = 0;
        foreach ($array as $value) {
            $plate_document = new PlateDocument();
            $plate_document->type = $value;
            $plate_document->id_plate = $request->id;
            $plate_document->insurance_company = $request->insurance_company[$i];
            $plate_document->insurance_start = $request->insurance_start[$i];
            $plate_document->insurance_finish = $request->insurance_finish[$i];
            $plate_document->save();
            $i++;
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
        Plate::where("id", $request->id)->delete();
        return redirect()->back();
    }

    public function status($id, $val)
    {
        $reservation_information = NULL;
        $reservation_plates = NULL;
        $plate = Plate::find($id);
        $reservation = Reservation::where("plate", $plate->id)->orderBy('id', 'desc')->first();
        if ($reservation) {
            $reservation_information = ReservationInformation::where('id_reservation', $reservation->id)->first();
            $reservation_plates = ReservationPlate::where('id_reservation', $reservation->id)->get();
            if (!empty($reservation_plates) || $plate->status == Plate::PLATE_STATUS_BUSY || !empty($reservation) || ($reservation_information->checkin < date('Y-m-d'))) {
                $plate->status = $val;
                $plate->save();
            }
        } else {
            $plate->status = $val;
            $plate->save();
        }
        redirect()->back();
    }
}
