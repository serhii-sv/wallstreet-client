<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWalletDetail extends Model
{
    use HasFactory;
    use Uuids;
    
    protected $table = 'user_wallet_details';
    protected $keyType = 'string';
    protected $fillable = ['wallet_id','user_id', 'payment_system_id', 'currency_id', 'external', 'created_at', 'updated_at'];
    
}
