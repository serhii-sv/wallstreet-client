<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ModelHasPermission
 *
 * @property int $permission_id
 * @property string $model_id
 * @property string $model_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelHasPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModelHasPermission extends Model
{
    use HasFactory;
    protected $table = 'model_has_permissions';
    
    public function user() {
        return $this->belongsTo(User::class, 'model_id', 'id');
    }
}
