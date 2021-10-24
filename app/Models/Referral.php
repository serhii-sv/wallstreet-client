<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Referral
 *
 * @package App\Models
 * integer level
 * float   percent
 * integer on_load
 * integer on_profit
 * Carbon  created_at
 * Carbon  updated_at
 * @property string $id
 * @property int $level
 * @property float $percent
 * @property bool $on_load
 * @property bool $on_profit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Referral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral query()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereOnLoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereOnProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Referral extends Model
{
    use Uuids;

    /** @var bool $incrementing */
    public $incrementing = false;

    public $keyType      = 'string';

    /** @var array $fillable */
    protected $fillable = [
        'level',
        'percent',
        'on_load',
        'on_profit'
    ];

    /**
     * @param $level
     *
     * @return int
     */
    public static function getOnLoad($level) {
        if ($referral = self::where('level', $level)->first()) {
            if ($referral->on_load)
                return $referral->percent;
            return 0;
        }
        return 0;

    }

    /**
     * @param $level
     *
     * @return int
     */
    public static function getOnProfit($level) {
        if ($referral = self::where('level', $level)->first()) {
            if ($referral->on_profit)
                return $referral->percent;
            return 0;
        }
        return 0;
    }
}
