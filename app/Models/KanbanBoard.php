<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KanbanBoard
 *
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\KanbanBoardTask[] $item
 * @property-read int|null $item_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard query()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoard whereUserId($value)
 * @mixin \Eloquent
 */
class KanbanBoard extends Model
{
    use HasFactory;
    use Uuids;

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
        'title',
        'user_id',
        'order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item()
    {
        return $this->hasMany(KanbanBoardTask::class)->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
