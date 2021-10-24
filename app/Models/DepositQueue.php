<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DepositQueue
 *
 * @package App\Models
 * string id
 * string deposit_id
 * integer type
 * integer available_at
 * integer done
 * Carbon created_at
 * Carbon updated_at
 * @property-read \App\Models\Deposit $deposit
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue query()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereDepositId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositQueue whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $id
 * @property string $deposit_id
 * @property int $type
 * @property string $available_at
 * @property bool $done
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class DepositQueue extends Model
{
    CONST TYPE_ACCRUE = 1;
    CONST TYPE_CLOSING = 2;

    use Uuids;
    public $keyType      = 'string';
    
    public $incrementing = false;

    /** @var string $table */
    protected $table = 'deposit_queue';

    /** @var array $timestamps */
    public $timestamps = ['created_at', 'updated_at'];

    /** @var array $fillable */
    protected $fillable = [
        'deposit_id',
        'type',
        'available_at',
        'done',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'deposit_id');
    }

    /**
     * @return $this
     */
    public function setTypeAccrue()
    {
        $this->type = self::TYPE_ACCRUE;
        return $this;
    }

    /**
     * @return $this
     */
    public function setTypeClosing()
    {
        $this->type = self::TYPE_CLOSING;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTypeAccrue()
    {
        return $this->type == self::TYPE_ACCRUE;
    }

    /**
     * @return bool
     */
    public function isTypeClosing()
    {
        return $this->type == self::TYPE_CLOSING;
    }

    /**
     * @param Carbon $carbon
     * @return $this
     */
    public function setAvailableAt(Carbon $carbon)
    {
        $this->available_at = $carbon;
        return $this;
    }

    /**
     * @return $this
     */
    public function setIsDone()
    {
        $this->done = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return $this->done == 1;
    }
}