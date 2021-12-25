<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepositBonus extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'deposit_bonus_id',
        'personal_turnover',
        'total_turnover',
        'deposit_bonus_personal_turnover',
        'deposit_bonus_total_turnover',
        'deposit_bonus_leadership_bonus',
        'deposit_bonus_reward',
        'delayed'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function depositBonus()
    {
        return $this->belongsTo(DepositBonus::class);
    }

    /**
     * @param $user
     */
    public static function setUserBonuses($user): void
    {
        $bonus = self::findDepositBonusByLowerUserStat($user);

        $userHasBonus = self::userHasBonus($user, $bonus);

        if (!is_null($bonus) && !$userHasBonus) {
            $user->userDepositBonuses()->create([
                'deposit_bonus_id' => $bonus->id,
                'personal_turnover' => $user->personal_turnover,
                'total_turnover' => $user->referrals_invested_total,
                'deposit_bonus_personal_turnover' => $bonus->personal_turnover,
                'deposit_bonus_total_turnover' => $bonus->total_turnover,
                'deposit_bonus_leadership_bonus' => $bonus->leadership_bonus,
                'deposit_bonus_reward' => $bonus->reward,
                'delayed' => 0
            ]);

            self::addBonusToUserWallet($user, $bonus->reward);
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    private static function findDepositBonusByLowerUserStat($user)
    {
        $bonus = DepositBonus::where('personal_turnover', '<=', $user->personal_turnover)
            ->orWhere('total_turnover', '<=', $user->referrals_invested_total)
            ->orderBy('personal_turnover', 'desc')
            ->first();

        $personalIsLower = $user->personal_turnover < $bonus->personal_turnover;
        $totalIsLower = $user->referrals_invested_total < $bonus->total_turnover;

        if ($personalIsLower && !$totalIsLower) {
            $bonus = DepositBonus::where('personal_turnover', '<=', $user->personal_turnover)
                ->orderBy('personal_turnover', 'desc')
                ->first();
        } else if (!$personalIsLower && $totalIsLower) {
            $bonus = DepositBonus::where('total_turnover', '<=', $user->referrals_invested_total)
                ->orderBy('personal_turnover', 'desc')
                ->first();
        }

        return $bonus;
    }

    /**
     * @param $user
     * @param $bonus
     * @return bool
     */
    public static function userHasBonus($user, $bonus)
    {
        if (!is_null($bonus)) {
            return (bool)UserDepositBonus::where('user_id', $user->id)
                ->where(function ($q) use ($bonus) {
                    $q->orWhere('deposit_bonus_id', $bonus->id)
                        ->orWhere('deposit_bonus_total_turnover', $bonus->total_turnover)
                        ->orWhere('deposit_bonus_personal_turnover', $bonus->total_turnover)
                        ->orWhere('deposit_bonus_reward', $bonus->revard);
                })->count();
        }
        return false;
    }

    /**
     * @param $user
     * @param $amount
     */
    public static function addBonusToUserWallet($user, $amount)
    {
        $wallet = $user->wallets()
            ->where('currency_id', Currency::whereCode('SPRINT')->first()->id ?? null)
            ->first();

        if (!is_null($wallet)) {
            $wallet->refill($amount);
            Transaction::partnerEarnings($wallet, $amount);

            return true;
        }
        return false;
    }
}
