<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSidebarProperties
 *
 * @property int $id
 * @property string $user_id
 * @property string $sb_prop
 * @property int $sb_val
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereSbProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereSbVal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSidebarProperties whereUserId($value)
 * @mixin \Eloquent
 */
class UserSidebarProperties extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'sb_prop',
        'sb_val',
        'created_at',
        'updated_at',
    ];
}
