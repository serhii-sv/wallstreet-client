<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property bool $type_browser
 * @property bool $type_sms
 * @property string $name
 * @property string|null $subject
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTypeBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTypeSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use HasFactory;
    
    private $types = [
        1 => [
            'name' => 'Email',
            'active' => true
        ],
        2 => [
            'name' => 'Браузер',
            'active' => true
        ],
        3 => [
            'name' => 'Смс',
            'active' => false
        ]
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
        'new_reinvest' => [
            'view' => 'notifications.new_reinvest',
        ],
    ];
    
    protected $guarded = ['_token'];
    
    public function getTypes():array {
        return $this->types;
    }
    
    public static function sendNotification($data, $notification_type) {
        $notification_in = new self();
        $notification_in->name = $data['notification_name'];
        $notification_in->text = view(self::$notification_types[$notification_type]['view'], $data)->render();
        $notification_in->type_browser = true;
        if ($notification_in->save()) {
            $notification_user = new NotificationUser();
            $notification_user->user_id = $data['user']->id;
            $notification_user->notification_id = $notification_in->id;
            $notification_user->save();
        }
    }
}
