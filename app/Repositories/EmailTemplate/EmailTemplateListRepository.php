<?php namespace App\Repositories\EmailTemplate;

use App\Models\EmailTemplateList;


class EmailTemplateListRepository implements EmailTemplateListRepositoryInterface
{

    public function get($id)
    {
        return EmailTemplateList::find($id);
    }

    public function create(object $data)
    {

        $transfer = new EmailTemplateList();
        $transfer->name = $data->name;
        $transfer->save();
        return $transfer;
    }

    public function all()
    {
        return EmailTemplateList::all();
    }

    public function find($id)
    {
        return EmailTemplateList::find($id);
    }

    public function delete($id)
    {
        EmailTemplateList::destroy($id);
    }

    public function update($id, object $data)
    {
        EmailTemplateList::find($id)->update((array)$data);
    }
}
