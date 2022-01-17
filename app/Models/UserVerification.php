<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserVerification
 *
 * @property string $id
 * @property string $user_id
 * @property string $full_name
 * @property string $passport_image
 * @property string $selfie_image
 * @property bool $accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification wherePassportImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereSelfieImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerification whereUserId($value)
 * @mixin \Eloquent
 */
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
        'accepted',
        'id_card_front_image',
        'id_card_back_image',
        'document_type',
        'driver_license_image',
        'address_image',
        'first_name',
        'last_name',
        'date_of_birth',
        'country',
        'city',
        'state',
        'nationality',
        'zip_code',
        'address',
        'confirmation_of_correctness',
        'autoaccept',
        'rejected'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
