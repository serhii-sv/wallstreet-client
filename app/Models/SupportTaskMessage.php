<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupportTaskMessage
 *
 * @property string $id
 * @property string $user_id
 * @property string $support_task_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SupportTask $supportTask
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereSupportTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportTaskMessage whereUserId($value)
 * @mixin \Eloquent
 */
class SupportTaskMessage extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    protected $table = 'support_tasks_messages';

    /**
     * @var string
     */
    public $keyType = 'string';

    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'support_task_id',
        'message'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supportTask()
    {
        return $this->belongsTo(SupportTask::class);
    }
}
