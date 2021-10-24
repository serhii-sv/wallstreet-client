<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAuthLog
 *
 * @package App\Models
 * string user_id
 * bool is_admin
 * string ip
 * @property int $id
 * @property string $user_id
 * @property bool $is_admin
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthLog whereUserId($value)
 * @mixin \Eloquent
 */

class UserAuthLog extends Model
{
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
