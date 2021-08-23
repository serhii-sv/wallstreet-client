<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'description'
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
        return $this->hasMany(SupportTaskMessage::class, 'support_task_id');
    }
}
