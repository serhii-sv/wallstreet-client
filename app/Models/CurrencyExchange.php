<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    use HasFactory;
    use Uuids;
    protected $guarded = ['_token'];
    protected $table = 'currency_exchange';
}
