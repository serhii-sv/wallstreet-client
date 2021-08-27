<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
