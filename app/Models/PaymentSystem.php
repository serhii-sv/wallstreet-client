<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentSystem
 * @package App\Models
 *
 * @property string id
 * @property string name
 * @property string code
 * @property string instant_limit
 * @property string created_at
 * @property string updated_at
 * @property string external_balances
 * @property int connected
 * @property string minimum_topup
 * @property string minimum_withdraw
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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_payment_system', 'payment_system_id', 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'payment_system_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_system_id');
    }

    public function transactions_enter() {
        return $this->hasMany(Transaction::class, 'payment_system_id')->whereIn('type_id', [TransactionType::where('name', 'enter')->select('id')->get()->toArray()]);
    }

    public function transactions_withdraw() {
        return $this->hasMany(Transaction::class, 'payment_system_id')->whereIn('type_id', [TransactionType::where('name', 'withdraw')->select('id')->get()->toArray()]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'payment_system_id');
    }

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
            'advcash'       => '\App\Modules\PaymentSystems\AdvcashModule',
            'perfectmoney'  => '\App\Modules\PaymentSystems\PerfectMoneyModule',
            'payeer'        => '\App\Modules\PaymentSystems\PayeerModule',
            'coinpayments'  => '\App\Modules\PaymentSystems\CoinpaymentsModule',
            'blockio'       => '\App\Modules\PaymentSystems\BlockioModule',
            'enpay'         => '\App\Modules\PaymentSystems\EnpayModule',
            'nixmoney'      => '\App\Modules\PaymentSystems\NixmoneyModule',
            'waves'         => '\App\Modules\PaymentSystems\WavesModule',
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
