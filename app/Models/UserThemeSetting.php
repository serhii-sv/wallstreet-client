<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserThemeSetting
 *
 * @property string $id
 * @property string $user_id
 * @property array|null $theme_settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting whereThemeSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThemeSetting whereUserId($value)
 * @mixin \Eloquent
 */
class UserThemeSetting extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'user_theme_settings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'theme_settings'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'theme_settings' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public static function getThemeSettings()
    {
        return auth()->user()->themeSettings->theme_settings ?? [];
    }
}
