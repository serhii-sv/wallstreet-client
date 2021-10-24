<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminChat
 *
 * @property string $id
 * @property string $user_1
 * @property string $user_2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat whereUser1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminChat whereUser2($value)
 * @mixin \Eloquent
 */
class AdminChat extends Model
{
    use HasFactory;
    use Uuids;
    protected $keyType = 'string';
    protected $guarded = ['_token'];
    
}
