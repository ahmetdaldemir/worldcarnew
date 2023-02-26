<?php namespace App\Repositories\Tour;

use App\Models\Language;
use App\Models\Tour;
use App\Models\TourLanguage;
use App\Service\Image;
use Illuminate\Support\Str;

class TourRepository implements TourRepositoryInterface
{

    public function get($id)
    {
        return Tour::find($id);
    }

    public function create(object $data)
    {
        if ($data->file('image') != "") {
            $image = new Image();
            $imageName = $image->uploadImage($data, 800, 600, 'tours');
        } else {
            $imageName = "default.jpg";
        }
        $transfer = new Tour();
        $transfer->image = $imageName;
        $transfer->price = $data->price;
        $transfer->days = $data->days;
        $transfer->time = $data->time;
        $transfer->tour_days = $data->tour_days;
        $transfer->save();

        $id = $transfer->id;
        $language = Language::all();
        $i = 0;
        foreach ($language as $val) {
            $transferLanguage = new TourLanguage();
            $transferLanguage->lang_id = $val->id;
            $transferLanguage->tour_id = $id;
            $transferLanguage->title = $data->title[$i];
            $transferLanguage->slug =  Str::slug($data->title[$i]);
            $transferLanguage->description = $data->description[$i];
            $transferLanguage->save();
            $i++;
        }

        return $transfer;
    }

    public function all()
    {
        return Tour::all();
    }

    public function find($id)
    {
        return Tour::find($id);
    }

    public function delete($id)
    {
        Tour::destroy($id);
    }

    public function update(object $data)
    {
        if ($data->file('image') != "") {
            $image = new Image();
            $imageName = $image->uploadImage($data, 800, 600, 'tours');
        } else {
            $imageName = $data->imageName;
        }
        $transfer = Tour::find($data->id);

        $transfer->image = $imageName;
        $transfer->price = $data->price;
        $transfer->days = $data->days;
        $transfer->time = $data->time;
        $transfer->tour_days =  $data->tour_days;
        $transfer->save();

        TourLanguage::where('tour_id',$data->id)->delete();

        $language = Language::all();
        $i = 0;
        foreach ($language as $val) {
            $transferLanguage = new TourLanguage();
            $transferLanguage->lang_id = $val->id;
            $transferLanguage->tour_id = $data->id;
            $transferLanguage->title = $data->title[$i];
            $transferLanguage->slug =  Str::slug($data->title[$i]);
            $transferLanguage->description = $data->description[$i];
            $transferLanguage->save();
            $i++;
        }
    }
}
