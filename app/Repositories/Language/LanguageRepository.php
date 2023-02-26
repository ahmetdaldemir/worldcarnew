<?php namespace App\Repositories\Language;

use App\Models\Language;
use App\Service\Image;
use Illuminate\Support\Str;

class LanguageRepository implements LanguageRepositoryInterface
{

    public function get($id)
    {
        return Language::find($id);
    }

    public function create(object $data)
    {
        if ($data->file('file') != "") {
            $image = new Image();
            $imageName = $image->uploadImage($data, 800, 600, 'tours');
        } else {
            $imageName = "default.jpg";
        }
        $transfer = new Language();
        $transfer->image = $imageName;
        $transfer->price = $data->price;
        $transfer->days = $data->days;
        $transfer->time = $data->time;
        $transfer->tour_days = json_encode($data->tour_days);
        $transfer->save();

        $id = $transfer->id;
        $language = Language::all();
        $i = 0;
        foreach ($language as $val) {
            $transferLanguage = new LanguageLanguage();
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
        return Language::all();
    }

    public function find($id)
    {
        return Language::find($id);
    }

    public function delete($id)
    {
        Language::destroy($id);
    }

    public function update($id, object $data)
    {
        Language::find($id)->update((array)$data);
    }
}
