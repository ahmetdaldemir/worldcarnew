<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogLanguage;
use App\Models\Language;
use App\Service\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class BlogController extends Controller
{


    function __construct()
    {

    }

    public function index()
    {
        $blogs = Blog::all();
        return view('admin.defination.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.defination.blogs.create', ['languages' => $language]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $language = Language::all();
        $filesValue = "";
     //   if($request->image)
        //  {
        //   $namewithextension = $request->file("image")->getClientOriginalName();
        //   $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
        //   $name = explode('.', $namewithextension)[0]; // Filename 'filename'
        //   $fileName = time().'_'.Str::slug($name).".".$namewithextensionExt;
        //   $request->file('image')->storeAs('public/blog', $fileName);
        //   $imageName =  "blog/".$fileName;
        // }
        $Blog = new Blog();
        // $Blog->image = $imageName;
        $Blog->save();
        $id = $Blog->id;
        $i = 0;
        foreach ($language as $val) {
            $BlogLanguage = new BlogLanguage();
            $BlogLanguage->id_Blog = $id;
            $BlogLanguage->id_lang = $val->id;
            $BlogLanguage->title = $request->title[$i];
            $BlogLanguage->short_description = $request->short_description[$i];
            $BlogLanguage->description = $request->description[$i];
            $BlogLanguage->meta_title = $request->meta_title[$i];
            $BlogLanguage->image_alt = $request->image_alt[$i];
            $BlogLanguage->image_alt_title = $request->image_alt_title[$i];

            $BlogLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
            $BlogLanguage->save();
            $i++;
        }
        if($request->file('file') != NULL) {
            Image::uploadWebp($Blog,$request);
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $Blog = Blog::find($request->id);
        $Blog->view = $request->view;
        $Blog->save();
        return redirect()->back();
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
        $images = \App\Models\Image::where('model','blogs')->where('model_id',$request->id)->first();
        return view('admin.defination.blogs.edit', ['id' => $id, 'languages' => $language,'images' => $images]);
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

      //  if ($request->image != NULL) {
        //      $namewithextension = $request->file("image")->getClientOriginalName();
        //    $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
        //    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
        //    $fileName = time().'_'.Str::slug($name).".".$namewithextensionExt;
        //    $filePath = $request->file('image')->storeAs('public/blog', $fileName);
        //    $filePathName = explode("/",$filePath);
        //    $imageName =  "blog/".$fileName;
        // } else {
        //    $imageName = $request->image1;
        // }

        $Blog = Blog::find($request->id);
        //$Blog->image = $imageName;
        $Blog->save();

        $id = $request->id;
        $i = 0;
        foreach ($language as $val) {
            BlogLanguage::where('id_lang', $val->id)->where('id_blog', $id)->update(array(
                'id_blog' => $id,
                'id_lang' => $val->id,
                'title' => $request->title[$i] ?? "Boş",
                'short_description' => $request->short_description[$i],
                'image_alt' => $request->image_alt[$i],
                'image_alt_title' => $request->image_alt_title[$i],
                'description' => $request->description[$i],
                'meta_title' => $request->meta_title[$i],
                'slug' => Str::of(trim($request->title[$i]??"Boş"))->slug('-')
            ));
            $i++;
        }
         if($request->file('file') != NULL) {
         Image::uploadWebp($Blog, $request);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->delete();
        BlogLanguage::where("id_blog", $request->id)->delete();
        return redirect()->back();
    }
}
