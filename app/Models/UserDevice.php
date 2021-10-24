<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserDevice
 *
 * @property int $id
 * @property string|null $user_id
 * @property string $ip
 * @property string $browser
 * @property string|null $browser_version
 * @property string|null $device_platform
 * @property bool $is_mobile
 * @property bool $is_tablet
 * @property bool $is_desktop
 * @property bool $is_bot
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereBrowserVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereDevicePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereIsBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereIsDesktop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereIsMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereIsTablet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUserId($value)
 * @mixin \Eloquent
 */
class UserDevice extends Model
{
    use HasFactory;
    protected $guarded = ['_token'];
    
}
