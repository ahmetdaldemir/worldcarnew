<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Base
{
    use HasFactory;

    protected $fillable = ['email', 'firstname',
        'id_customer',
        'lastname',
        'phone'];

}
