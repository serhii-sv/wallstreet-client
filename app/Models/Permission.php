<?php


namespace App\Models;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class Permission extends \Spatie\Permission\Models\Permission
{
    public $timestamps = true;
    public $keyType = 'string';
    
    public function users(): BelongsToMany
    {
        return $this->morphedByMany(
            getModelForGuard($this->attributes['guard_name']),
            'model',
            config('permission.table_names.model_has_permissions'),
            'permission_id',
            config('permission.column_names.model_morph_key')
        );
    }
    public function roles()
    : BelongsToMany {
        return parent::roles()->withTimestamps(); // TODO: Change the autogenerated stub
    }
}