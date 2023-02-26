<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.settings.language.index', ['languages' => $languages]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.language.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function translate(Request $request)
    {
        $path = resource_path('lang/'.$request->url.'.json');
        $json = json_decode(file_get_contents($path), true);
        return view('admin.settings.language.translate',['json' => $json,'title' => $request->title,'url' => $request->url]);
    }

    public function translatesave(Request $request)
    {
        $x = array_combine($request->key,$request->value);

        $data = json_encode($x);

        $fileName = $request->url.'.json';
        File::put(resource_path('/lang/'.$fileName),$data);
        return redirect()->back();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $language = new Language();
        $language->title = $request->title;
        $language->short = $request->short;
        $language->flag = $request->flag;
        $language->meta_title = $request->meta_title;
        $language->meta_description = $request->meta_description;
        $language->save();
        return redirect('admin/admin/language');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request)
    {
        $languages = Language::find($request->id);
        $id = $request->id;
        return view('admin.settings.language.edit', ['languages' => $languages,'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $language = Language::find($request->id);
        $language->title = $request->title;
        $language->short = $request->short;
        $language->flag = $request->flag;
        $language->meta_title = $request->meta_title;
        $language->meta_description = $request->meta_description;
        $language->save();
        return redirect('admin/admin/language');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Category::where("id",$id)->delete();
    }

}
