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
 * Class Rate
 *
 * @package App\Models
 * string id
 * string currency_id
 * string name - название тарифного плана.
 * float min - минимальная сумма инвестиций.
 * float max - максимальная сумма инвестиций.
 * float daily - процент ежедневных начислений, может не задаваться.
 * integer duration - продолжительность действия депозита (в днях) равно кол-ву ежедневных начислений.
 * integer reinvest - активна ли возможность реинвестировоать в депозит.
 * integer autoclose - автозакрытие депозитов по этому плану.
 * integer active - активен ли тарифный план.
 * Carbon created_at
 * Carbon updated_at
 * @property bool $refund_deposit
 * @property bool $upgradable
 * @property int|null $rate_group_id
 * @property float $overall
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $deposits
 * @property-read int|null $deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereAutoclose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDaily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereOverall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRateGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRefundDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereReinvest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpgradable($value)
 * @mixin \Eloquent
 * @property string $id
 * @property string $name
 * @property string|null $min
 * @property string|null $max
 * @property float $daily
 * @property int $duration
 * @property bool $reinvest
 * @property bool $autoclose
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Rate extends Model
{
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $fillable */
    protected $fillable = [
        'name',
        'min',
        'max',
        'daily',
        'duration',
        'reinvest',
        'autoclose',
        'active',
        'upgradable',
        'overall',
        'rate_group_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class,'rate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'rate_id');
    }
}
