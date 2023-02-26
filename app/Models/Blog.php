<?php

namespace App\Models;


use Spatie\Permission\Traits\HasRoles;

class Blog extends Base
{
    use HasRoles;

    protected $guard_name = 'admin-web';


    public function images()
    {
        return Image::where('model','blogs')->where('model_id',$this->id)->first();
    }

}
