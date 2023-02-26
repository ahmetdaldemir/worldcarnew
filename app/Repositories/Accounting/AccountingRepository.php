<?php namespace App\Repositories\Accounting;

use App\Models\Accounting;
use App\Models\Currency;


class AccountingRepository implements AccountingRepositoryInterface
{

    public function get($id)
    {
        return Accounting::find($id);
    }

    public function all()
    {
        return Accounting::orderBy('id','desc')->get();
    }

    public function delete($id)
    {
        Accounting::destroy($id);
    }

    public function update($id, array $data)
    {
        $accounting = Accounting::find($id);
        $accounting->category_id = $data->category_id;
        $accounting->type = $data->type;
        $accounting->price = $data->price;
        $accounting->user_id = Auth()->id();
        $accounting->description = $data->description;
        $accounting->currency_id = $data->currency_id;
        $accounting->currency_exchange = Currency::find($data->currency_id)->price_buy;
        $accounting->save();
    }

    public function create(object $data)
    {
        $accounting = new Accounting();
        $accounting->category_id = $data->category_id;
        $accounting->type = $data->type;
        $accounting->price = $data->price;
        $accounting->user_id = Auth()->id();
        $accounting->description = $data->description;
        $accounting->currency_id = $data->currency_id;
        $accounting->currency_exchange = Currency::find($data->currency_id)->price_buy;
        $accounting->save();
    }
}
