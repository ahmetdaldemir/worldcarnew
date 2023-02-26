<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodPrice extends Base
{
    protected $fillable = [
        'id_car',
        'id_location',
        'mounth',
        'period1',
        'period2',
        'period3',
        'period4',
        'period5',
        'period6',
        'period7',
        'discount',
        'status',
        'min_day'
    ];


}
