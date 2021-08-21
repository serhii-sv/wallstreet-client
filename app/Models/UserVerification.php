<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
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
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'passport_image',
        'selfie_image',
        'full_name',
        'accepted'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
