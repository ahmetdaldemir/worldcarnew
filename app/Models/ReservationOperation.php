<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationOperation extends Base
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'id_user', 'id');
    }
}
