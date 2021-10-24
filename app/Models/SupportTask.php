<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupportTask
 *
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupportTaskMessage[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTask whereUserId($value)
 * @mixin \Eloquent
 */
class SupportTask extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';

    /** @var bool $incrementing */
    public $incrementing = false;

    /** Task statuses */
    const PENDING_STATUS = 'pending';
    const ANSWERED_STATUS = 'answered';
    const CLOSED_STATUS = 'closed';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(SupportTaskMessage::class);
    }
}
