<?php


namespace App\Traits;


use App\Models\Chat;
use App\Models\Deposit;
use App\Models\Permission;
use App\Models\Referral;
use App\Models\ReferralLinkStat;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    public function getAllReferrals(bool $json = false, $flag = 1, $max=10)
    {
        $th = $this;

        $result = [
            'self' => $th,
            'referrals' => []
        ];

        if ($flag > $max) {
            return $result;
        }

        return cache()->remember('all_referrals.'.$th->id.$flag.$max, now()->addMinutes(60), function() use($th, $result, $flag, $json, $max) {
            /** @var User $referrals */
            $referrals = $th->referrals()
                ->wherePivot('line', 1)
                ->get();

            if (!empty($referrals)) {
                foreach ($referrals as $ref) {
                    $result['referrals'][] = $ref->getAllReferrals($json, $flag + 1, $max);
                }
            }

            return $result;
        });
    }

    /**
     * @return array
     */
    public function getAllReferralsInArray($level=1, $max=9, $checkArr=[])
    {
        $th = $this;

        if ($level > $max) {
            return [];
        }

//        return cache()->remember('referrals_array.'.$th->id.$level.$max, now()->addHours(6), function() use($th, $level, $max) {
        /** @var User $referrals */
        $referrals = $th->referrals()->select(['id'])->wherePivot('line', 1)->get();

        $result = [];

        if (!empty($referrals)) {
            /** @var User $ref */
            foreach ($referrals as $ref) {
                $result[$ref->id] = $ref;

                if (!isset($checkArr[$ref->id])) {
                    $result = array_merge($ref->getAllReferralsInArray($level + 1, $max, $checkArr), $result);
                } else {
                    continue;
                }

                $checkArr[$ref->id] = true;
            }
        }

        return $result;
//        });
    }

    /**
     * @param $referrals
     * @param int $flag
     * @return bool|false[]
     */
    public function referralsRedistribution($referrals, $flag = 1)
    {
        if (empty($referrals)) {
            return;
        }

        if ($flag > 1000) {
            return [
                'success' => false,
                'message' => 'Возника ошибка'
            ];
        }

        $ids = [];
        $this->referrals()->detach();

        foreach ($referrals as $referral) {
            if (isset($referral['id'])) {
                $ids[$referral['id']] = ['line' => 1];
            }

//            $user = User::find($referral['id']);
//            $user->referralsRedistribution($referral['children'] ?? [], $flag++);
        }

        $this->referrals()->sync($ids);

        foreach ($ids as $id => $fields) {
            /** @var User $findRef */
            $findRef = User::find($id);

            if ($findRef->my_id == $this->partner_id) {
                continue;
            }

            $findRef->partner_id = $this->my_id;
            $findRef->save();
            $findRef->refresh();

//            $findRef->generatePartnerTree();
        }

        return [
            'success' => true,
            'message' => 'Сохранено'
        ];
    }

    /**
     * @param User $parent
     */
    public function generatePartnerTree()
    {
        $parent = $this->partner;

        if (null === $parent) {
            return;
        }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
        return $this->belongsTo(User::class, 'partner_id', 'my_id');
    }

    public function hasPartner() {
        return $this->belongsTo(User::class, 'partner_id', 'my_id')->count() ? true : false;
    }

    public function firstPartner($user) {
        $partner = $user->partner()->first();

        if ($user->hasPartner() && $partner->login != 'sprintbank') {
            return $user->firstPartner($partner);
        } else {
            return $user;
        }
    }

    public function getChildrens($limit = 7) {
        $th = $this;

        return cache()->remember('referrals_childrens.'.$th->id, now()->addMinutes(60), function() use($th, $limit) {
            if ($limit === 0) {
                return [];
            }

            $referrals = [];
            $referrals['name'] = $th->login;

            if (!$th->hasReferrals()) {
                return $referrals;
            }

            foreach ($th->referrals()->wherePivot('line', 1)->get() as $r) {
                $referral = $r->getChildrens($limit - 1);
                $referrals['children'][] = $referral;
            }

            return $referrals;
        });
    }

    public function getReferralChatId() {
        $user_partner = auth()->user()->id;
        $user_referral = $this->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        if ($chat->id === 0) {
            $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->first();
        }
        return $chat->id;
    }

    public function getReferralChat() {
        $user_partner = auth()->user()->id;
        $user_referral = $this->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        if ($chat->id === 0) {
            $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->first();
        }
        return $chat;
    }

    public function getPartnerChatId() {
        $user_partner = $this->id;
        $user_referral = auth()->user()->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        if ($chat->id === 0) {
            $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->first();
        }
        return $chat->id;
    }

    public function getPartnerChat() {
        $user_partner = $this->id;
        $user_referral = auth()->user()->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        if ($chat->id === 0) {
            $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->first();
        }
        return $chat;
    }

    public function referral_accruals(User $user) {
        $th = $this;
        return cache()->remember('user.referral_accruals' . $this->id, now()->addMinutes(180), function () use ($user, $th) {
            $partnerTypeId = TransactionType::getByName('partner')->id;

            $wallets = $th->wallets()
                ->get()
                ->pluck('id');

            return $user->transactions()
                ->where('type_id', $partnerTypeId)
                ->whereIn('source', $wallets)
                ->sum('main_currency_amount');
        });
    }

    public function userReferrals() {
        return $this->hasMany(User::class, 'partner_id', 'my_id');
    }

    public function getReferralLinkClickCount() {
        return $this->hasMany(ReferralLinkStat::class, 'partner_id','id')->sum('click_count');
    }

    /**
     * @param $referrals
     * @param int $flag
     * @return array
     */
    public function getAllReferralsIds($referrals, $flag = 1)
    {
        $result = [];
        foreach ($referrals as $referral) {
            if (!isset($referral->id)) {
                $referral = $referral['self'];
                $result[] = $referral->id;
                $this->getAllReferralsIds($referral['referrals'], $flag + 1);
            }
        }

        return $result;
    }
}
