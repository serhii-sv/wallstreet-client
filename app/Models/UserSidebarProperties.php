<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSidebarProperties extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'sb_prop',
        'sb_val',
        'created_at',
        'updated_at',
    ];
}
