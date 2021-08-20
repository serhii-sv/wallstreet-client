<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserThemeSetting extends Model
{
    use HasFactory;
    use Uuids;
    
    public $keyType = 'string';
    protected $table = 'user_theme_settings';
    
    protected $fillable = [
        'user_id',
        'theme_settings'
    ];
    protected $casts = [
        'theme_settings' => 'array'
    ];
    
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
