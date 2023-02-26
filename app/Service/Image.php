<?php

namespace App\Service;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Storage;
use ValidateRequests;
use Intervention\Image\Facades\Image as ImageUploadIntervention;
use Intervention\Image\ImageManager;
use App\Models\Image as ImageModel;

class Image
{
    public function uploadImage($request,$width,$height,$module)
    {

        $imageName =  $request->file('image')->getClientOriginalName();
        $explode = explode(".",$imageName);
        $ext =  $request->file('image')->getClientOriginalExtension();
        $imageName = $module."_".time().Str::slug($explode[0]).'.'.$ext;
        $filePath = $request->file('image')->storeAs('public/uploads', $imageName);
        return $imageName;
    }


    public static function uploadWebp(Model $model,Request $request)
    {

       $random = rand(0,999);

       //$x = Webp::make($request->file('file'))->save(storage_path().'/app/webp/'.$random.'.webp', 50);

        $imageName =  $request->file('file')->getClientOriginalName();
        $explode = explode(".",$imageName);
        $ext =  $request->file('file')->getClientOriginalExtension();
        $imageName = time().'_'.Str::slug($explode[0]).'.webp';
        $request->file('file')->storeAs('public/webp', $imageName);

       ImageModel::where('id_module',$model->id)->where('module',$model->getTable())->delete();

       $images = new ImageModel();
       $images->title     = $imageName;
       $images->module    = $model->getTable();
       $images->id_module = $model->id;
       $images->default   = "normal";
       $images->model     = $model->getTable();
       $images->model_id  = $model->id;
       $images->alt       = $request->alt;
       $images->alt_title = $request->alt_title;
       $images->pixel     = "1000*800";
       $images->platform  = "web";
       $images->save();
   }
}
