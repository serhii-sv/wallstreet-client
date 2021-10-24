<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailSent
 *
 * @package App\Models
 * @property string id
 * @property string email
 * @property string text
 * @property string subject
 * @property Carbon created_at
 * @property Carbon update_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MailSent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailSent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailSent query()
 * @mixin \Eloquent
 */
class MailSent extends Model
{
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $timestamps */
    public $timestamps = ['created_at', 'updated_at'];

    /** @var array $fillable */
    protected $fillable = [
        'user',
        'email',
        'text',
        'subject',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
