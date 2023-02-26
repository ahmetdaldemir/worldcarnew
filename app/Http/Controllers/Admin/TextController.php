<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Image as ImageUpload;
use App\Models\Language;
use App\Models\Text;
use App\Models\TextCategory;
use App\Models\TextLanguage;
use App\Service\Image;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class TextController extends Controller
{

    public function index()
    {
         $texts = Text::all();
         $textCategory = TextCategory::all();
        return view('admin.defination.texts.index', ['texts' => $texts,'textCategory' => $textCategory]);
    }

    public function create()
    {
        $language = Language::all();
        $textCategory = TextCategory::all();
        return view('admin.defination.texts.create', ['languages' => $language, 'categorys' => $textCategory]);

    }


    public function save(Request $request)
    {
        $language = Language::all();

        $file = "";
        if($request->image)
        {
            $namewithextension = $request->file("image")->getClientOriginalName();
            $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
            $fileName = time().'_'.Str::slug($name).".".$namewithextensionExt;
            $filePath = $request->file('image')->storeAs('public/text', $fileName);
            $file =  "text/".$fileName;
        }else {
            $file = "no-image.png";
        }

        $Text = new Text();
        $Text->category = $request->category;
        $Text->file = $file;
        $Text->save();
        $id = $Text->id;
        $i = 0;
        foreach ($language as $val) {
            $TextLanguage = new TextLanguage();
            $TextLanguage->id_text = $id;
            $TextLanguage->id_lang = $val->id;
            $TextLanguage->title = $request->title[$i];
            $TextLanguage->meta_title = $request->meta_title[$i];
            $TextLanguage->description = $request->description[$i];
            $TextLanguage->short_description = $request->short_description[$i];
            $TextLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
            $TextLanguage->save();
            $i++;
        }

        if($request->file('file') != "")
        {
            $heade_image = new Image();
            $x = $heade_image->uploadImage($request,1600,200,'texts');

            $image = new ImageUpload();
            $image->title = $x;
            $image->module = "texts";
            $image->id_module = $id;
            $image->save();
        }

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $language = Language::all();
        $text = Text::find($request->id);
        $textCategory = TextCategory::all();

        return view('admin.defination.texts.edit', ['id' => $id, 'languages' => $language,'text'=>$text, 'categorys' => $textCategory]);
    }


    public function update(Request $request)
    {
        $language = Language::all();

        $file = "";
        if ($request->image != NULL)
        {
            $namewithextension = $request->file("image")->getClientOriginalName();
            $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
            $fileName = time().'_'.Str::slug($name).".".$namewithextensionExt;
            $filePath = $request->file('image')->storeAs('public/text', $fileName);
            $imageName =  "text/".$fileName;
        }else {
            $imageName = $request->image1;
        }


        if($request->file('file') != "")
        {
            $namewithextension = $request->file("file")->getClientOriginalName();
            $namewithextensionExt = $request->file("file")->getClientOriginalExtension();
            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
            $fileName = time().'_'.Str::slug($name).".".$namewithextensionExt;
            $filePath = $request->file('file')->storeAs('public/text', $fileName);
            $x = "text/".$fileName;
        }else{
            $x = $request->header_image1;
        }


        $Text = Text::find($request->id);
        $Text->file = $imageName;
        $Text->header = $x;
        $Text->category = $request->category;
        $Text->save();

        $id = $request->id;
        $i = 0;
        foreach ($language as $val) {
            TextLanguage::where('id_lang', $val->id)->where('id_text', $id)->update(array(
                'id_text' => $id,
                'id_lang' => $val->id,
                'title' => $request->title[$i],
                'meta_title' => $request->meta_title[$i],
                'description' => $request->description[$i],
                'short_description' => $request->short_description[$i],
            'slug' => Str::of(trim($request->title[$i]))->slug('-')
            ));
            $i++;
        }
        return redirect()->back();
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        TextLanguage::where("id_text", $id)->delete();
        Text::where("id", $id)->delete();
        return redirect()->back();
    }
}
