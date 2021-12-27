<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\SumOperations;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Deposit
 *
 * @package App\Models
 * string id
 * string currency_id валюта
 * string wallet_id кошелек с которого создается депозит, на него же возвращается при закрытии
 * string user_id
 * string rate_id ИД тарифного плана
 * float  daily процент ежедневных начислений
 * float  overall процент на начальную сумму при закрытии
 * int    duration продолжительность действия депозита (в днях) равно кол-ву ежедневных начислений
 * float  payout выплата начальной суммы в процентах
 * float  invested начальная сумма депозита
 * float  balance текущий баланс (с учетом начислений)
 * int    reinvest ставка реинвестирования
 * int    autoclose закрываем депозит по графику
 * int    active статус
 * string condition последнее действие
 * Carbon datetime_closing
 * Carbon created_at
 * Carbon updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepositQueue[] $activeCharges
 * @property-read int|null                                                            $active_charges_count
 * @property-read \App\Models\Currency                                                $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepositQueue[] $depositQueue
 * @property-read int|null                                                            $deposit_queue_count
 * @property-read \App\Models\Rate                                                    $rate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[]  $transactions
 * @property-read int|null                                                            $transactions_count
 * @property-read \App\Models\User                                                    $user
 * @property-read \App\Models\Wallet                                                  $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereAutoclose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereDaily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereDatetimeClosing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereIntId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereInvested($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereOverall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit wherePayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereReinvest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereWalletId($value)
 * @mixin \Eloquent
 * @property string                                                                   $id
 * @property string                                                                   $currency_id
 * @property string                                                                   $rate_id
 * @property string                                                                   $user_id
 * @property string                                                                   $wallet_id
 * @property float|null                                                               $daily
 * @property float|null                                                               $overall
 * @property int|null                                                                 $duration
 * @property float|null                                                               $payout
 * @property float                                                                    $invested
 * @property float                                                                    $balance
 * @property bool                                                                     $autoclose
 * @property bool                                                                     $active
 * @property string                                                                   $condition
 * @property string                                                                   $datetime_closing
 * @property \Illuminate\Support\Carbon|null                                          $created_at
 * @property \Illuminate\Support\Carbon|null                                          $updated_at
 * @property int                                                                      $reinvest
 * @property int                                                                      $int_id
 */
class Deposit extends Model
{
    use Uuids;
    use SumOperations;

    /** @var bool $incrementing */
    public $incrementing = false;
    /**
     * @var string
     */
    public $keyType = 'string';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'currency_id',
        'user_id',
        'wallet_id',
        'rate_id',
        'daily',
        'overall',
        'duration',
        'payout',
        'invested',
        'balance',
        'reinvest',
        'autoclose',
        'active',
        'condition',
        'datetime_closing',
        'created_at',
    ];

    /**
     * @return int|mixed
     */
    public function total_assessed() {
        return $this->transactions()->where('type_id', TransactionType::where('name', 'dividend')->firstOrFail()->id)->sum('amount');
    }

    /**
     * @return int|mixed
     */
    public function total_assessed_main_currency() {
        return $this->transactions()->where('type_id', TransactionType::where('name', 'dividend')->firstOrFail()->id)->sum('main_currency_amount');
    }

    /**
     * @return int|mixed
     */
    public function total_created_sum() {
        return $this->transactions()->where('type_id', TransactionType::where('name', 'create_dep')->firstOrFail()->id)->sum('amount');
    }

    /**
     * @return int|mixed
     */
    public function total_created_sum_main_currency() {
        return $this->transactions()->where('type_id', TransactionType::where('name', 'create_dep')->firstOrFail()->id)->sum('main_currency_amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany(Transaction::class, 'deposit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate() {
        return $this->belongsTo(Rate::class, 'rate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet() {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    /**
     * @return mixed
     */
    /*
     public function paymentSystem() {
         return $this->wallet ? $this->wallet->first()->paymentSystem() : null;
     }*/

    /**
     * @param $value
     *
     * @return float
     * @throws \Exception
     */
    public function getBalanceAttribute($value) {
        return $value;
    }

    /**
     * @param $value
     *
     * @return float
     * @throws \Exception
     */
    public function getInvestedAttribute($value) {
        return $value;
    }

    /**
     * @param                      $field
     * @param \App\Models\Currency $currency
     * @param bool                 $force
     *
     * @return Deposit|null
     * @throws \Throwable
     */
    public static function addDeposit($field, Currency $currency, bool $force = false) {
        /** @var User $user */
        $user = isset($field['user']) ? $field['user'] : Auth::user();

        /** @var Rate $rate */
        $rate = Rate::findOrFail($field['rate_id']);
        /** @var Wallet $wallet */
        $wallet = Wallet::where('user_id', $user->id)
            ->where('currency_id', $currency->id)
            ->firstOrFail();
        $amount = abs($field['amount']);
        $reinvest = array_key_exists('reinvest', $field) ? abs($field['reinvest']) : 0;

        if ($currency->id != $wallet->currency_id) {
            throw new \Exception('Wrong currency ID');
        }

        if (false === $force) {
            if ($amount < $rate->min || $amount > $rate->max) {
                throw new \Exception('Wrong deposit amount. Less or greater than in tariff plan.');
            }

            if (abs($amount) > abs($wallet->balance)) {
                throw new \Exception('Not enough money at your balance.');
            }
        }


        /**
         * LUMINEX SPECIAL
         */
        $highPercent = 1.28;

        if ($amount >= 1000 && $currency->code == 'USD') {
            $rate->daily = $highPercent;
        } else if ($amount >= 0.02989986 && $currency->code == 'BTC') {
            $rate->daily = $highPercent;
        } else if ($amount >= 4033.97380466 && $currency->code == 'DOGE') {
            $rate->daily = $highPercent;
        } else if ($amount >= 0.47153994 && $currency->code == 'ETH') {
            $rate->daily = $highPercent;
        } else if ($amount >= 1.92302 && $currency->code == 'BCH') {
            $rate->daily = $highPercent;
        } else if ($amount >= 6.96692 && $currency->code == 'LTC') {
            $rate->daily = $highPercent;
        } else if ($amount >= 842.83 && $currency->code == 'EUR') {
            $rate->daily = $highPercent;
        } else if ($amount >= 1000 && $currency->code == 'USDT.ERC20') {
            $rate->daily = $highPercent;
        } else if ($amount >= 1000 && $currency->code == 'USDT.TRC20') {
            $rate->daily = $highPercent;
        } else if ($amount >= 1445.64775 && $currency->code == 'XRP') {
            $rate->daily = $highPercent;
        } else if ($amount >= 73276.90 && $currency->code == 'RUB') {
            $rate->daily = $highPercent;
        }
        // -------------------------------------------

        $deposit = new Deposit;
        $deposit->rate_id = $rate->id;
        $deposit->currency_id = $currency->id;
        $deposit->wallet_id = $wallet->id;
        $deposit->user_id = $user->id;
        $deposit->invested = $amount;
        $deposit->daily = $rate->daily;
        $deposit->overall = $rate->overall;
        $deposit->duration = $rate->duration;
        $deposit->payout = $rate->payout;
        $deposit->balance = $amount;
        $deposit->reinvest = $reinvest;
        $deposit->autoclose = $rate->autoclose;
        $deposit->condition = 'create';
        $deposit->datetime_closing = now()->addDays($rate->duration);
        $deposit->created_at = isset($field['created_at']) ? $field['created_at'] : now();

        $transaction = $deposit->save() ? Transaction::createDeposit($deposit) : null;

        if (null != $transaction && $deposit->wallet->removeAmount($amount)) {
            $wallet->accrueToPartner($amount, 'refill');

            $transaction->update(['approved' => true]);
            $deposit->update(['active' => true]);

            // send notification to user
            $data = [
                'deposit' => $deposit,
            ];
            //            $deposit->user->sendNotification('deposit_opened', $data);
            return ($deposit->createSequence()) ? $deposit : null;
        };
        throw new \Exception("Transaction start or wallet error! " . print_r($field, true));
    }

    /**
     * @return bool
     */
    public function createSequence() {
        /** @var Rate $rate */
        $rate = $this->rate()->first();

        if (!is_int($this->duration) || $this->duration < 1) {
            return false;
        }

        for ($i = 1; $i <= $rate->duration; $i++) {
            $time = Carbon::parse($this->created_at);

            $depositQueue = new DepositQueue();
            $depositQueue->deposit_id = $this->id;
            $depositQueue->setTypeAccrue();
            $depositQueue->setAvailableAt($time->addDays($i));
            $depositQueue->save();
        };

        if ($this->autoclose) {
            $time = Carbon::parse($this->created_at);

            $depositQueue = new DepositQueue();
            $depositQueue->deposit_id = $this->id;
            $depositQueue->setTypeClosing();
            $depositQueue->setAvailableAt($time->addDays($rate->duration)->addSeconds(30));
            $depositQueue->save();
        };

        return true;
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function accrue($deposit_queue = null) {
        if ($this->condition == 'blocked') {
            throw new \Exception('Accrue failed because deposit blocked');
        }

        // проверяем статус депозита и оплату
        if ($this->condition == 'create' && $this->investTransaction()->approved) {
            $this->update(['condition' => 'onwork']);
        }

        $countTransactions = Transaction::where('deposit_id', $this->id)->where('approved', true)->count() - 1; // минус 1 это открытие

        if ($this->duration < $countTransactions || $this->condition != 'onwork') {
            throw new \Exception("error status deposit!");
        }

        /** @var Wallet $wallet */
        $wallet = $this->wallet()->first();

        /** @var User $user */
        $user = $this->user()->first();


        $reinvest = $this->reinvest ?? 0;
        $amountReinvest = $this->balance * $this->daily * 0.01 * $reinvest * 0.01;
        $amountToWallet = $this->balance * $this->daily * 0.01 - $amountReinvest;

        $dividend = null;

        if ($amountToWallet > 0) {
            $dividend = Transaction::dividend($wallet, $amountToWallet, $this);
        }

        if ($dividend && $amountToWallet > 0) {
            $amount = abs($dividend->amount);
            if ($amount > 0) {
                $notification_data = [
                    'notification_name' => 'Начисления по депозиту',
                    'user' => $user,
                    'deposit' => $this,
                    'amount' => $amount . $wallet->currency->symbol,
                    'days' => 'за ' . $dividend->created_at->format('d.m.Y H:i:s'),
                ];
                Notification::sendNotification($notification_data, 'new_charge');
            }
            if ($amountReinvest > 0) {
                $notification_data = [
                    'notification_name' => 'Реинвестирование по депозиту',
                    'user' => $user,
                    'deposit' => $this,
                    'amount' => $amountReinvest . $wallet->currency->symbol,
                    'days' => 'за ' . $dividend->created_at->format('d.m.Y H:i:s'),
                ];
                Notification::sendNotification($notification_data, 'new_reinvest');
            }

        }
        $wallet->addAmountWithAccrueToPartner($amountToWallet, 'deposit');
        $this->addBalance($amountReinvest);

        if ($dividend) {
            $dividend->update(['approved' => true]);
        }
        // send notification to user
        /*$data = [
            'dividend' => $dividend,
            'deposit' => $this,
        ];*/
        //        $user->sendNotification('deposit_accrued', $data);
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function close($var) {
        if ($this->condition != 'onwork' || !$this->active) {
            throw new \Exception("failed close");
        }

        /** @var Wallet $wallet */
        $wallet = $this->wallet()->first();

        if ($this->overall) {
            $amountOverall = $this->balance * $this->overall * 0.01;
            $transactionOverall = Transaction::dividend($wallet, $amountOverall, $this);

            $accrue = $wallet->addAmountWithoutAccrueToPartner($amountOverall);

            if ($this->overall - 100 > 0) {
                $wallet->accrueToPartner($this->balance * ($this->overall-100) * 0.01, 'deposit');
            }

            if ($transactionOverall->update([
                'approved' => $accrue,
            ])) {
                $this->update(['condition' => 'overall']);
            } else {
                throw new \Exception("failed overall!");
            }
        }

        $amount = $this->balance;
        $closeTransaction = Transaction::closeDeposit($this, $amount);

        $closeTransaction->update(['approved' => true]);
        $this->update(['condition' => 'closed']);
        $this->update(['active' => false]);

        // send notification to user
        $data = [
            'deposit' => $this,
        ];
        //        $user->sendNotification('deposit_closed', $data);
        return true;
    }

    /**
     * @param float $amount
     *
     * @return bool
     */
    public function addBalance($amount = 0.00) {
        return $this->update(['balance' => $this->balance + $amount]);
    }

    /**
     * @return mixed
     */
    public function investTransaction() {
        $typeId = TransactionType::getByName('create_dep')->id;

        return Transaction::where([
            'wallet_id' => $this->wallet_id,
            'type_id' => $typeId,
            'deposit_id' => $this->id,
        ])->orderBy('created_at')->first();
    }

    /**
     * @return bool
     */
    public function block() {
        if ($this->active != true || $this->condition == 'blocked' || $this->condition == 'closed') {
            return false;
        }

        $this->condition = 'blocked';
        $this->active = false;

        $this->save();
        return true;
    }

    /**
     * @return bool
     */
    public function unblock() {
        if ($this->active != false || $this->condition != 'blocked') {
            return false;
        }

        $this->active = true;
        $this->condition = 'onwork';

        $this->save();
        return true;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function closedBalances()
    : array {
        $deposits = Currency::join('deposits', 'currencies.id', '=', 'deposits.currency_id')->where('deposits.condition', 'closed')->select('currencies.code', 'deposits.balance')->get();

        $balances = Currency::balances();

        foreach ($deposits as $item) {
            $balances[$item->code] = key_exists($item->code, $balances) ? $balances[$item->code] + $item->balance : $item->balance;
        }
        return $balances;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function depositQueue() {
        return $this->hasMany(DepositQueue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeCharges() {
        return $this->depositQueue()->where('done', false)->where('type', DepositQueue::TYPE_ACCRUE)->orderBy('available_at');
    }

    /**
     * @return mixed
     */
    public function nextPayment() {
        return $this->activeCharges()->first();
    }

    /**
     * @return float|int
     */
    public function needToCharge() {
        return $this->daily * $this->activeCharges()->count();
    }

    /**
     * @return bool
     */
    public function canUpdate() {
        if (!$this->rate->upgradable){
            return false;
        }

        /** @var Currency $to_currency */
        $to_currency = $this->currency;

        /** @var Currency $from_currency */
        $from_currency = Currency::where('code', 'USD')->first();

        /** @var float $rate_max */
        $rate_max = Wallet::convertToCurrencyStatic($from_currency, $to_currency, $this->rate->max);

        return $rate_max > 0
            && $this->balance >= ($rate_max + 1); // +1 обычно следующий план на доллар дороже
    }
}
