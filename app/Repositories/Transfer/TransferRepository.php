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
         $transfer->fullname = $data->fullname;
         $transfer->phone = $data->phone;
         $transfer->check_in = $data->check_in;
         $transfer->user_id = Auth()->id();
         $transfer->receiver = $data->receiver;
         $transfer->subject = $data->subject;
         $transfer->message = $data->message;
         return $transfer->save();
    }

    public function all()
    {
        return Transfer::all()->sortByDesc("id");
    }

    public function home()
    {
        return Transfer::all()->sortByDesc("id")->take(20);
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

    public function statuschange($id, object $data)
    {
        $transfer = Transfer::find($id);
        $transfer->status = $data->status;
        $transfer->save();
    }
}
