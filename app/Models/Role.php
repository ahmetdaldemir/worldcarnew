<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Role extends Base
{
    use HasRoles,HasPermissions;



}
