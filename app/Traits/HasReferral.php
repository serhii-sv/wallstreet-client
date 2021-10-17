<?php


namespace App\Traits;


use App\Models\Deposit;
use App\Models\Referral;
use App\Models\User;

trait HasReferral
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function left_line()
    {
        return $this->referrals()->wherePivot('main_parent_id', '!=', $this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function left_line_deposits()
    {
        return $this->referralsDeposits()->wherePivot('main_parent_id', '!=', $this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function right_line()
    {
        return $this->referrals()->wherePivot('main_parent_id', $this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function right_line_deposits()
    {
        return $this->referralsDeposits()->wherePivot('main_parent_id', $this->id);
    }

    /**
     * @return bool
     */
    public function hasReferrals()
    {
        return $this->referrals()->count() > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function referrals()
    {
        return $this->belongsToMany(User::class, 'user_parents', 'parent_id', 'user_id')
            ->withPivot([
                'line',
                'main_parent_id'
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function referralsDeposits()
    {
        return $this->belongsToMany(Deposit::class, 'user_parents', 'parent_id', 'user_id', null, 'user_id')
            ->withPivot([
                'line',
                'main_parent_id'
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function partners()
    {
        return $this->belongsToMany(User::class, 'user_parents', 'user_id', 'parent_id')
            ->withPivot([
                'line',
                'main_parent_id'
            ]);
    }

    /**
     * @return array
     */
    public function getLevels()
    {
        $levels = [];
        $referrals = $this->referrals()
            ->get()
            ->groupBy('pivot.line', true);

        foreach ($referrals as $level => $allReferral) {
            $levels[$level] = $allReferral->count();
        }

        return $levels;
    }

    /**
     * @param int $level
     * @return mixed
     * @throws \Exception
     */
    public function getLevels24h()
    {
        $levels = [];

        $referrals = $this->referrals()
            ->where('created_at', '>=', now()->subHours(24)->toDateTimeString())
            ->get()
            ->groupBy('pivot.line', true);

        foreach ($referrals as $level => $allReferral) {
            $levels[$level] = $allReferral->count();
        }

        return $levels;
    }

    /**
     * @return array
     */
    public function getAllReferralsArray()
    {
        /** @var User $referrals */
        $referrals = $this->referrals()
            ->get()
            ->groupBy('pivot.line', true);

        return $referrals->toArray();
    }

    /**
     * @param $level
     * @return int
     */
    public function getReferralOnLoadPercent($level)
    {
        return Referral::getOnLoad($level);
    }

    /**
     * @param $level
     * @return int
     */
    public function getReferralOnProfitPercent($level)
    {
        return Referral::getOnProfit($level);
    }

    /**
     * @return array
     */
    public function getPartnerLevels()
    {
        $levels = $this->partners()
            ->get()
            ->pluck('pivot.line')
            ->toArray();

        return !empty($levels)
            ? $levels
            : [];
    }

    /**
     * @param int $level
     * @return User
     */
    public function getPartnerOnLevel(int $level)
    {
        /** @var User $partner */
        return $this->partners()
            ->wherePivot('line', $level)
            ->first();
    }

    /**
     * @param bool $json
     * @param int $flag
     * @return array
     */
    public function getAllReferrals(bool $json = false, $flag = 1)
    {
        /** @var User $referrals */
        $referrals = $this->referrals()->get();

        $result = [
            'self' => $this,
            'referrals' => []
        ];

        if ($flag > 100) {
            return $result;
        }

        if (!empty($referrals)) {
            foreach ($referrals as $ref) {
                $result['referrals'][] = $ref->getAllReferrals($json, $flag + 1);
            }
        }

        return $result;
    }

    /**
     * @param $referrals
     * @return bool
     */
    public function referralsRedistribution($referrals)
    {
        $ids = [];
        $this->referrals()->detach();
        foreach ($referrals as $referral) {
            $ids[] = $referral->id;
            $user = User::find($referral->id);
            $user->referralsRedistribution($referral->children ?? []);
        }
        $this->referrals()->sync($ids);
        return true;
    }

    /**
     * @param User $parent
     */
    public function generatePartnerTree(User $parent)
    {
        $parent_array = [];

        $partners = $parent->partners()->orderBy('pivot_line','asc')->get();
        $parent_array[$parent->id] = ['line'=>1];

        $i = 1;

        foreach ($partners as $partner) {
            $i++;
            $parent_array[$partner->id] = ['line'=>$i];
        }

        $this->partners()->sync($parent_array);
    }
    
    
    public function getAllReferralsIds($referrals, $flag = 1)
    {
        $result = [];
        
        foreach ($referrals as $referral) {
            if (!isset($referral->id)) {
                $referral = $referral['self'];
            }
            $result[] = $referral->id;
            $this->getAllReferralsIds($referral['referrals'], $flag + 1);
        }
        
        return $result;
    }
    
    public function partner()
    {
        return $this->partners()->first();
    }
}
