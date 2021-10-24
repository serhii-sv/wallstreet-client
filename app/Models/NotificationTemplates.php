<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotificationTemplates
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationTemplates query()
 * @mixin \Eloquent
 */
class NotificationTemplates extends Model
{
    use HasFactory;
    protected $guarded = ['_token'];
}
