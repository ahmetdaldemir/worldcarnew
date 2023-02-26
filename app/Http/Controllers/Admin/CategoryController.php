<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryLanguage;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $language = Language::all();

        $Blog = new Category();
        $Blog->id_parent = 0;
        $Blog->save();
        $id = $Blog->id;
        $i = 0;
        foreach ($language as $val) {
            $BlogLanguage = new CategoryLanguage();
            $BlogLanguage->id_categories = $id;
            $BlogLanguage->id_lang = $val->id;
            $BlogLanguage->title = $request->title[$i];
            $BlogLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
            $BlogLanguage->save();
            $i++;
        }
        return redirect()->back();
    }


    public function create()
    {
        $language = Language::all();
        return view('admin.category.create', ['languages' => $language]);
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
        $categories = Category::find($request->id);
        $language = Language::all();
        $id = $request->id;
        return view('admin.category.edit', ['categories' => $categories, 'languages' => $language, 'id' => $id]);
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
        $Blog = Category::find($request->id);
        $Blog->id_parent = 0;
        $Blog->save();

        $id = $request->id;
        $i = 0;
        foreach ($language as $val) {
            CategoryLanguage::updateOrCreate(
                ['id_lang' => $val->id, 'id_categories' => $id],
                ['id_categories' => $id,
                    'id_lang' => $val->id,
                    'title' => $request->title[$i],
                    'slug' => Str::of(trim($request->title[$i]))->slug('-')]
            );
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
        Category::where("id", $request->id)->delete();
        CategoryLanguage::where("id_categories", $request->id)->delete();
        return redirect()->back();
    }
}
