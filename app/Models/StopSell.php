<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StopSell extends Model
{
    use HasFactory;

    protected $fillable = ['id_car'];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'id_car', 'id');
    }


}
