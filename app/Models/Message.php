<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Message extends Base
{
    use HasRoles,HasPermissions;



}
