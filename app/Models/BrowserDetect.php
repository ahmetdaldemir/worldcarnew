<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrowserDetect extends Model
{
    use HasFactory;
    protected $fillable = ['uuid',
                           'created_at',
                           'model',
                           'url_current',
                           'user_id',
                           'ip_address',
                           'browser'];



}
