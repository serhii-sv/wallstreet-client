<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\UserGeoip
 *
 * @property string $id
 * @property string $user_id
 * @property bool $is_admin
 * @property string|null $country
 * @property string|null $city
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGeoip whereUserId($value)
 * @mixin \Eloquent
 */
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
