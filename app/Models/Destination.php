<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Base
{

    public function images()
    {
        return Image::where('model','destinations')->where('model_id',$this->id)->first();
    }
}
