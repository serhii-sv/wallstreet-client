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
use Lab404\Impersonate\Models\Impersonate;
use Psy\Util\Str;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $login
 * @property string|null $role_color
 * @property string|null $partner_id
 * @property string|null $phone
 * @property string|null $skype
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $tfa_token
 * @property string|null $blockio_wallet_btc
 * @property string|null $blockio_wallet_ltc
 * @property string|null $blockio_wallet_doge
 * @property string|null $sex
 * @property string|null $country
 * @property string|null $city
 * @property string|null $longitude
 * @property string|null $latitude
 * @property string|null $email_verified_at
 * @property string|null $email_verification_sent
 * @property string|null $email_verification_hash
 * @property float $partner_level_1
 * @property float $partner_level_2
 * @property float $partner_level_3
 * @property float $partner_level_4
 * @property float $partner_level_5
 * @property string|null $unhashed_password
 * @property string $stat_deposits
 * @property string $stat_withdraws
 * @property string $stat_different
 * @property string $stat_salary
 * @property string|null $stat_accepted
 * @property string $stat_left
 * @property string|null $stat_additional
 * @property float $stat_salary_percent
 * @property float $stat_worker_withdraw
 * @property string|null $ip
 * @property string|null $my_id
 * @property string|null $last_activity_at
 * @property int $int_id
 * @property string|null $avatar
 * @property bool $documents_verified
 * @property string|null $api_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActivityLog[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $deposits
 * @property-read int|null $deposits_count
 * @property-read array $last_activity
 * @property-read false|mixed|string $short_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\KanbanBoard[] $kanbanBoards
 * @property-read int|null $kanban_boards_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $left_line
 * @property-read int|null $left_line_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $left_line_deposits
 * @property-read int|null $left_line_deposits_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read User|null $partner
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $partners
 * @property-read int|null $partners_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $referrals
 * @property-read int|null $referrals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $referralsDeposits
 * @property-read int|null $referrals_deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $right_line
 * @property-read int|null $right_line_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $right_line_deposits
 * @property-read int|null $right_line_deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupportTask[] $supportTasks
 * @property-read int|null $support_tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\UserThemeSetting|null $themeSettings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $userReferrals
 * @property-read int|null $user_referrals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserVerification[] $verifiedDocuments
 * @property-read int|null $verified_documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlockioWalletBtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlockioWalletDoge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlockioWalletLtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDocumentsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerificationHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerificationSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIntId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastActivityAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerLevel4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePartnerLevel5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatDifferent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatSalaryPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatWithdraws($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatWorkerWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTfaToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUnhashedPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
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
        'last_activity_at',
        'api_token',
        'country_manual',
        'city_manual',
        'telegram',
        'index',
        'phone_verified',
        'auth_with_phone',
        'role_color',
        'referrals_invested_total',
        'personal_turnover',
        'total_referrals_count'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets() {
        return $this->hasMany(Wallet::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits() {
        return $this->hasMany(Deposit::class, 'user_id');
    }

    public function invested() {
        $th = $this;
        return cache()->remember('user.total_invested_' . $this->id, now()->addMinutes(60), function () use ($th) {
            $invested = 0;
            $usdCurrency = Currency::where('code', 'USD')->first();
            $th->deposits()
                ->where('active', 1)
                ->get()
                ->each(function (Deposit $deposit) use (&$invested, $usdCurrency) {
                    $invested += (new Wallet())->convertToCurrency($deposit->currency, $usdCurrency, $deposit->balance);
                });
            return $invested;
        });
    }

    public function deposits_accruals() {
        $th = $this;

        $dividends = cache()->remember('user.deposit_accruals' . $this->id, now()->addMinutes(60), function () use ($th) {
            $dividendTypeId = TransactionType::getByName('dividend')->id;
            $dividends = $th->transactions()
                ->where('type_id', $dividendTypeId)
                ->sum('main_currency_amount');

            return $dividends;
        });

        $reinvestDividends = cache()->remember('user.deposit_reinvests' . $this->id, now()->addMinutes(60), function () use ($th) {
            $closeDepTypeId = TransactionType::getByName('close_dep')->id;
            $createDepTypeId = TransactionType::getByName('create_dep')->id;
            $dividends = 0;
            $usdCurrency = Currency::where('code', 'USD')->first();

            $th->transactions()
                ->where('type_id', $closeDepTypeId)
                ->each(function(Transaction $transaction) use($th, $createDepTypeId, &$dividends, $usdCurrency) {
                    $investedTransaction = $th->transactions()
                        ->where('type_id', $createDepTypeId)
                        ->where('deposit_id', $transaction->deposit_id)
                        ->first();

                    if (null !== $investedTransaction) {
                        $diff = $transaction->amount - $investedTransaction->amount;
                        $dividends += (new Wallet())->convertToCurrency($transaction->currency, $usdCurrency, $diff);
                    }
                });

            return $dividends;
        });

        return $dividends+$reinvestDividends;
    }

    /**
     * @param boolean $useSymbols
     * @param string  $currencyId
     *
     * @return array
     */
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
     * Accessor for short name
     * On the right sidebar menu with all users sometimes names are too long
     *
     * @return false|mixed|string
     */
    public function getShortNameAttribute() {
        if (strlen($this->name) <= 18)
            return $this->name;

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

    /**
     * @return BelongsToMany
     */
    public function roles()
    : BelongsToMany {
        return $this->morphToMany(config('permission.models.role'), 'model', config('permission.table_names.model_has_roles'), config('permission.column_names.model_morph_key'), 'role_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions()
    : BelongsToMany {
        return $this->morphToMany(config('permission.models.permission'), 'model', config('permission.table_names.model_has_permissions'), config('permission.column_names.model_morph_key'), 'permission_id')->withTimestamps();
    }

    /**
     * @return User
     */
    public function generateMyId()
    : User {
        $maxExists = \App\Models\User::max('my_id');
        $maxExists = $maxExists > 0 ? $maxExists + 1 : rand(500000, 2000000);

        $this->my_id = $maxExists;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kanbanBoards() {
        return $this->hasMany(KanbanBoard::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities() {
        return $this->hasMany(ActivityLog::class);
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
    public function verifiedDocuments() {
        return $this->hasMany(UserVerification::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() {
        return $this->hasMany(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supportTasks() {
        return $this->hasMany(SupportTask::class);
    }

    public function getChatId() {
        if ($this->id == auth()->user()->id) {
            return '';
        }
        $user_1 = $this->id;
        $user_2 = auth()->user()->id;
        $chat = AdminChat::where(function ($query) use ($user_1, $user_2) {
            $query->where('user_1', $user_1)->Where('user_2', $user_2);
        })
            ->orWhere(function ($query) use ($user_1, $user_2) {
                $query->where('user_1', $user_2)->Where('user_2', $user_1);
        })
            ->first();
        if (empty($chat)){
            $chat = new AdminChat();
            $chat->user_1 = $user_1;
            $chat->user_2 = $user_2;
            $chat->save();
        }
        return $chat->id;
    }

    public function getUnreadCommonChatMessagesCount() {
        return AdminCommonChatUsers::where('user_id', $this->id)->where('is_read', false)->count();
    }
    public function getUnreadChatMessagesCount($chat_id) {
        return AdminChatMessage::where('chat_id', $chat_id)->where('user_id', $this->id)->where('is_read', false)->count();
    }

    /**
     * @return false|string
     */
    public static function impersonateTokenGenerate()
    {
        $user = auth()->user();
        $simple_string = $user->int_id;
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = 'htxmjY4QdGveQ8ta';
        $encryption_key = "peNsmB8md1cOigPUSdAY1ui6q3vHiWo3ANQeBhQHUysOrZCdLsZav1YxWS2I";

        return openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
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
        return User::where('int_id', $user_data[0] ?? null)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function lastVerificationRequest() {
        return $this->verifiedDocuments()->orderBy('created_at', 'desc')->first();
    }

    public function getAllChats() {
        return Chat::where('user_partner', $this->id)->orWhere('user_referral', $this->id)->get();
    }

    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class, 'user_id');
    }

    /**
     * @return string|null
     */
    public function getRoleColor()
    {
        if ($this->role_color) {
            return $this->role_color;
        }
        $role = $this->roles()->first();

        if ($role !== null) {
            return $role->color;
        }
        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userDepositBonuses()
    {
        return $this->hasMany(UserDepositBonus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function userCurrentRank()
    {
        return $this->userDepositBonuses()->orderBy('created_at', 'desc')->first();
    }

    /**
     * @return BelongsToMany
     */
    public function userProducts()
    {
        return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id');
    }

    /**
     * @param array|null $roles
     */
    public function givePermissionsFromRole(array $roles=[])
    {
        foreach ($roles as $role) {
            // ----------
            if ($role == 'Фаундер' || $role == 'Тимлидер') {
                $permissions = Permission::all();
                if (!empty($permissions)){
                    foreach ($permissions as $permission) {
                        $this->givePermissionTo($permission->name);
                    }
                }
            }
            // ----------
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastReferralsRole()
    {
        return $this->hasOne(ReferralRole::class)
            ->where('processed', true)
            ->orderBy('created_at', 'desc');
    }
}
