<?php namespace App\Repositories\StopSell;

use App\Models\StopSell;
use App\Repositories\Repository;


class StopSellRepository  implements StopSellRepositoryInterface
{

    public function get($id)
    {
        return StopSell::find($id);
    }

    public function create(object $data)
    {
        $stopsell = new StopSell();
        $stopsell->id_car        = $data->id_car;
        $stopsell->checkin      = $data->checkin;
        $stopsell->checkout     = $data->checkout;
        $stopsell->user_id       = Auth()->id();
        return $stopsell->save();
    }


    public function all()
    {
        return StopSell::all();
    }

    public function delete($id)
    {
        StopSell::destroy($id);
    }

    public function update($id, object $data)
    {
        StopSell::find($id)->update((array)$data);
    }
}
