<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\UserThemeSetting;
use Illuminate\Http\Request;

class UserThemeSettingController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $settings = $request->except('_token');
        
        $result = UserThemeSetting::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'user_id' => $user->id,
                'theme_settings' => $settings
            ]
        );
        
        return response()->json([
            'success' => (bool)$result,
            'message' => (bool)$result ? 'Настройки темы сохранены успешно' : 'Настройки темы не были сохранены'
        ]);
    }
}
