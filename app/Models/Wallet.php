<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\ConvertCurrency;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wallet
 *
 * @property string $id
 * @property string $user_id
 * @property string $currency_id
 * @property string|null $external
 * @property string|null $external_payeer
 * @property string|null $external_qiwi
 * @property float $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $main_currency_amount
 * @property-read \App\Models\Currency $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $deposits
 * @property-read int|null $deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereExternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereMainCurrencyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet wherePaymentSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    use ConvertCurrency;
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $fillable */
    protected $fillable = [
        'user_id',
        'currency_id',
        'main_currency_amount',
        'external',
        'external_payeer',
        'external_qiwi',
        'balance',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function paymentSystem()
//    {
//        return $this->belongsTo(PaymentSystem::class, 'payment_system_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'wallet_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'wallet_id');
    }

    /**
     * @param $value
     *
     * @return float
     * @throws \Exception
     */
    public function getBalanceAttribute($value) {
        $precision = $this->currency->precision ?? 2;

        if ($precision > 8) {
            $precision = 8;
        }

        return sprintf('%0.'.$precision.'f', $value);
    }

    /**
     * @return float|null
     * @throws \Exception
     */
    public function requestedAmount()
    {
        /** @var TransactionType $transactionWithdrawType */
        $transactionWithdrawType = TransactionType::getByName('withdraw');
        $sum                     = Transaction::where('wallet_id', $this->id)
            ->where('type_id', $transactionWithdrawType->id)
            ->where('approved', 0)
            ->sum('amount');
        $sum = $sum ? $this->getBalanceAttribute($sum) : null;
        return $sum;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function addBonus($amount)
    {
        $commission = TransactionType::getByName('bonus')->commission;
        $this->update(['balance' => $this->balance + $amount - $amount * $commission * 0.01]);
        Transaction::bonus($this, $amount);
        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function removeAmount($amount)
    {
//        Transaction::penalty($this, $amount);
        $this->update(['balance' => $this->balance - $amount]);
        return $this;
    }

    /**
     * @param float $amount
     * @return bool
     */
    public function addAmountWithoutAccrueToPartner($amount=0.00)
    {
        $this->update(['balance' => $this->balance + $amount]);

        return true;
    }

    /**
     * @param float $amount
     * @param string $partnerAccrueType
     * @return int
     * @throws \Throwable
     */
    public function addAmountWithAccrueToPartner($amount=0.00, $partnerAccrueType='deposit')
    {
        $this->update(['balance' => $this->balance + $amount]);
        return $this->accrueToPartner($amount, $partnerAccrueType);
    }

    /**
     * @param $user
     * @param $currency
     * @return mixed
     */
    public static function newWallet($user, $currency)
    {
        return self::create([
            'user_id' => $user->id,
            'currency_id' => $currency->id,
        ]);

    }

    /**
     * @param $amount
     * @param $external
     * @throws \Throwable
     */
    public function refill($amount)
    {
        $this->balance += $amount;
        $this->save();

//        $data = [
//            'refill_amount'  => $amount,
//            'external'       => $external,
//            'payment_system' => $this->paymentSystem()->first(),
//            'balance'        => $this->balance
//        ];
//        /** @var User $user */
//        $user = $this->user()->first();
//        $user->sendNotification('wallet_refiled', $data);
    }

    /**
     * @param Transaction $transaction
     */
    public function returnFromRejectedWithdrawal(Transaction $transaction)
    {
        $this->update(['balance' => $this->balance + $transaction->amount]);
    }

    /**
     * @param $amount
     * @param $type
     * @return int
     * @throws \Throwable
     */
    public function accrueToPartner($amount, $type)
    {
        $level = 0;

        $user = $this->user;

        while($level <= 10) {
            $level += 1;

            if ($type == 'refill') {
                $percent = Referral::getOnLoad($level);
            } elseif ($type == 'deposit') {
                $percent = Referral::getOnProfit($level);
            } else {
                $percent = 0;
            }

            \Log::info('Level percent '.$percent );

            if ($percent <= 0) {
                break;
            }

            $partnerAmount  = $amount * $percent / 100;
            /** @var User $partner */
            $partner = User::where('my_id', $user->partner_id)->first();

            if (empty($partner)) {
                break;
            }

            $user = $partner;

            if ($partner->partner_level_1 > 0 && $level == 1) {
                $partnerAmount = $amount * $partner->partner_level_1 / 100;
            }

            if ($partner->partner_level_2 > 0 && $level == 2) {
                $partnerAmount = $amount * $partner->partner_level_2 / 100;
            }

            if ($partner->partner_level_3 > 0 && $level == 3) {
                $partnerAmount = $amount * $partner->partner_level_3 / 100;
            }

            if ($partner->partner_level_4 > 0 && $level == 4) {
                $partnerAmount = $amount * $partner->partner_level_4 / 100;
            }

            if ($partner->partner_level_5 > 0 && $level == 5) {
                $partnerAmount = $amount * $partner->partner_level_5 / 100;
            }

            \Log::info('Found partner '.$partner->login );

            $partnerWallets = $partner->wallets()->get();

            if ($partnerWallets->count() == 0) {
                /** @var Wallet $newPartnerWallet */
                $newPartnerWallet = self::newWallet($partner, $this->currency);
                $newPartnerWallet->referralRefill($partnerAmount, $this, $type);
            }

            $summaryAmount = 0;

            /** @var Wallet $partnerWallet */
            foreach ($partnerWallets as $partnerWallet) {
                if ($partnerWallet->currency == $this->currency) {
                    $partnerWallet->referralRefill($partnerAmount, $this, $type);
                    \Log::info('Referral refill: '.$partnerAmount.', '.$type);
                    $summaryAmount += $partnerAmount;


//                    $notificationActive = $partner->socialMeta()
//                        ->where('s_key', 'settings_notifications_referral '.$level.'_level')
//                        ->where('s_value', 1)
//                        ->count();
//
//                    if ($notificationActive > 0) {
////                        $partner->sendNotification('affiliate_earnings', [
////                            'amount'            => $partnerAmount,
////                            'receiveWallet'     => $partnerWallet,
////                            'sender'            => $user,
////                            'receive'           => $partner,
////                            'level'             => $level,
////                        ]);
//                    }

                    break;
                }
            }
        }
        return isset($summaryAmount) ? $summaryAmount : 0;
    }

    /**
     * @param $amount
     * @param $referral
     * @param $type
     */
    public function referralRefill($amount, $referral, $type)
    {
        $this->update(['balance' => $this->balance + $amount]);

        if ($type == 'refill') {
            Transaction::partner($this, $amount, $referral);
        } elseif ($type == 'deposit') {
            Transaction::partner($this, $amount, $referral);
        } elseif ($type == 'task') {
            Transaction::partner($this, $amount, $referral);
        }

        $data = [
            'refill_amount' => $amount,
            'balance'       => $this->balance,
            'currency'      => $this->currency,
            'type'          => $type
        ];
//        $this->user->sendNotification('partner_accrue', $data);
    }

    /**
     * @param User $user
     */
    public static function registerWallets(User $user)
    {
        $currencies = Currency::all();

        foreach ($currencies as $currency) {
                $checkExists = Wallet::where('user_id', $user->id)
                    ->where('currency_id', $currency->id)
                    ->get()
                    ->count();

                if ($checkExists > 0) {
                    continue;
                }

                self::newWallet($user, $currency);
        }
        /*foreach ($paymentSystems as $paymentSystem) {
            foreach ($paymentSystem->currencies as $currency) {
                $checkExists = Wallet::where('user_id', $user->id)
                    ->where('payment_system_id', $paymentSystem->id)
                    ->where('currency_id', $currency->id)
                    ->get()
                    ->count();

                if ($checkExists > 0) {
                    continue;
                }

                self::newWallet($user, $currency, $paymentSystem);
            }
        }*/
    }

    /**
     * @param Wallet $wallet_from
     * @param Wallet $wallet_to
     * @param float $amount
     * @param float|int $commission
     * @return bool
     * @throws \Exception
     */
    public function exchangeCurrency(Wallet $wallet_from, Wallet $wallet_to, float $amount, float $commission = 0)
    {
        $converted = $this->convertToCurrency($this->currency, $wallet_to->currency, (abs($amount) - (abs($amount) / 100 * $commission)));
        $transaction_in = Transaction::exchangeInCurrency($wallet_to, $converted);

        if ((float) $converted <= 0) {
            throw new \Exception('no rate for change '.$this->currency->code.' -> '.$wallet_to->currency->code);
        }

        $transaction_out = Transaction::exchangeOutCurrency($wallet_from, $amount);
        $wallet_from->removeAmount($amount);

        $wallet_to->update(['balance' => $wallet_to->balance + $converted]);

        $currency_exchange = new CurrencyExchange();
        $currency_exchange->user_id = $wallet_from->user_id;
        $currency_exchange->transaction_in = $transaction_in->id;
        $currency_exchange->transaction_out = $transaction_out->id;
        $currency_exchange->currency_in = $wallet_to->currency->id;
        $currency_exchange->currency_out = $this->currency->id;
        $currency_exchange->amount_in = $transaction_in->amount;
        $currency_exchange->amount_out = $transaction_out->amount;
        $currency_exchange->main_currency_amount_in = $transaction_in->main_currency_amount;
        $currency_exchange->main_currency_amount_out = $transaction_out->main_currency_amount;
        $currency_exchange->commission = abs($amount) / 100 * $commission;
        $currency_exchange->save();

        return true;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function totalEnter() {
        $wl = $this;
        return cache()->remember('personal_sum_transactions_enter.'.$this->id, now()->addMinutes(60), function() use($wl) {
            return round($wl->transactions()
                ->where('approved', 1)
                ->where('type_id', TransactionType::getByName('enter')->id)
                ->sum('amount'), $wl->currency->precision);
        });
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function totalWithdraw() {
        $wl = $this;
        return cache()->remember('personal_sum_transactions_withdraw.'.$this->id, now()->addMinutes(60), function() use($wl) {
            return round($wl->transactions()
                ->where('approved', 1)
                ->where('type_id', TransactionType::getByName('withdraw')->id)
                ->sum('amount'), $wl->currency->precision);
        });
    }
}
