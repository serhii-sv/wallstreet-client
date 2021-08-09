<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class UserGeoip extends Model
{
    use HasFactory;
    use Uuids;
    use Impersonate;
    
    public    $keyType  = 'string';
    protected $fillable = [
        'user_id',
        'is_admin',
        'country',
        'city',
        'ip',
    ];
}
