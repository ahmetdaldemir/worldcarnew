<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogLanguage;
use App\Models\Destination;
use App\Models\DestinationLanguage;
use App\Models\Language;
use App\Models\Location;
use App\Service\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Destinations = DestinationLanguage::where("id_lang",1)->get();
        return view('admin.defination.destinations.index', ['Destinations' => $Destinations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        $destinations = DestinationLanguage::where("id_lang",1)->get();
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->where('locations.id_parent', 0)->get();
        return view('admin.defination.destinations.create',['languages' => $language,'destinations' =>$destinations,'locations' => $locations]);

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
        //   $filesValue = "";
        //   if($request->image)
        //   {
        //       $namewithextension = $request->file("image")->getClientOriginalName();
        //     $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
        //       $name = explode('.', $namewithextension)[0]; // Filename 'filename'
        //       $fileName = time().'_'.Str::slug($name);
        //       $filePath = $request->file('image')->storeAs('public/destination', $fileName);
        //      $filesValue = "destination/".$fileName;
        // }

        $Destination = new Destination();
        $Destination->main_destination  =   $request->main_destination;
        $Destination->location_destination  =   $request->location_destination;
        $Destination->coordinate  =   $request->coordinate;
      //  $Destination->image  = $filesValue;
        $data = $Destination->save();
        $id = $Destination->id;

      $i=0;  foreach ($language as $val)
        {
            $DestinationLanguage = new DestinationLanguage();
            $DestinationLanguage->id_destination  = $id;
            $DestinationLanguage->id_lang  = $val->id;
            $DestinationLanguage->title  = $request->title[$i] ?? null;
            $DestinationLanguage->short_description  = $request->short_description[$i] ?? null;
            $DestinationLanguage->description  = $request->description[$i] ?? null;
            $DestinationLanguage->meta_title  = $request->meta_title[$i] ?? null;
            $DestinationLanguage->image_alt  = $request->image_alt[$i] ?? null;
            $DestinationLanguage->image_alt_title  = $request->image_alt_title[$i] ?? null;
            $DestinationLanguage->slug  = Str::of(trim($request->title[$i]))->slug('-');
            $DestinationLanguage->save();
            $i++;
        }
        if($request->file('file') != NULL) {
            Image::uploadWebp($Destination,$request);
        }
        return redirect("admin/admin/destinations");
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
        $id =  $request->id;
        $language = Language::all();
        $main_destination = Destination::find($id);
        $destinations = DB::table('destinations')
            ->leftJoin('destination_languages', 'destinations.id', '=', 'destination_languages.id_destination')
            ->select('destinations.*', 'destination_languages.title', 'destination_languages.slug')->where('destination_languages.id_lang', 1)
            ->get();
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->where('locations.id_parent', 0)->get();
        $images = \App\Models\Image::where('model','destinations')->where('model_id',$request->id)->first();

        return view('admin.defination.destinations.edit',['images'=>$images,'languages' => $language,'locations' => $locations,'destinations' => $destinations,'main_destination' => $main_destination,'id'=>$id]);
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

        //    if ($request->image != NULL) {
        //        $namewithextension = $request->file("image")->getClientOriginalName();
        //        $namewithextensionExt = $request->file("image")->getClientOriginalExtension();
        //        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
        //        $fileName = time().'_'.Str::slug($name);
        //        $request->file('image')->storeAs('public/destination', $fileName);
        //        $imageName = "destination/".$fileName;
        //    } else {
        //        $imageName = $request->image1 ?? "NULL";
        //    }

        $Destination = Destination::find($request->id);
        $Destination->main_destination  =   $request->main_destination;
        $Destination->location_destination  =   $request->location_destination;
        $Destination->coordinate  =   $request->coordinate;
     //   $Destination->image  = $imageName;
        $Destination->save();

        $id = $request->id;
        $i = 0;
        foreach ($language as $val) {
            DestinationLanguage::where('id_lang', $val->id)->where('id_destination', $id)->update(array(
                'id_destination'  => $id,
                'id_lang'  => $val->id,
                'title'  => $request->title[$i],
                'short_description'  => $request->short_description[$i],
                'description'  => $request->description[$i],
                'image_alt' => $request->image_alt[$i],
                'image_alt_title' => $request->image_alt_title[$i],
                'meta_title'  => $request->meta_title[$i],
                'slug' => Str::of(trim($request->title[$i]))->slug('-'),
            ));
            $i++;
        }



        if($request->file('file') != NULL) {
            Image::uploadWebp($Destination,$request);
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
        $destination = Destination::find($request->id);
        $destination->delete();
        DestinationLanguage::where("id_destination",$request->id)->delete();
        return redirect()->back();
    }
}
