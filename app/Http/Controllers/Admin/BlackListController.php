<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\BlackList;
use App\Models\CarModel;
use App\Models\Customer;
use Illuminate\Http\Request;

class BlackListController extends Controller
{

    public function index()
    {
        $data['blacklist'] = BlackList::all();
        return view('admin.defination.customers.blacklist', $data);
    }

    public function create()
    {
        return view('admin.blacklist.create');
    }

    public function edit(Request $request)
    {
        $data['id'] = $request->id;
        $data['blacklist'] = BlackList::find($request->id);
        return view('admin.blacklist.edit', $data);
    }

    public function rollback(Request $request)
    {
        BlackList::where('id_customer', $request->id)->delete();
        return redirect()->back();
    }


    public function save(Request $request)
    {
        $blacklist = BlackList::firstOrCreate([
            'email' => $request->email
        ], [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect("admin/admin/blacklist");
    }

    public function add_customer(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        $blacklist = BlackList::firstOrCreate([
            'email' => $customer->email
        ], [
            'firstname' => $customer->firstname,
            'id_customer' => $id,
            'lastname' => $customer->lastname,
            'email' => $customer->email,
            'phone' => $customer->phone,
        ]);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $blacklist = BlackList::find($request->id);
        $blacklist->blacklistname = $request->blacklistname;
        $blacklist->save();
        return redirect("admin/admin/blacklist");
    }

    public function destroy(Request $request)
    {
        $blacklist = BlackList::find($request->id);
        $blacklist->delete();
        return redirect()->back();
    }

}
