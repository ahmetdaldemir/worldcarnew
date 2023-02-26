<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DB;
class AccessReport extends Base
{
    use HasFactory;

    protected $table = "access_reports";
    protected $fillable = ['language_id', 'country', 'ip', 'referer', 'url', 'modelname', 'platform', 'token', 'type'];

    public static function ip_count($ip)
    {
        $user_info = DB::table('access_reports')
            ->where('ip', $ip)
            ->where('type', 'search')
            ->groupBy('ip')
            ->count();
        return $user_info;
    }


}
