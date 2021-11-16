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
 * App\Models\PaymentSystem
 *
 * @property string $id
 * @property string $name
 * @property string $code
 * @property mixed|null $instant_limit
 * @property mixed|null $external_balances
 * @property mixed|null $minimum_topup
 * @property mixed|null $minimum_withdraw
 * @property bool $connected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Currency[] $currencies
 * @property-read int|null $currencies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions_enter
 * @property-read int|null $transactions_enter_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions_withdraw
 * @property-read int|null $transactions_withdraw_count
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereConnected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereExternalBalances($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereInstantLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereMinimumTopup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereMinimumWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSystem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentSystem extends Model
{
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $fillable */
    protected $fillable = [
        'name',
        'id',
        'code',
        'instant_limit',
        'external_balances',
        'connected',
        'minimum_topup',
        'minimum_withdraw',
        'image',
        'image_alt',
        'image_title',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_payment_system', 'payment_system_id', 'currency_id');
    }
//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function wallets()
//    {
//        return $this->hasMany(Wallet::class, 'payment_system_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_system_id');
    }

    public function transactions_enter() {
        $ps = $this;
        return cache()->remember('sum_transactions_enter.'.$this->id, now()->addMinutes(60), function() use($ps) {
            return $ps->transactions()
                ->where('approved', 1)
                ->where('is_real', true)
                ->where('type_id', TransactionType::getByName('enter')->id)
                ->sum('main_currency_amount');
        });
    }

    public function transactions_withdraw() {
        $ps = $this;
        return cache()->remember('sum_transactions_withdraw.'.$this->id, now()->addMinutes(60), function() use($ps) {
            return $ps->transactions()
                ->where('approved', 1)
                ->where('is_real', true)
                ->where('type_id', TransactionType::getByName('withdraw')->id)
                ->sum('main_currency_amount');
        });
    }

   /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
//    public function tasks()
//    {
//        return $this->hasMany(Tasks::class, 'payment_system_id');
//    }

    /**
     * @param string $code
     * @return PaymentSystem|null
     */
    public static function getByCode(string $code)
    {
        return PaymentSystem::where('code', $code)->first();
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        $pss = [
            'perfectmoney'  => '\App\Modules\PaymentSystems\PerfectMoneyModule',
            'coinpayments'  => '\App\Modules\PaymentSystems\CoinpaymentsModule',
        ];

        return (key_exists($this->code, $pss))
            ? $pss[$this->code]
            : '';
    }

    /**
     * @return array
     */
    public static function balances(): array
    {
        foreach (PaymentSystem::all() as $ps) {
            $balances[$ps->code] = json_decode($ps->external_balances, true);
        }
        return $balances ?? [];
    }

    /**
     * @return void
     */
    public static function updateBalances()
    {
        foreach (PaymentSystem::all() as $ps) {
            if ($ps->getClassName()) {
                $balances[$ps->code] = $ps->getClassName()::getBalances();
            }
        }
    }

}
