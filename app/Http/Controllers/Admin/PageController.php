<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Image as ImageUpload;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageLanguage;
use App\Models\Text;
use App\Models\TextLanguage;
use App\Service\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.settings.page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.settings.page.create', ['languages' => $language]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $page = Page::where("function",$request->function)->first();
        if($page)
        {
            $this->update($request);
        }else{


        $language = Language::all();

        $page = new Page();
        $page->function = $request->function;
        $page->save();
        $id = $page->id;
        $i = 0;
        foreach ($language as $val) {
            $page_language = new PageLanguage();
            $page_language->id_pages = $id;
            $page_language->id_lang = $val->id;
            $page_language->title = $request->title[$i];
            $page_language->meta_title = $request->meta_title[$i];

            $page_language->save();
            $i++;
        }

        if($request->file('file') != "")
        {
            $header_image = new Image();
            $x = $header_image->uploadImage($request,1920,350,'pages');

            $image = new ImageUpload();
            $image->title = $x;
            $image->module = "pages";
            $image->id_module = $id;
            $image->save();
        }
        }
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
        $id = $request->id;
        $language = Language::all();
        $page = Page::find($request->id);
        return view('admin.settings.page.edit', ['id' => $id, 'languages' => $language, 'page'=>$page]);
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

        $page = Page::find($request->id);
        $page->function = $request->function;
        $page->save();

        $id = $request->id;

        $i = 0;
        foreach ($language as $val) {
            $page_language =  PageLanguage::where("id_pages",$request->id)->where("id_lang",$val->id)->first();
            $page_language->id_pages = $id;
            $page_language->id_lang = $val->id;
            $page_language->title = $request->title[$i] ?? null;
            $page_language->meta_title = $request->meta_title[$i] ?? null;
            $page_language->save();
            $i++;
        }

        if($request->file('image') != "")
        {
            $header_image = new Image();
            $x = $header_image->uploadImage($request,1600,350,'pages');

            $image = ImageUpload::updateOrCreate(
                ['id_module' =>  $request->id,"module"=> "pages"],
                [
                    'id_module' =>  $request->id,
                    'title' => $x,
                    'module' => "pages",
                ]
            );

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
        $id = $request->input('id');
        PageLanguage::where("id_pages", $id)->delete();
        Page::where("id", $id)->delete();
        return redirect()->back();
    }
}
