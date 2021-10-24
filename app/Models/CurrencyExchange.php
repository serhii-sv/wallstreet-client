<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CurrencyExchange
 *
 * @property int $id
 * @property string $user_id
 * @property string $transaction_out
 * @property string $transaction_in
 * @property \App\Models\Currency $currency_out
 * @property \App\Models\Currency $currency_in
 * @property string $amount_out
 * @property string $amount_in
 * @property float $main_currency_amount_out
 * @property float $main_currency_amount_in
 * @property float|null $commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange query()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereAmountIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereAmountOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereCurrencyIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereCurrencyOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereMainCurrencyAmountIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereMainCurrencyAmountOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereTransactionIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereTransactionOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyExchange whereUserId($value)
 * @mixin \Eloquent
 */
class CurrencyExchange extends Model
{
    use HasFactory;
    use Uuids;
    protected $guarded = ['_token'];
    protected $table = 'currency_exchange';
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function currency_in() {
        return $this->belongsTo(Currency::class, 'currency_in','id');
    }
    public function currency_out() {
        return $this->belongsTo(Currency::class, 'currency_out','id');
    }
}
