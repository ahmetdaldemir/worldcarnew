<?php namespace App\Repositories\Transfer;

use App\Models\Transfer;

class TransferRepository implements TransferRepositoryInterface
{

    public function get($id)
    {
        return Transfer::find($id);
    }

    public function create(object $data)
    {
        $transfer = new Transfer();
        $transfer->fullname      = $data->fullname;
        $transfer->phone         = $data->phone;
        $transfer->email         = $data->email;
        $transfer->check_in      = $data->check_in;
        $transfer->check_in_time = $data->check_in_time;
        $transfer->user_id       = Auth()->id();
        $transfer->driver        = $data->driver;
        $transfer->price         = $data->price;
        $transfer->up_location   = $data->up_location;
        $transfer->drop_location = $data->drop_location;
        return $transfer->save();
    }

    public function all()
    {
        return Transfer::all();
    }

    public function find($id)
    {
        return Transfer::find($id);
    }

    public function delete($id)
    {
        Transfer::destroy($id);
    }

    public function update($id, object $data)
    {
        Transfer::find($id)->update((array)$data);
    }
}
