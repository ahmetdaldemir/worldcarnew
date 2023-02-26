<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstra extends Base
{
    public function getLang()
    {
        return $this->belongsTo(EkstraLanguage::class, 'id_ekstra', 'id');
    }



}
