<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\HasReferral;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasPermissions;
    use Uuids;
    use Impersonate;
    use HasReferral;
    
    /**
     * @var string
     */
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;
    
    // Append additional fields to the model
    /**
     * @var string[]
     */
    protected $appends = [
        'short_name',
        'last_activity',
        'my_id',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'my_id',
        'partner_id',
        'phone',
        'skype',
        'created_at',
        'sex',
        'city',
        'country',
        'email_verified_at',
        'email_verification_sent',
        'email_verification_hash',
        'unhashed_password',
        'ip',
        'is_locked',
        'documents_verified',
        'api_token',
        'country_manual',
        'city_manual',
        'telegram',
        'index',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany(Transaction::class, 'user_id');
    }
    
    public function wallets() {
        return $this->hasMany(Wallet::class, 'user_id');
    }
    
    public function deposits() {
        return $this->hasMany(Deposit::class, 'user_id');
    }
    
    public function invested() {
        return $this->hasMany(Deposit::class, 'user_id')->sum('invested');
    }
    
    public function deposit_reward() {
        $invested = $this->invested();
        $deposit_bonus = DepositBonus::where('personal_turnover', '<', $invested)->orderByDesc('personal_turnover')->first();
        if ($deposit_bonus !== null)
            return $deposit_bonus->reward;
        return 0;
    }
    
    public function deposits_accruals() {
        $invested = $this->deposits()->sum('invested');
        $balance = $this->deposits()->sum('balance');
        if ($balance > $invested)
            return $balance - $invested;
    }
    
    public function getBalancesByCurrency($useSymbols = false, $currencyId = null)
    : array {
        $wallets = $this->wallets()->with([
            'currency',
        ]);
        
        if (null !== $currencyId) {
            $wallets = $wallets->where('currency_id', $currencyId);
        }
        
        $wallets = $wallets->get();
        $balances = [];
        
        foreach ($wallets as $wallet) {
            $arrayKey = true === $useSymbols ? $wallet->currency->symbol : $wallet->currency->code;
            
            if (!isset($balances[$arrayKey])) {
                $balances[$arrayKey] = 0;
            }
            
            $balances[$arrayKey] += round($wallet->balance, $wallet->currency->precision);
        }
        
        return $balances;
    }
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
        return $this->belongsTo(User::class, 'partner_id', 'my_id');
    }
    
    /**
     * @return bool
     */
    public function hasReferrals() {
        return self::where('partner_id', $this->my_id)->count() > 0;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*  public function referrals() {
          return $this->hasMany(User::class, 'partner_id', 'my_id');
      }*/
    
    /**
     * Accessor for short name
     * On the right sidebar menu with all users sometimes names are too long
     *
     * @return false|mixed|string
     */
    public function getShortNameAttribute() {
        if (strlen($this->name) <= 18)
            return $this->name;
        
        if (explode(' ', $this->name)[0] <= 15)
            return explode(' ', $this->name)[0] . " " . substr(explode(' ', $this->name)[1], 0, 1) . ".";
        
        if (explode(' ', $this->name)[0] <= 18)
            return explode(' ', $this->name)[0];
        
        return substr($this->name, 0, 15) . "...";
    }
    
    /**
     * Accessor for last activity field
     * Used at the moment for indicate if user is online for at least 2 minutes ago
     *
     * @return array
     */
    public function getLastActivityAttribute() {
        if ($this->last_activity_at === null)
            return [
                'is_online' => false,
                'last_seen' => 'Wait auth',
            ];
        
        $currentDate = Carbon::make($this->last_activity_at);
        
        if ($currentDate->greaterThanOrEqualTo(Carbon::now()->startOfDay()))
            return [
                'is_online' => Carbon::now()->subSeconds(config('chats.max_idle_sec_to_be_online'))->lessThan($currentDate),
                'last_seen' => $currentDate->format("g.i A"),
            ];
        
        return [
            'is_online' => false,
            'last_seen' => $currentDate->format("j \of M"),
        ];
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loginSecurity() {
        return $this->hasOne('App\Models\LoginSecurity');
    }
    
    /**
     * Mutator for last activity field
     *
     * @param \DateTime|null $time
     *
     * @return User
     */
    public function setLastActivity(\DateTime $time = null) {
        $this->last_activity_at = $time;
        
        if ($time === null)
            $this->last_activity_at = new \DateTime();
        
        $this->save();
        
        return $this;
    }
    
    public function roles()
    : BelongsToMany {
        return $this->morphToMany(config('permission.models.role'), 'model', config('permission.table_names.model_has_roles'), config('permission.column_names.model_morph_key'), 'role_id')->withTimestamps();
    }
    
    public function generateMyId()
    : User {
        $maxExists = \App\Models\User::max('my_id');
        $maxExists = $maxExists > 0 ? $maxExists + 1 : rand(500000, 2000000);
        
        $this->my_id = $maxExists;
        
        return $this;
    }
    
    public function permissions()
    : BelongsToMany {
        return $this->morphToMany(config('permission.models.permission'), 'model', config('permission.table_names.model_has_permissions'), config('permission.column_names.model_morph_key'), 'permission_id')->withTimestamps();
    }
    
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }
    
    
    public function getReferralChatId() {
        $user_partner = auth()->user()->id;
        $user_referral = $this->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        return $chat->id;
    }
    
    public function getReferralChat() {
        $user_partner = auth()->user()->id;
        $user_referral = $this->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        return $chat;
    }
    
    public function getPartnerChatId() {
        $user_partner = $this->id;
        $user_referral = auth()->user()->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        return $chat->id;
    }
    
    public function getPartnerChat() {
        $user_partner = $this->id;
        $user_referral = auth()->user()->id;
        $chat = Chat::where('user_partner', $user_partner)->where('user_referral', $user_referral)->firstOrCreate([
            'user_partner' => $user_partner,
            'user_referral' => $user_referral,
        ]);
        return $chat;
    }
    
    public function getAllChats() {
        return Chat::where('user_partner', $this->id)->orWhere('user_referral', $this->id)->get();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifiedDocuments() {
        return $this->hasMany(UserVerification::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function lastVerificationRequest() {
        return $this->verifiedDocuments()->orderBy('created_at', 'desc')->first();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function themeSettings() {
        return $this->hasOne(UserThemeSetting::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supportTasks() {
        return $this->hasMany(SupportTask::class);
    }
    
    /**
     * @return false|string
     */
    public static function impersonateTokenDecode($token) {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = 'htxmjY4QdGveQ8ta';
        $decryption_key = "peNsmB8md1cOigPUSdAY1ui6q3vHiWo3ANQeBhQHUysOrZCdLsZav1YxWS2I";
        
        $decrypted_token = openssl_decrypt($token, $ciphering, $decryption_key, $options, $decryption_iv);
        
        $user_data = explode(' ', $decrypted_token);
        return User::where('id', $user_data[0] ?? null)->where('login', $user_data[1] ?? 0)->first();
    }
}
