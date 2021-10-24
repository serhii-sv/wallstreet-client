<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CloudFileFolder
 *
 * @property int $id
 * @property string $folder_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CloudFile[] $files
 * @property-read int|null $files_count
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder query()
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder whereFolderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CloudFileFolder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CloudFileFolder extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'cloud_file_folders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'folder_name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(CloudFile::class);
    }
}
