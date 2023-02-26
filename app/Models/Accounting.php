<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accounting extends Model
{
    use SoftDeletes;
    use HasFactory;

    const in = "Gelir";
    const out = "Gider";

    public const TYPE = [
        'in'      => Accounting::in,
        'out'     => Accounting::out,
    ];


    public function category()
    {
        return $this->belongsTo(AccountingCategory::class,'category_id','id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id','id');
    }
}


