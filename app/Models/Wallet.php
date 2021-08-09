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
        'payment_system_id',
        'main_currency_amount',
        'external',
        'balance',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentSystem()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system_id');
    }

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
     * @return float
     * @throws \Exception
     */
    public function getBalanceAttribute($value)
    {
        return $value;
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
     * @param $paymentSystem
     * @return mixed
     */
    public static function newWallet($user, $currency, $paymentSystem)
    {
        return self::create([
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'payment_system_id' => $paymentSystem->id,
        ]);

    }

    /**
     * @param $amount
     * @param $external
     * @throws \Throwable
     */
    public function refill($amount, $external)
    {
        $this->balance += $amount;

        if (!empty($external)) {
            $this->external = $external;
        }

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
        /** @var User $user */
        $user           = $this->user;
        $partnerLevels  = $user->getPartnerLevels();

        if (!$partnerLevels) {
            return 0;
        }

        \Log::error('Found levels: '.print_r($partnerLevels,true));

        foreach ($partnerLevels as $level) {
            if ($type == 'refill') {
                $percent = Referral::getOnLoad($level);
            } elseif ($type == 'deposit') {
                $percent = Referral::getOnProfit($level);
            } elseif ($type == 'task') {
                $percent = Referral::getOnTask($level);
            } else {
                $percent = 0;
            }

            \Log::info('Level percent '.$percent );

            if ($percent <= 0) {
                continue;
            }

            $partnerAmount  = $amount * $percent / 100;
            /** @var User $partner */
            $partner        = $user->getPartnerOnLevel($level);

            if (empty($partner)) {
                continue;
            }

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
                $newPartnerWallet = self::newWallet($partner, $this->currency, $this->paymentSystem);
                $newPartnerWallet->referralRefill($partnerAmount, $this, $type);
            }

            $summaryAmount = 0;

            /** @var Wallet $partnerWallet */
            foreach ($partnerWallets as $partnerWallet) {
                if ($partnerWallet->currency == $this->currency && $partnerWallet->paymentSystem == $this->paymentSystem) {
                    $partnerWallet->referralRefill($partnerAmount, $this, $type);
                    \Log::info('Referral refill: '.$partnerAmount.', '.$type);
                    $summaryAmount += $partnerAmount;


                    $notificationActive = $partner->socialMeta()
                        ->where('s_key', 'settings_notifications_referral '.$level.'_level')
                        ->where('s_value', 1)
                        ->count();

                    if ($notificationActive > 0) {
//                        $partner->sendNotification('affiliate_earnings', [
//                            'amount'            => $partnerAmount,
//                            'receiveWallet'     => $partnerWallet,
//                            'sender'            => $user,
//                            'receive'           => $partner,
//                            'level'             => $level,
//                        ]);
                    }

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
        $paymentSystems = PaymentSystem::with([
            'currencies'
        ])->get();

        foreach ($paymentSystems as $paymentSystem) {
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
        }
    }


}
