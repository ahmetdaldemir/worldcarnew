<?php namespace App\Repositories\Message;

use App\Models\Message;


class MessageRepository implements MessageRepositoryInterface
{

    public function get($id)
    {
        return Message::find($id);
    }

    public function all()
    {
        return Message::all();
    }

    public function delete($id)
    {
        Message::destroy($id);
    }

    public function create(object $data)
    {

        $message = new Message();
        $message->firstname =  $data->firstname;
        $message->lastname =  $data->lastname;
        $message->email =  $data->email;
        $message->phone =  $data->phone;
        $message->message =  $data->message;
        $message->save();
    }

    public function update(object $data)
    {
        Message::find($data->id)->update($data);
    }
}
