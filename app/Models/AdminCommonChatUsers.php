<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminCommonChatUsers
 *
 * @property string $id
 * @property string $message_id
 * @property string $user_id
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminCommonChatUsers whereUserId($value)
 * @mixin \Eloquent
 */
class AdminCommonChatUsers extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
}
