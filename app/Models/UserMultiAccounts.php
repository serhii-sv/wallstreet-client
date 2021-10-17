<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMultiAccounts extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function main_user() {
        return $this->belongsTo(User::class, 'main_user_id', 'id');
    }
}
