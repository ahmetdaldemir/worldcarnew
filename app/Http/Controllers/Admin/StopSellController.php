<?php namespace App\Http\Controllers\Admin;


use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Repositories\StopSell\StopSellRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StopSellController extends Controller
{
    private $stopsell;

    public function __construct(StopSellRepositoryInterface $stopsell)
    {
        $this->stopsell = $stopsell;
    }

    public function index()
    {
        $data['stopsell'] = $this->stopsell->all();
        return view('admin.stopsell.index',$data);
    }

    public function edit(Request $request)
    {
        $data['stopsell'] = $this->stopsell->get($request->id);

        $car = Car::all();
        foreach ($car as $car_val) {
            $car_data[] = array(
                'id' => $car_val->id,
                'brand' => Brand::find($car_val->brand)->brandname ?? null,
                'model' => CarModel::find($car_val->model)->modelname ?? null,
                'year' => $car_val->year,
            );
        }
        $data['cars'] = $car_data;
        return view('admin.stopsell.edit',$data);
    }


    public function create()
    {
        $car = Car::all();
        foreach ($car as $car_val) {
            $car_data[] = array(
                'id' => $car_val->id,
                'brand' => Brand::find($car_val->brand)->brandname ?? null,
                'model' => CarModel::find($car_val->model)->modelname ?? null,
                'year' => $car_val->year,
            );
        }
        $data['cars'] = $car_data;
         return view('admin.stopsell.create',$data);
    }

    public function save(Request $request)
    {
        $this->stopsell->create($request);
        return redirect()->to('admin/admin/stopsell');
    }

    public function update(Request $request)
    {
        $this->stopsell->update($request->id,$request);
        return redirect()->to('admin/admin/stopsell');
    }

    public function delete(Request $request)
    {
        $this->stopsell->delete($request->id);
        return redirect()->to('admin/admin/stopsell');
    }

}
