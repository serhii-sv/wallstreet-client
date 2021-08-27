<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;
    use Uuids;
    public $keyType = 'string';
    
    protected $guarded = ['_token'];
    
    public function user_partner() {
        return $this->belongsTo(User::class, 'user_partner', 'id');
    }
    public function user_referral() {
        return $this->belongsTo(User::class, 'user_referral', 'id');
    }
    
    public function getCompanion() {
        $companionId = $this->user_partner == Auth::user()->id ? $this->user_referral : $this->user_partner;
        return User::where('id',$companionId)->first();
    }
    
    public function checkUser($user) {
        if ($this->user_partner == $user || $this->user_referral == $user){
            return true;
        }
        return false;
    }
    public function checkUsers($partner, $referral) {
        if ($this->user_partner == $partner && $this->user_referral == $referral){
            return true;
        }
        return false;
    }
}
