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
class CloudFile extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'created_by',
        'name',
        'ext',
        'mime',
        'url',
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


}//end class
