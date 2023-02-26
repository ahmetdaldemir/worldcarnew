<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['suppliers'] = Supplier::all();
        return view('admin/defination/supplier/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/defination/supplier/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = "worldcarturkey.com";
        $data = array(
            'id' => 321,
            'fullname' => $request->fullname,
            'webpage' => $request->webpage,
            'email' => $request->email,
        );

        $encode = JWT::encode($data,$key,'HS256');

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'company' =>'required|unique:suppliers',
            'phone' =>'required',
            'webpage' =>'required',
            'email' => 'required|email|unique:suppliers',
            'password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $supplier  = new Supplier();
        $supplier->fullname = $request->fullname;
        $supplier->company  = $request->company;
        $supplier->email    = $request->email;
        $supplier->phone    = $request->phone;
        $supplier->webpage  = $request->webpage;
        $supplier->password = bcrypt($request->password);
        $supplier->save();

        return redirect('admin/admin/supplier/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $supplier = Supplier::find($id);
        $supplier->fullname = $request->fullname;
        $supplier->company  = $request->company;
        $supplier->email    = $request->email;
        $supplier->phone    = $request->phone;
        $supplier->webpage  = $request->webpage;
        $supplier->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = $request->status;
        $supplier->save();
        return redirect()->back();
    }


    public function token(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $key = "worldcarturkey.com";
        $data = array(
            'id' => $supplier->id,
            'fullname' => $supplier->fullname,
            'webpage' => $supplier->webpage,
            'email' => $supplier->email,
        );
        $encode = JWT::encode($data,$key,'HS256');
        $supplier->token = base64_encode($encode);
        $supplier->save();


        Mail::raw('company : '.$supplier->company.' ===>>>>>  token :  '. base64_encode($encode).'' , function ($message) {
            $message->to('ahmetdaldemir@gmail.com');
        });
        return redirect()->back();
    }
}
