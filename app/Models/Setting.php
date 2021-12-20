<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @package App\Models
 * string s_key
 * string s_value
 * @property int $id
 * @property string $s_key
 * @property string|null $s_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $autoupdate
 * @property-read string $currency_name
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAutoupdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        's_key',
        's_value',
        'autoupdate',
        'is_fixed'
    ];

    /**
     * @param string $key
     * @param string $default
     * @param false $force
     * @return mixed
     * @throws \Exception
     */
    public static function getValue(string $key, $default='', $force = false)
    {
        if ($force) {
            return self::settingValue($key, $default);
        }
        return cache()->remember('model_setting_' . $key, now()->addHours(6), function () use ($key, $default) {
            return self::settingValue($key, $default);
        });
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    private static function settingValue($key, $default)
    {
        $row = self::where('s_key', $key)->first();

        if (null === $row) {
            return $default;
        }

        return $row->s_value;
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return string
     */
    public static function setValue(string $key, string $value = null): string
    {
        $value = $value ?? '';
        $setting = self::updateOrCreate([
            's_key' => $key
        ], [
            's_value' => $value
        ]);
        return $setting ? $setting->s_value : '';
    }

    /**
     * @return string
     */
    public function getCurrencyNameAttribute()
    {
        list($first_currency, $second_currency) = explode('_to_', $this->s_key);
        return strtoupper($first_currency) . ' - ' . strtoupper($second_currency);
    }
}
