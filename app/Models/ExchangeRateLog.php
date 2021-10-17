<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRateLog extends Model
{
    use HasFactory;
    use Uuids;
    public $keyType      = 'string';
    
    protected $guarded = ['_token'];
    
}
