<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KanbanBoardTask
 *
 * @property string $id
 * @property string $kanban_board_id
 * @property string $title
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\KanbanBoard $kanbanBoard
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereKanbanBoardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KanbanBoardTask whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KanbanBoardTask extends Model
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
        'kanban_board_id',
        'order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kanbanBoard()
    {
        return $this->belongsTo(KanbanBoard::class);
    }
}
