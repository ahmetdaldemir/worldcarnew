<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogLanguage;
use App\Models\Brand;
use App\Models\Language;
use App\Models\MobilSlider;
use App\Models\MobilSliderLanguage;
use App\Models\MobilSliderModel;
use App\Models\Category;
use App\Models\Engine;
use App\Models\Image as ImageUpload;
use App\Models\PeriodPrice;
use App\Service\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Service\Image as ServiceImage;
use Illuminate\Support\Str;

class MobilSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobilSliders = MobilSlider::where('lang_id',1)->get();
        return view('admin.mobil_slider.index', ['MobilSliders' => $mobilSliders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.mobil_slider.create', ['languages' => $language]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param MobilSlider $model
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function save(Request $request)
    {
        $language = Language::all();

        $MobilSlider = new MobilSlider();
        $MobilSlider->save();
        $id = $MobilSlider->id;

        $i = 0;
        foreach ($language as $val) {
            $MobilSliderLanguage = new MobilSliderLanguage();
            $MobilSliderLanguage->mobil_slider_id  = $id;
            $MobilSliderLanguage->lang_id          = $val->id;
            $MobilSliderLanguage->title            = $request->title[$i];
            $MobilSliderLanguage->meta_title       = $request->meta_title[$i];
            $MobilSliderLanguage->meta_description = $request->meta_description[$i];
            $MobilSliderLanguage->save();
            $i++;
        }

        if($request->file('file') != NULL) {
            Image::uploadWebp($MobilSlider,$request);
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

        $MobilSlider = MobilSlider::find($request->id);
        $MobilSliderLanguage = MobilSliderLanguage::where("mobil_slider_id",$request->id)->first();
        $language = Language::all();
        return view('admin.mobil_slider.edit', ['languages' => $language,'mobil_slider' => $MobilSlider,'mobil_slider_language' => $MobilSliderLanguage]);
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
        $MobilSlider =  MobilSlider::find($request->id);
        foreach ($request->all() as $key => $value) {
            $MobilSlider->$key = $value;
        }
        $MobilSlider->save();
        return redirect()->route('admin.admin.mobil_slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        MobilSlider::where("id", $request->id)->delete();
        return redirect()->back();
    }


    /**
     * Update is_active.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function is_active(Request $request)
    {
        $status = $request->is_active == 0 ? 1 : 0;
        MobilSlider::where("id", $request->id)->update(['is_active' => $status]);
        return redirect()->back();
    }

    public function getAll($id_location)
    {
        $MobilSliders =  MobilSlider::all();
        foreach($MobilSliders as $item)
        {
                $brand = \App\Models\Brand::find($item->brand)->brandname ?? null;
                $MobilSlider_model = \App\Models\MobilSliderModel::find($item->model)->modelname ?? null;
                $year = $item->year;
                $engine = \App\Models\Engine::find($item->engine)->title;
                $data[] = array(
                    'id' => $item->id,
                    'title' => $brand." | ".$MobilSlider_model." | ".$year,
                );
        }
        return $data;
//        foreach ($MobilSlider as $item) {
//            $prices = PeriodPrice::where("id_location", $id_location)->where("id_MobilSlider", $item->id);
//            if ($prices->count() > 0) {
//
//                $MobilSlider[] = array(
//
//                );
//
//
//                foreach ($prices->get() as $val) {
//                    $data[] = array(
//                        'id_MobilSlider' => $val->id_MobilSlider,
//                        'mounth' => $val->mounth,
//                        'id_location' => $val->id_location,
//                        'period1' => $val->period1,
//                        'period2' => $val->period2,
//                        'period3' => $val->period3,
//                        'period4' => $val->period4,
//                        'period5' => $val->period5,
//                        'period6' => $val->period6,
//                        'period7' => $val->period7,
//                        'discount' => $val->discount,
//                        'status' => $val->status,
//                    );
//                }
//                return $data;
//            } else {
//                return $MobilSlider;
//            }
//        }

    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request)
    {
        return view('admin.MobilSlider.image', ['id' => $request->id]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $upload = new ServiceImage();
        $x = $upload->uploadImage($request,747,330,'MobilSliders');

        $image = new ImageUpload();
        $image->title = $x;
        $image->module = "MobilSliders";
        $image->id_module = $request->id;
        $image->save();
        return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function defaultImage(Request $request)
    {
        $upload = new ServiceImage();
        $x = $upload->uploadImage($request,"287","151",'MobilSliders');
        $MobilSlider = MobilSlider::find($request->id);
        $MobilSlider->default_images = $x;
        $MobilSlider->save();
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageDelete(Request $request)
    {
        $image = ImageUpload::find($request->id);
        $file= $image->title;
        $filename = public_path().'/storage/app/public/MobilSliders/'.$file;
        \File::delete($filename);
         ImageUpload::where('id', $request->id)->delete();
        return redirect()->back();
    }



}
