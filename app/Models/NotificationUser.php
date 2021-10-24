<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotificationUser
 *
 * @property int $id
 * @property string $user_id
 * @property int $notification_id
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Notification $notification
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationUser whereUserId($value)
 * @mixin \Eloquent
 */
class NotificationUser extends Model
{
    use HasFactory;
    protected $guarded = ['_token'];
    
    public function notification() {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }
}
