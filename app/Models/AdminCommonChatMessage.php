<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminCommonChatMessage
 *
 * @property string $id
 * @property string $user_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatMessage whereUserId($value)
 * @mixin \Eloquent
 */
class AdminCommonChatMessage extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
