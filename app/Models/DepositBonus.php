<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DepositBonus
 *
 * @property string $id
 * @property string $status_name
 * @property string $status_stage
 * @property float $personal_turnover
 * @property float $total_turnover
 * @property float $reward
 * @property string|null $leadership_bonus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereLeadershipBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus wherePersonalTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereStatusStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereTotalTurnover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepositBonus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DepositBonus extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
}
