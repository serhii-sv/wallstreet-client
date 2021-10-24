<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 *
 * @property string s_key
 * @property string s_value
 */
class Setting extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        's_key',
        's_value'
    ];

    /**
     * @param string $key
     * @return string|null
     * @throws \Exception
     */
    public static function getValue(string $key, $default='')
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
}
