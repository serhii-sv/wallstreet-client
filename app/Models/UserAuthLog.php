<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAuthLog
 * @package App\Models
 *
 * @property string user_id
 * @property bool is_admin
 * @property string ip
 */

class UserAuthLog extends Model
{
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
