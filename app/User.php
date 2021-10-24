<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App;

/**
 * App\User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $login
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $left_line
 * @property-read int|null $left_line_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $left_line_deposits
 * @property-read int|null $left_line_deposits_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $partners
 * @property-read int|null $partners_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $referrals
 * @property-read int|null $referrals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Deposit[] $referralsDeposits
 * @property-read int|null $referrals_deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $right_line
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserVerification[] $verifiedDocuments
 * @property-read int|null $verified_documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
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
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $partner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $userReferrals
 * @property-read int|null $user_referrals_count
 */
class User extends Models\User
{
    // models are transferred App\Models\
}