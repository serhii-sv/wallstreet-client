<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
