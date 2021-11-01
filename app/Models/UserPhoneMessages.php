<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoneMessages extends Model
{
    use HasFactory;
    use Uuids;
    
    protected $fillable = [
        'user_id',
        'code',
        'type',
        'dispatch_method',
        'used',
    ];
    const verification_type = [
        'text',
        'voice',
    ];
    const verification_enable = [
        'off',
        'on',
    ];
    
    static public function validate(Request $request) {
        $errors = false;
        if (!in_array($request->get('verification_type'), self::verification_type))
            $errors = true;
        if (!in_array($request->get('verification_enable'), self::verification_enable))
            $errors = true;
        if ($errors == false) {
            return true;
        }
        return false;
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
