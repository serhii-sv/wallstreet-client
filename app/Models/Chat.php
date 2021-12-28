<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Chat
 *
 * @property string $id
 * @property string|null $socket_id
 * @property \App\Models\User $user_partner
 * @property \App\Models\User $user_referral
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereSocketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserPartner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserReferral($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'socket_id',
        'user_partner',
        'user_referral'
    ];

    /**
     * @var string[]
     */
    protected $guarded = ['_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userPartner()
    {
        return $this->belongsTo(User::class, 'user_partner', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userReferral()
    {
        return $this->belongsTo(User::class, 'user_referral', 'id');
    }


    /**
     * @param $user
     * @return bool
     */
    public function checkUser($user)
    {
        if ($this->user_partner == $user || $this->user_referral == $user) {
            return true;
        }
        return false;
    }

    /**
     * @param $partner
     * @param $referral
     * @return bool
     */
    public function checkUsers($partner, $referral)
    {
        if ($this->user_partner == $partner && $this->user_referral == $referral) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getUnreadMessagesCount()
    {
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id')->where('is_read', false)->count();
    }

    /**
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUnreadMessages($user_id)
    {
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id')->where('user_id', '!=', $user_id)->where('is_read', false)->get();
    }

    /**
     * @return mixed
     */
    public function getCompanion()
    {
        $companionId = $this->user_partner == Auth::user()->id ? $this->user_referral : $this->user_partner;
        return User::where('id', $companionId)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
