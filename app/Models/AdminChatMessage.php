<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminChatMessage
 *
 * @property string $id
 * @property string $chat_id
 * @property string $user_id
 * @property string $message
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChatMessage whereUserId($value)
 * @mixin \Eloquent
 */
class AdminChatMessage extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
