<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationLanguage;
use App\Models\Language;
use App\Models\TextCategory;
use App\Models\TextCategoryLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TextCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $texts = TextCategory::all();
        return view('admin.defination.text_category.index', ['texts' => $texts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.defination.text_category.create', ['languages' => $language]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $language = Language::all();

        $categopy = new TextCategory();
        $categopy->save();
        $id = $categopy->id;
        $i = 0;
        foreach ($language as $val) {
            $DestinationLanguage = new TextCategoryLanguage();
            $DestinationLanguage->id_lang = $val->id;
            $DestinationLanguage->title = $request->title[$i];
            $DestinationLanguage->id_text_category = $id;
            $DestinationLanguage->save();
            $i++;
        }
        return back();
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
        $language = Language::all();
        $text_category = TextCategory::find($request->id);
        $text_category_language = TextCategoryLanguage::where('id_text_category', $request->id)->get();
        return view('admin.defination.text_category.edit', ['languages' => $language, 'text_category' => $text_category, 'text_category_language' => $text_category_language]);

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
        $language = Language::all();

        $categopy = TextCategory::find($request->id);
        $categopy->type = $request->type;
        $categopy->save();

        $i = 0;
        foreach ($language as $val) {
            $DestinationLanguage = TextCategoryLanguage::where('id_text_category', $request->id)->where('id_lang', $val->id)->first();
            $DestinationLanguage->id_lang = $val->id;
            $DestinationLanguage->title = $request->title[$i];
            $DestinationLanguage->id_text_category = $request->id;
            $DestinationLanguage->save();
            $i++;
        }
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
        TextCategory::where("id", $request->id)->delete();
        TextCategoryLanguage::where("id_text_category", $request->id)->delete();
        return redirect()->back();
    }
}
