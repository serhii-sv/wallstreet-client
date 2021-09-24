<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;
    
    private $types = [
        1 => [
            'name' => 'Email',
            'active' => true,
        ],
        2 => [
            'name' => 'Браузер',
            'active' => true,
        ],
        3 => [
            'name' => 'Смс',
            'active' => false,
        ],
    ];
    
    public static $notification_types = [
        'new_charge' => [
            'view' => 'notifications.new_charge',
        ],
        'new_message' => [
            'view' => 'notifications.new_message',
        ],
        'new_referral' => [
            'view' => 'notifications.new_referral',
        ],
        'new_transfer_in' => [
            'view' => 'notifications.new_transfer_in',
        ],
        'new_transfer_out' => [
            'view' => 'notifications.new_transfer_out',
        ],
        'new_withdrawal' => [
            'view' => 'notifications.new_withdrawal',
        ],
    ];
    
    protected $guarded = ['_token'];
    
    public function getTypes()
    : array {
        return $this->types;
    }
    
    public static function sendNotification($data, $notification_type) {
        $notification_in = new self();
        $notification_in->name = $data['notification_name'];
        $notification_in->text = view(self::$notification_types[$notification_type]['view'], $data)->render();
        $notification_in->type_browser = true;
        if ($notification_in->save()) {
            $notification_user = new NotificationUser();
            $notification_user->user_id = $data['user'] ? $data['user']->id : null;
            $notification_user->notification_id = $notification_in->id;
            $notification_user->save();
        }
    }
}
