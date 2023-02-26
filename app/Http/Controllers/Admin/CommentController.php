<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampingLanguage;
use App\Models\Comment;
use App\Models\CustomerType;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Camping;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\Category;
use App\Models\Currency;
use App\Models\DestinationLanguage;
use App\Models\Language;
use App\Models\ReservationNote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::all();
        return view('admin.settings.comment.index', ['comment' => $comment]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = DB::table('countries')->get();
        $data['car'] = Car::all();
        return view('admin.settings.comment.create', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Camping $model
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function save(Request $request)
    {
        $comment = new Comment();
        $comment->firstname = $request->firstname;
        $comment->lastname = $request->lastname;
        $comment->email = $request->email ?? "comment@worldcarrental.com";
        $comment->type = $request->type;
        $comment->link = $request->link;
        $comment->description = $request->description;
        $comment->status = 1;
        $comment->star = $request->star;
        $comment->car = $request->car;
        $comment->country = $request->country;
        $comment->city = $request->city;
        $comment->save();
        return redirect()->back();

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
        $comment = Comment::where("id", $request->id)->first();
        $id = $request->id;
        $data['country'] = DB::table('countries')->get();
        $data['car'] = Car::all();
        return view('admin.settings.comment.edit', ['comment' => $comment,'id' => $id,'data' => $data]);
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
        $comment = Comment::find($request->id);
        $comment->firstname = $request->firstname;
        $comment->lastname = $request->lastname;
        $comment->email = $request->email ?? "comment@worldcarrental.com";
        $comment->type = $request->type;
        $comment->link = $request->link;
        $comment->description = $request->description;
        $comment->status = 1;
        $comment->star = $request->star;
        $comment->car = $request->car;
        $comment->country = $request->country;
        $comment->city = $request->city;
        $comment->save();
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
        Comment::where("id", $request->id)->delete();
        return redirect()->back();
    }


    public function change_status(Request $request)
    {
        if ($request->status == 0) {
            $x = Comment::find($request->id);
            $x->status = 1;
            $x->save();
        } else {
            $x = Comment::find($request->id);
            $x->status = 0;
            $x->save();
        }
    }


}
