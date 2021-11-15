<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Models\UserTasks\Tasks;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 *
 * @package App\Models
 * string id
 * string name
 * string code
 * integer precision
 * string symbol
 * @property string|null currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CryptoCurrencyRateLog[] $rateLog
 * @property-read int|null $rate_log_count
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency wherePrecision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $id
 * @property string|null $name
 * @property string $code
 * @property string|null $symbol
 * @property int|null $precision
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $deposits
 * @property-read int|null $deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentSystem[] $paymentSystems
 * @property-read int|null $payment_systems_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallet[] $wallets
 * @property-read int|null $wallets_count
 */
class Currency extends Model
{
    use Uuids;

    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
        'precision',
        'symbol',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paymentSystems()
    {
        return $this->belongsToMany(PaymentSystem::class, 'currency_payment_system', 'currency_id', 'payment_system_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'currency_id');
    }
//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function tasks()
//    {
//        return $this->hasMany(Tasks::class, 'currency_id');
//    }
//
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'currency_id');
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function rates()
//    {
//        return $this->hasMany(Rate::class, 'currency_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'currency_id');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function balances(): array
    {
        return cache()->remember('admin.currency.nullBalance', now()->addMinutes(60), function () {
            foreach (self::all() as $currency) {
                $balances[$currency->code] = 0.00;
            }
            return isset($balances)? $balances : [];
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rateLog()
    {
        return $this->hasMany(CryptoCurrencyRateLog::class);
    }

    public function getCoinIcon()
    {
        $code = strpos($this->code, 'USD') !== false ? 'USD' : $this->code;
        $this->icon = asset('images/coins/' . strtolower($code) . '.png');
    }

    public function getRisePercentage()
    {
        $data = $this->rateLog()->get()->reverse()->take(2)->pluck('rate')->toArray();

        $this->rate_exchange_percentage = 0;

        if (count($data) == 2) {
            list($lastRecordRate, $previousRecordRate) = $this->rateLog()->get()->reverse()->take(2)->pluck('rate')->toArray();

            if ($lastRecordRate > $previousRecordRate) {
                $this->rate_exchange_percentage = round(($previousRecordRate / $lastRecordRate) * 100, 2);
            }

            if ($previousRecordRate > $lastRecordRate) {
                $this->rate_exchange_percentage = -round(($previousRecordRate / $lastRecordRate) * 100, 2);
            }
        }
    }
}
