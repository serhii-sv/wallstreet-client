<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rate_id',
        'rate',
        'is_random',
        'autoupdate',
        'min_rate',
        'max_rate',
        'date_start',
        'date_end',
        'created_at',
        'updated_at',
    ];
    protected $dates = ['date_start', 'date_end'];
}
