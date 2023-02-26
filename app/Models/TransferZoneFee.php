<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferZoneFee extends Base
{
    protected $fillable = ['id_location','id_location_transfer_zone','distance', 'price', 'status'];
    use HasFactory;


}




