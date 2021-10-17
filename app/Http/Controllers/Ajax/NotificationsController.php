<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    
    public function setReadStatus(Request $request)
    {
        $id = $request->get('id');
        $user_notification = NotificationUser::where('id', $id)->where('user_id', Auth::user()->id)->where('is_read', false)->first();
        if (empty($user_notification))
            return json_encode([
                'status' => 'bad',
                'msg' => 'Такого уведомления не существует',
            ]);
        $user_notification->is_read = true;
        if ($user_notification->save()) {
            return json_encode([
                'status' => 'good',
                'msg' => 'Статус уведомления изменён!',
                'notification_count' => NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->count(),
            ]);
        }
        
        return json_encode([
            'status' => 'bad',
            'msg' => 'Неведомая ошибка',
        ]);
    }
}
