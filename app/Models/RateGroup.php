<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RateGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $refund_deposit
 * @property bool $reinvest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereRefundDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereReinvest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RateGroup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'reinvest',
        'refund_deposit',
    ];
    protected $guarded = ['_token'];
}
