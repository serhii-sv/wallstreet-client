<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSecurity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'google2fa_enable',
        'google2fa_secret',
    ];

    protected $casts = [
        'google2fa_enable' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
