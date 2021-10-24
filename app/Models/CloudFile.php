<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/*
 * Static private files in the cloud.
 */
/**
 * App\Models\CloudFile
 *
 * @property string $id
 * @property string $created_by
 * @property string $name
 * @property string $ext
 * @property string $mime
 * @property string $url
 * @property string|null $last_access
 * @property float $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $cloud_file_folder_id
 * @property-read \App\Models\User $author
 * @property-read \App\Models\CloudFileFolder $folder
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereCloudFileFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereLastAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFile whereUrl($value)
 * @mixin \Eloquent
 */
class CloudFile extends Model
{
    use Uuids;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'created_by',
        'name',
        'ext',
        'mime',
        'url',
        'cloud_file_folder_id',
        'last_access',
        'size',
    ];

    /**
     * File author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        $author = $this->belongsTo(User::class, 'created_by');
        return $author;

    }//end author()

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo(CloudFileFolder::class);
    }


}//end class
