<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMultiAccounts
 *
 * @property string $id
 * @property string $user_id
 * @property string $main_user_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $main_user
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereMainUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultiAccounts whereUserId($value)
 * @mixin \Eloquent
 */
class UserMultiAccounts extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function main_user() {
        return $this->belongsTo(User::class, 'main_user_id', 'id');
    }
}
