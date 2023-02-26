<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobilSlider extends Base
{


    public function language()
    {
        return Image::where('model','mobil_sliders')->where('model_id',$this->id)->first();
    }

    public function images()
    {
        return Image::where('model','mobil_sliders')->where('model_id',$this->id)->first();
    }

}
